<?php
/**
 * @Author: jinyanxin
 * @Date: 2020/2/13
 * @Time: 8:41
 * 库存调整主表
 */


namespace common\models\purchase\adjustment;


use common\library\helper\Code;
use common\models\BaseModel;
use common\models\purchase\StockRecordModel;

class AdjustmentModel  extends BaseModel
{

    public static function tableName()
    {
        return 'kj_goods_adjustment';
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
            AdjustmentModel::updateAll(['isValid'=>self::IS_VALID_NO,'updateTime'=>date('Y-m-d H:i:s')],['adjustmentId'=>$adjustmentId]);
            AdjustmentDetailModel::updateAll(['isValid'=>AdjustmentDetailModel::IS_VALID_NO,'updateTime'=>date('Y-m-d H:i:s')],['adjustmentId'=>$adjustmentId]);
            StockRecordModel::updateAll(['isValid'=>StockRecordModel::IS_VALID_NO,'updateTime'=>date('Y-m-d H:i:s')],['type'=>StockRecordModel::TYPE_INVA,'unionId'=>$adjustmentId]);
            $transaction->commit();
        }catch (\Exception $e){
            $transaction->rollBack();
            $bol = false;
            \Yii::info('del adjustment fail error msg'.$e->getMessage());
            return ['bol'=>false,'msg'=>$e->getMessage()];
        }
        return ['bol'=>$bol,'msg'=>'ok'];
    }

    //保存数据
    public static function saveData($adjustmentId,$data,$houseId,$remark,$userName,$date,$goodsType)
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
            $adjustmentInfo->goodsType = $goodsType;
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
            $saveDetail = AdjustmentDetailModel::saveData($houseId,$adjustmentId,$data,$remark,$userName,$date,$goodsType);
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