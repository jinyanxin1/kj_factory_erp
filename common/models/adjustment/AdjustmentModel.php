<?php
/**
 * @Author: jinyanxin
 * @Date: 2020/2/13
 * @Time: 8:41
 * 库存调整主表
 */


namespace common\models\adjustment;


use common\library\helper\Code;
use common\models\BaseModel;
use common\models\goods\GoodsModel;
use common\models\stock\StockModel;
use common\models\stock\StockRecordModel;

class AdjustmentModel  extends BaseModel
{

    public static function tableName()
    {
        return 'jxt_jxc_adjustment';
    }

    public static function getById($adjustmentId,$isArr = true)
    {
        $info = self::find()->where(['adjustmentId'=>$adjustmentId,'isValid'=>self::IS_VALID_OK]);
        if($isArr === true){
            $info->asArray();
        }
        return $info->one();
    }

    //格式化数据
    public static function format($data)
    {
        $returnArr = [];
        if(count($data) > 0){
            foreach($data as $info){
                $returnArr[] = [
                    'adjustmentId'=>intval($info['adjustmentId']),
                    'date'=>$info['date'],
                    'userName'=>$info['userName'],
                    'createTime'=>$info['createTime'],
                    'remark'=>$info['remark']
                ];
            }
        }
        return $returnArr;
    }

    //根据主键id删除
    public static function delById($adjustmentId)
    {
        $bol = true;
        $transaction = \Yii::$app->db->beginTransaction();
        try{
            $info = self::getById($adjustmentId,true);
            $houseId = intval($info['houseId']);
            $data = AdjustmentDetailModel::getDataByAdjustmentId($adjustmentId);
            if(count($data) > 0){
                //更新库存数值
                foreach($data as $dataInfo){
                    $goodsId = intval($dataInfo['goodsId']);
                    $goods = GoodsModel::getById($goodsId);
                    if(!empty($goods)){
                        $num = intval($dataInfo['num']);
                        $stock = StockModel::find()->where(['warehouseId'=>$houseId,'goodsId'=>$goodsId])->one();
                        if($stock === null){
                            throw new \Exception('库存不存在');
                            break;
                        }
                        if(($stock->stockNum - $num) < 0){
                            throw new \Exception('库存调整后数量小于0，删除失败');
                            break;
                        }
                        $stock->stockNum = $stock->stockNum - $num;
                        if(!$stock->save()){
                            throw new \Exception('库存更新失败');
                            break;
                        }
                    }
                }
            }
            AdjustmentModel::updateAll(['isValid'=>self::IS_VALID_NO],['adjustmentId'=>$adjustmentId]);
            AdjustmentDetailModel::updateAll(['isValid'=>AdjustmentDetailModel::IS_VALID_NO],['adjustmentId'=>$adjustmentId]);
            StockRecordModel::updateAll(['isValid'=>StockRecordModel::IS_VALID_NO],['type'=>StockRecordModel::TYPE_INVA,'unionId'=>$adjustmentId]);
            $transaction->commit();
        }catch (\Exception $e){
            $transaction->rollBack();
            $bol = false;
            \Yii::info('del adjustment fail error msg'.$e->getMessage());
        }
        return $bol;
    }

    //保存数据
    public static function saveData($adjustmentId,$data,$houseId,$remark,$userName,$date)
    {
        $returnArr = ['code'=>Code::PARAM_ERR,'msg'=>'保存失败'];
        $transaction = \Yii::$app->db->beginTransaction();
        try{
            if($adjustmentId > 0){
                $adjustmentInfo = self::getById($adjustmentId,false);
                if($adjustmentInfo === null){
                    throw new \Exception('库存调整记录不存在');
                }
            }else{
                $adjustmentInfo = new self();
            }
            $adjustmentInfo->houseId = $houseId;
            $adjustmentInfo->sn = date('YmdHis');
            $adjustmentInfo->remark = $remark;
            $adjustmentInfo->userName = $userName;
            $adjustmentInfo->date = $date;
            if(!$adjustmentInfo->save()){
                throw  new \Exception('库存调整记录保存失败');
            }
            $adjustmentId = $adjustmentInfo->adjustmentId;
            //保存库存调整记录详情
            $saveDetail = AdjustmentDetailModel::saveData($houseId,$adjustmentId,$data,$remark,$userName,$date);
            if($saveDetail['code'] !== Code::SUCCESS){
                throw new \Exception($saveDetail['msg']);
            }
            $transaction->commit();
            $returnArr['code'] = Code::SUCCESS;
            $returnArr['msg'] = '保存成功';
        }catch (\Exception $e){
            $transaction->rollBack();
            \Yii::info('save adjustment fail error msg'.$e->getMessage());
        }
        return $returnArr;
    }

}