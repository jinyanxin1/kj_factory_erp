<?php
/**
 * @Author: jinyanxin
 * @Date: 2020/2/12
 * @Time: 8:48
 * 报损主表
 */


namespace common\models\stock;


use common\library\helper\Code;
use common\models\BaseForm;
use common\models\BaseModel;
use yii\db\Exception;

class StockLossModel extends BaseModel
{

    public static function tableName()
    {
        return 'jxt_jxc_stock_loss';
    }

    //根据id得到数据
    public static function getById($id,$isArr = true)
    {
        $info = self::find()->where(['stockLossId'=>$id,'isValid'=>self::IS_VALID_OK]);
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
                    'stockLossId'=>intval($info['stockLossId']),
                    'date'=>$info['date'],
                    'userName'=>$info['userName'],
                    'createTime'=>$info['createTime'],
                    'remark'=>$info['remark']
                ];
            }
        }
        return $returnArr;
    }

    //删除数据
    public static function delById($id)
    {
        $bol = true;
        $transaction = \Yii::$app->db->beginTransaction();
        try{
            StockLossModel::updateAll(['isValid'=>self::IS_VALID_NO],['stockLossId'=>$id]);
            StockLossDetailModel::updateAll(['isValid'=>StockLossDetailModel::IS_VALID_NO],['stockLossId'=>$id]);
            StockRecordModel::updateAll(['isValid'=>StockRecordModel::IS_VALID_NO],['unionId'=>$id,'type'=>StockRecordModel::TYPE_REPORT_LOSS]);
            $transaction->commit();
        }catch (\Exception $e){
            $transaction->rollBack();
            $bol = false;
        }
        return $bol;
    }


    /*
     * 保存数据
     *          stock_loss,stock_detail 报损主表，报损详情表 增加记录
     *          stock_record 库存记录表增加数据
     * */
    public static function saveData($stockLossId,$data,$houseId,$remark,$userName,$date)
    {
        $returnArr = ['code'=>Code::PARAM_ERR,'msg'=>'保存失败'];
        $transaction = \Yii::$app->db->beginTransaction();
        try{
            if($stockLossId > 0){
                $stockLossInfo = self::getById($stockLossId,false);
                if($stockLossInfo === null){
                    throw new Exception('报损记录为空');
                }
            }else{
                $stockLossInfo = new self();
            }
            $stockLossInfo->houseId = $houseId;
            $stockLossInfo->sn = date('YmdHis');
            $stockLossInfo->remark = $remark;
            $stockLossInfo->userName = $userName;
            $stockLossInfo->date = $date;
            if(!$stockLossInfo->save()){
                throw  new Exception('报损记录保存失败');
            }
            $stockLossId = $stockLossInfo->stockLossId;
            //保存报损详情记录
            $saveStockLossDetail = StockLossDetailModel::saveData($stockLossId,$data,$houseId,$remark,$userName,$date);
            if($saveStockLossDetail['code'] !== Code::SUCCESS){
                $returnArr['msg'] = $saveStockLossDetail['msg'];
                throw  new Exception('报损详情保存失败');
            }
            $transaction->commit();
            $returnArr['code'] = Code::SUCCESS;
            $returnArr['msg'] = '保存成功';
        }catch (\Exception $e){
            \Yii::info('---save stock loss fail error msg'.$e->getMessage().'---file-'.$e->getFile().'---line--'.$e->getLine());
            $transaction->rollBack();
        }
        return $returnArr;
    }


}