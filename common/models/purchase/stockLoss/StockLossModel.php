<?php
/**
 * @Author: jinyanxin
 * @Date: 2020/2/12
 * @Time: 8:48
 * 报损主表
 */


namespace common\models\purchase\stockLoss;


use common\library\helper\Code;
use common\models\BaseForm;
use common\models\BaseModel;
use common\models\goods\GoodsMaterialModel;
use common\models\goods\GoodsModel;
use common\models\purchase\GoodsStockModel;
use common\models\purchase\StockRecordModel;
use yii\db\Exception;

class StockLossModel extends BaseModel
{

    public static function tableName()
    {
        return 'kj_goods_stock_loss';
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
            $houseId = 1;
            //更新库存。加
            $detail = StockLossDetailModel::find()->where(['stockLossId'=>$id,'isValid'=>StockLossDetailModel::IS_VALID_OK])->asArray()->all();
            if(count($detail) > 0){
                foreach ($detail as $item) {
                    $num = $item['num'];
                    $goodsId = intval($item['goodsId']);
                    $workingId = intval($item['workingId']);
                    $goods = GoodsModel::getById($goodsId);
                    if(!empty($goods)){
                        $isFinished = intval($goods['isFinished']);
                        $goodsType = intval($goods['type']);
                        $stock = GoodsStockModel::find()->where(['wareHouseId'=>$houseId,'goodsId'=>$goodsId,'workingId'=>$workingId,'isValid'=>GoodsStockModel::IS_VALID_OK])->one();
                        if(!empty($stock)){
                            $stock->num = $stock->num + $num;
                            if(!$stock->save()){
                                throw new \Exception('库存更新失败',Code::PARAM_ERR);
                                break;
                            }
                        }
                    }
                }
            }
            StockLossModel::updateAll(['isValid'=>self::IS_VALID_NO,'updateTime'=>date('Y-m-d H:i:s')],['stockLossId'=>$id]);
            StockLossDetailModel::updateAll(['isValid'=>StockLossDetailModel::IS_VALID_NO,'updateTime'=>date('Y-m-d H:i:s')],['stockLossId'=>$id]);
            StockRecordModel::updateAll(['isValid'=>StockRecordModel::IS_VALID_NO,'updateTime'=>date('Y-m-d H:i:s')],['unionId'=>$id,'type'=>StockRecordModel::TYPE_REPORT_LOSS]);
            $transaction->commit();
        }catch (\Exception $e){
            \Yii::info('del stock loss fail--'.$e->getMessage().'---file--'.$e->getFile().'--line--'.$e->getLine());
            $transaction->rollBack();
            return ['bol'=>$bol,'msg'=>$e->getMessage()];
        }
        return ['bol'=>$bol,'msg'=>'ok'];
    }


    /*
     * 保存数据
     *          stock_loss,stock_detail 报损主表，报损详情表 增加记录
     *          stock_record 库存记录表增加数据
     * */
    public static function saveData($stockLossId,$data,$houseId,$remark,$userName,$date,$goodsType)
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
            $stockLossInfo->goodsType = $goodsType;
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
            $saveStockLossDetail = StockLossDetailModel::saveData($stockLossId,$data,$houseId,$remark,$userName,$date,$goodsType);
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