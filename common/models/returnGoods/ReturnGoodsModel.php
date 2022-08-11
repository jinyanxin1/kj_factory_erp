<?php
/**
 * @Author: jinyanxin
 * @Date: 2020/2/10
 * @Time: 11:20
 * 退货主表
 */


namespace common\models\returnGoods;


use common\library\helper\Code;
use common\models\BaseForm;
use common\models\BaseModel;
use common\models\goods\GoodsModel;
use common\models\stock\StockModel;
use common\models\stock\StockRecordModel;
use yii\db\Exception;

class ReturnGoodsModel extends BaseModel
{

    public static function tableName()
    {
        return 'jxt_jxc_return_goods';
    }

    //根据id得到数据
    public static function getById($id,$isArr = true)
    {
        $info = self::find()->where(['returnId'=>$id,'isValid'=>self::IS_VALID_OK]);
        if($isArr === true){
            $info->asArray();
        }
        return $info->one();
    }

    /*
     * 删除数据
     * 根据id删除记录：主表，详情表都删除
     * 库存要更新，库存记录要删除
     * */
    public static function delById($id)
    {
        $bol = true;
        $transaction = \Yii::$app->db->beginTransaction();
        try{
            $returnInfo = self::getById($id,true);
            if($returnInfo === null){
                $bol = false;
                throw new Exception('----进货主记录未找到--');
            }
            $houseId = $returnInfo['houseId'];
            $returnDetail = ReturnGoodsDetailModel::getDataByReturnId($id);
            if(count($returnDetail) > 0){
                foreach($returnDetail as $info){
                    $num = intval($info['num']);
                    $goodsId = intval($info['goodsId']);
                    if(!empty($goodsId)){
                        $goods = GoodsModel::getById($goodsId);
                        if(!empty($goods)){
                            $stock = StockModel::find()->where(['warehouseId'=>$houseId,'goodsId'=>$goodsId,'isValid'=>StockModel::IS_VALID_OK])->one();
                            if($stock === null){
                                $bol = false;
                                break;
                            }
                            $stock->stockNum = $stock->stockNum + $num;
                            if(intval($stock->stockNum) < 0){
                                throw  new \Exception('记录删除后库存小于0，删除失败');
                                break;
                            }
                            if(!$stock->save()){
                                $bol = false;
                                break;
                            }
                        }
                    }
                }
            }
            ReturnGoodsModel::updateAll(['isValid'=>self::IS_VALID_NO],['returnId'=>$id]);
            ReturnGoodsDetailModel::updateAll(['isValid'=>ReturnGoodsDetailModel::IS_VALID_NO],['returnId'=>$id]);
            StockRecordModel::updateAll(['isValid'=>StockRecordModel::IS_VALID_NO],['unionId'=>$id,'type'=>StockRecordModel::TYPE_RETURN_GOODS]);
            $transaction->commit();
        }catch (\Exception $e){
            $transaction->rollBack();
            \Yii::info('------del stock manage by returnId fail'.$e->getMessage());
            $bol = false;
        }
        return $bol;

    }


    /*
     * 退货保存数据
     * return_goods,return_goods_detail 退货主表，退货详情表保存数据
     * stock，stock_record 库存表更新商品库存，库存记录表添加记录
     * */
    public static function saveData($data,$houseId,$remark,$userName,$supplier,$date,$returnId)
    {
        $returnArr = ['code'=>Code::SUCCESS,'msg'=>'ok'];
        $transaction = \Yii::$app->db->beginTransaction();
        try{
            if(count($data) <= 0){
                throw  new Exception('---退货数据不能为空---');
            }
            $totalAmount = 0;
            foreach($data as $item){
                if(intval($item['num']) <= 0){
                    throw  new Exception('-----退货数量不能为空---');
                    break;
                }
                $totalAmount += $item['amount'];
            }
            //return_goods保存记录
            if($returnId > 0){
                $returnGoods = self::getById($returnId,false);
                if($returnGoods === null){
                    throw  new Exception('---退货记录不存在---');
                }
            }else{
                $returnGoods = new self();
            }
            $returnGoods->houseId = $houseId;
            $returnGoods->sn = date('YmdHis');
            $returnGoods->totalAmount = BaseForm::amountToCent($totalAmount);
            $returnGoods->remark = $remark;
            $returnGoods->userName = $userName;
            $returnGoods->supplier = $supplier;
            $returnGoods->returnDate = $date;
            if(!$returnGoods->save()){
                throw  new Exception('---退货主表保存失败----');
            }
            $returnId = $returnGoods->returnId;
            //保存退货详情表
            $saveReturnGoodsDetail = ReturnGoodsDetailModel::saveData($data,$returnId,$houseId);
            if($saveReturnGoodsDetail['code'] !== Code::SUCCESS){
                \Yii::info('---save return goods detail fail--'.$saveReturnGoodsDetail['msg']);
                throw new Exception($saveReturnGoodsDetail['msg']);
            }
            $numData = $saveReturnGoodsDetail['numData'];//如果是编辑时，退货的商品数量需要与原来的更新，如果是更新时不变
            //更新库存表，添加库存记录
            $saveStock = StockModel::saveData($houseId,$numData,$returnId,StockRecordModel::TYPE_RETURN_GOODS,$remark,$userName,$date);
            if($saveStock['code'] !== Code::SUCCESS){
                \Yii::info('---save purchase fail--'.$saveStock['msg']);
                throw new Exception($saveStock['msg']);
            }
            $transaction->commit();
        }catch (\Exception $e){
            $transaction->rollBack();
            \Yii::info('-----save return goods error msg--'.$e->getMessage().'--file--'.$e->getFile().'--line--'.$e->getLine());
            $returnArr['code'] = Code::PARAM_ERR;
            $returnArr['msg'] = '保存失败';
        }
        return $returnArr;
    }


    /*
     * 格式化数据
     * */
    public static function format($data)
    {
        $returnArr = [];
        if(count($data) > 0){
            foreach($data as $info){
                $returnArr[] = [
                    'returnId'=>intval($info['returnId']),
                    'date'=>$info['returnDate'],
                    'totalAmount'=>BaseForm::amountToYuan(intval($info['totalAmount'])),
                    'userName'=>$info['userName'],
                    'supplier'=>$info['supplier'],
                    'createTime'=>$info['createTime'],
                    'remark'=>$info['remark']
                ];
            }
        }
        return $returnArr;
    }

}