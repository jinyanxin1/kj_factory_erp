<?php
/**
 * @Author: jinyanxin
 * @Date: 2020/2/10
 * @Time: 11:20
 * 退货主表
 */


namespace common\models\purchase\returnGoods;


use common\library\helper\Code;
use common\models\BaseForm;
use common\models\BaseModel;
use common\models\clientInfo\ClientInfoModel;
use common\models\goods\GoodsMaterialModel;
use common\models\goods\GoodsModel;
use common\models\purchase\GoodsStockModel;
use common\models\purchase\StockRecordModel;
use common\models\supplierInfo\SupplierInfoModel;
use common\models\workingProcedure\GoodsWorkingProcedureModel;
use yii\db\Exception;

class ReturnGoodsModel extends BaseModel
{

    public static function tableName()
    {
        return 'kj_goods_return_goods';
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
                throw new \Exception('----进货主记录未找到--');
            }
            $houseId = $returnInfo['houseId'];
            $goodsType = intval($returnInfo['goodsType']);
            $returnDetail = ReturnGoodsDetailModel::getDataByReturnId($id);
            if(count($returnDetail) > 0){
                foreach($returnDetail as $info){
                    $num = intval($info['num']);
                    $goodsId = intval($info['goodsId']);
                    $workingId = intval($info['workingId']);
                    if(!empty($goodsId)){
                        $goods = GoodsModel::getById($goodsId);
                        $isFinished = intval($goods['isFinished']);
                        if(!empty($goods)){
                            if($goodsType === GoodsModel::TYPE_PRODUCTION){
                                $stock = GoodsStockModel::find()->where(['wareHouseId'=>$houseId,'goodsId'=>$goodsId,'workingId'=>$workingId,'isValid'=>GoodsStockModel::IS_VALID_OK])->one();
                                $stock->num = $stock->num - $num;
                                $stock->save();
                            }else if($goodsType === GoodsModel::TYPE_MATERIEL){
                                //物料
                                $stock = GoodsStockModel::find()->where(['wareHouseId'=>$houseId,'goodsId'=>$goodsId,'isValid'=>GoodsStockModel::IS_VALID_OK])->one();
                                $stock->num = $stock->num + $num;
                                if(intval($stock->num) < 0){
                                    throw  new \Exception($goods['name'].'记录删除后库存小于0，删除失败');
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
            }
            ReturnGoodsModel::updateAll(['isValid'=>self::IS_VALID_NO,'updateTime'=>date('Y-m-d H:i:s')],['returnId'=>$id]);
            ReturnGoodsDetailModel::updateAll(['isValid'=>ReturnGoodsDetailModel::IS_VALID_NO,'updateTime'=>date('Y-m-d H:i:s')],['returnId'=>$id]);
            StockRecordModel::updateAll(['isValid'=>StockRecordModel::IS_VALID_NO,'updateTime'=>date('Y-m-d H:i:s')],['unionId'=>$id,'type'=>StockRecordModel::TYPE_RETURN_GOODS]);
            $transaction->commit();
        }catch (\Exception $e){
            $transaction->rollBack();
            $bol = false;
            \Yii::info('------del stock manage by returnId fail'.$e->getMessage());
            return ['bol'=>$bol,'msg'=>$e->getMessage()];

        }
        return ['bol'=>$bol,'msg'=>'ok'];

    }


    /*
     * 退货保存数据
     * return_goods,return_goods_detail 退货主表，退货详情表保存数据
     * stock，stock_record 库存表更新商品库存，库存记录表添加记录
     * */
    public static function saveData($data,$houseId,$remark,$userName,$supplier,$date,$returnId,$goodsType,$clientId)
    {
        $returnArr = ['code'=>Code::SUCCESS,'msg'=>'ok'];
        $transaction = \Yii::$app->db->beginTransaction();
        try{
            if(count($data) <= 0){
                throw  new \Exception('退货数据不能为空',Code::PARAM_ERR);
            }
            $totalAmount = 0;
            foreach($data as $item){
                if(intval($item['num']) <= 0){
                    throw  new \Exception('退货数量不能为空',Code::PARAM_ERR);
                    break;
                }
                $totalAmount += $item['amount'];
            }
            //return_goods保存记录
            if($returnId > 0){
                $returnGoods = self::getById($returnId,false);
                if($returnGoods === null){
                    throw  new \Exception('退货记录不存在',Code::PARAM_ERR);
                }
            }else{
                $returnGoods = new self();
            }
            $returnGoods->goodsType = $goodsType;
            $returnGoods->houseId = $houseId;
            $returnGoods->sn = date('YmdHis');
            $returnGoods->totalAmount = BaseForm::amountToCent($totalAmount);
            $returnGoods->remark = $remark;
            $returnGoods->userName = $userName;
            $returnGoods->supplier = $supplier;
            $returnGoods->clientId = $clientId;
            $returnGoods->returnDate = $date;
            if(!$returnGoods->save()){
                throw  new \Exception('退货主表保存失败',Code::PARAM_ERR);
            }
            $returnId = $returnGoods->returnId;
            //保存退货详情表
            $saveReturnGoodsDetail = ReturnGoodsDetailModel::saveData($data,$returnId,$houseId,$goodsType);
            if($saveReturnGoodsDetail['code'] !== Code::SUCCESS){
                \Yii::info('---save return goods detail fail--'.$saveReturnGoodsDetail['msg']);
                throw new \Exception($saveReturnGoodsDetail['msg'],Code::PARAM_ERR);
            }
            $numData = $saveReturnGoodsDetail['numData'];//如果是编辑时，退货的商品数量需要与原来的更新，如果是更新时不变
            //更新库存表，添加库存记录
            $saveStock = GoodsStockModel::saveData($houseId,$numData,$returnId,StockRecordModel::TYPE_RETURN_GOODS,$remark,$userName,$date,$goodsType);
            if($saveStock['code'] !== Code::SUCCESS){
                \Yii::info('---save return goods fail--'.$saveStock['msg']);
                throw new \Exception($saveStock['msg'],Code::PARAM_ERR);
            }
            $transaction->commit();
        }catch (\Exception $e){
            $transaction->rollBack();
            \Yii::info('-----save return goods error msg--'.$e->getMessage().'--file--'.$e->getFile().'--line--'.$e->getLine());
            $returnArr['code'] = Code::PARAM_ERR;
            $returnArr['msg'] = $e->getCode() == Code::PARAM_ERR ? $e->getMessage() : '保存失败';
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
            $clientIds = array_unique(array_column($data,'clientId'));
            $client = ClientInfoModel::find()->select('clientId,name')->where(['clientId'=>$clientIds,'isValid'=>ClientInfoModel::IS_VALID_OK])
                ->indexBy('clientId')->asArray()->all();
            $supplierId = array_unique(array_column($data,'supplier'));
            $supplier = SupplierInfoModel::find()->select('supplierId,name')->where(['supplierId'=>$supplierId,'isValid'=>SupplierInfoModel::IS_VALID_OK])
                ->indexBy('supplierId')->asArray()->all();
            foreach($data as $info){
                $returnArr[] = [
                    'returnId'=>intval($info['returnId']),
                    'date'=>$info['returnDate'],
                    'totalAmount'=>BaseForm::amountToYuan(intval($info['totalAmount'])),
                    'userName'=>$info['userName'],
//                    'supplier'=>$info['supplier'],
                    'createTime'=>$info['createTime'],
                    'remark'=>$info['remark'],
                    'client'=>isset($client[$info['clientId']]) ? $client[$info['clientId']]['name'] : '',
                    'supplier'=>isset($supplier[$info['supplier']]) ? $supplier[$info['supplier']]['name'] : '' ,
                ];
            }
        }
        return $returnArr;
    }

    /*
     * 产品退货
     * */
    public static function saveProductionData($data,$houseId,$remark,$userName,$supplier,$date,$returnId,$goodsType,$clientId)
    {
        $returnArr = ['code'=>Code::SUCCESS,'msg'=>'ok'];
        $tran = \Yii::$app->db->beginTransaction();
        try{
            //主表保存数据
            if(count($data) <= 0){
                throw  new \Exception('退货数据不能为空',Code::PARAM_ERR);
            }
            $totalAmount = 0;
            foreach($data as $item){
                if(intval($item['num']) <= 0){
                    throw  new \Exception('退货数量不能为空',Code::PARAM_ERR);
                    break;
                }
                $totalAmount += $item['amount'];
            }
            //return_goods保存记录
            if($returnId > 0){
                $returnGoods = self::getById($returnId,false);
                if($returnGoods === null){
                    throw  new \Exception('退货记录不存在',Code::PARAM_ERR);
                }
            }else{
                $returnGoods = new self();
            }
            $returnGoods->goodsType = $goodsType;
            $returnGoods->houseId = $houseId;
            $returnGoods->sn = date('YmdHis');
            $returnGoods->totalAmount = BaseForm::amountToCent($totalAmount);
            $returnGoods->remark = $remark;
            $returnGoods->userName = $userName;
            $returnGoods->supplier = $supplier;
            $returnGoods->clientId = $clientId;
            $returnGoods->returnDate = $date;
            if(!$returnGoods->save()){
                throw  new \Exception('退货主表保存失败',Code::PARAM_ERR);
            }
            $returnId = $returnGoods->returnId;
            //详情表保存数据
            $existDetail = ReturnGoodsDetailModel::find()->select('returnDetailId')->where(['returnId'=>$returnId,'isValid'=>self::IS_VALID_OK])->asArray()->all();
            $delDetailId = count($existDetail) > 0 ? array_column($existDetail,'returnDetailId') : [];
            $goods = GoodsModel::find()->where(['isValid'=>GoodsModel::IS_VALID_OK])->indexBy('id')->asArray()->all();
            foreach ($data as $datum) {
                if(!isset($goods[$datum['goodsId']])){
                    throw  new \Exception('产品不存在',Code::PARAM_ERR);
                    break;
                }
                $goodsInfo = $goods[$datum['goodsId']];
                $goodsId = intval($datum['goodsId']);
                $workingId = intval($datum['workingId']);
                $num = intval($datum['num']);
                $price = self::amountToCent($datum['price']);
                $info = ReturnGoodsDetailModel::find()->where(['returnId'=>$returnId,'goodsId'=>$goodsId,'workingId'=>$workingId,'isValid'=>ReturnGoodsDetailModel::IS_VALID_OK])->one();
                if(empty($info)){
                    $info = new ReturnGoodsDetailModel();
                    $updateNum = $datum['num'];
                }else{
                    $delDetailId = array_diff($delDetailId,[$info['returnDetailId']]);
                    $updateNum = $datum['num'] - $info->num ;
                }
                $info->goodsType = $goodsType;
                $info->returnId = $returnId;
                $info->goodsId = $goodsId;
                $info->workingId = $workingId;
                $info->num = $num;
                $info->price = $price;
                if(!$info->save()){
                    throw new \Exception('退货详情保存失败',Code::PARAM_ERR);
                    break;
                }
                //保存流水表
                $stockRecord = StockRecordModel::find()->where([
                    'wareHouseId'=>$houseId,'goodsId'=>$goodsId,'workingId'=>$workingId,'type'=>StockRecordModel::TYPE_RETURN_GOODS,
                    'unionId'=>$returnId,'isValid'=>StockRecordModel::IS_VALID_OK])->one();
                if(empty($stockRecord)){
                    $stockRecord = new StockRecordModel();
                }
                $stockRecord->goodsType = $goodsType;
                $stockRecord->wareHouseId = $houseId;
                $stockRecord->goodsId = $goodsId;
                $stockRecord->workingId = $workingId;
                $stockRecord->num = $num;
                $stockRecord->price = $price;
                $stockRecord->type = StockRecordModel::TYPE_RETURN_GOODS;
                $stockRecord->unionId = $returnId;
                $stockRecord->remark = $remark;
                $stockRecord->userName = $userName;
                $stockRecord->date = $date;
                if(!$stockRecord->save()){
                    throw new \Exception('流水记录保存失败',Code::PARAM_ERR);
                    break;
                }
                //更新库存
                $goodsStock = GoodsStockModel::find()->where(['wareHouseId'=>$houseId,'goodsId'=>$goodsId,'workingId'=>$workingId,'isValid'=>GoodsStockModel::IS_VALID_OK])->one();
                if(empty($goodsStock)){
                    $goodsStock = new GoodsStockModel();
                }
                $goodsStock->wareHouseId = $houseId;
                $goodsStock->goodsId = $goodsId;
                $goodsStock->workingId = $workingId;
                $goodsStock->num = $goodsStock->num + $updateNum;
                $goodsStock->save();
            }
            //若是编辑时，前次退货A，B商品，编辑后，退货A，C商品，需要C商品记录删掉，库存更新，流水记录删掉
            if(count($delDetailId) > 0){
                $delData = ReturnGoodsDetailModel::find()->where(['returnDetailId'=>$delDetailId,'isValid'=>ReturnGoodsDetailModel::IS_VALID_OK])->all();
                if(!empty($delData)){
                    foreach ($delData as $delDatum) {
                        if(!isset($goods[$delDatum['goodsId']])){
                            throw  new \Exception('产品不存在',Code::PARAM_ERR);
                            break;
                        }
                        $delGoodsInfo = $goods[$delDatum['goodsId']];
                        $delGoodsId = intval($delDatum['goodsId']);
                        $delWorkingId = intval($delDatum['workingId']);
                        $delNum = intval($delDatum['num']);
                        //删除详情记录
                        $delDatum->isValid = ReturnGoodsDetailModel::IS_VALID_NO;
                        if(!$delDatum->save()){
                            throw  new \Exception('详情删除失败',Code::PARAM_ERR);
                            break;
                        }
                        //删除流水记录
                        StockRecordModel::updateAll(['isValid'=>StockRecordModel::IS_VALID_NO,'updateTime'=>date('Y-m-d H:i:s')],
                            ['unionId'=>$returnId,'goodsId'=>$delGoodsId,'workingId'=>$delWorkingId,'type'=>StockRecordModel::TYPE_RETURN_GOODS]);
                        //更新库存
                        $goodsStock = GoodsStockModel::find()->where(['wareHouseId'=>$houseId,'goodsId'=>$delGoodsId,'workingId'=>$delWorkingId,'isValid'=>GoodsStockModel::IS_VALID_OK])->one();
                        if(empty($goodsStock)){
                            $goodsStock = new GoodsStockModel();
                        }
                        $goodsStock->wareHouseId = $houseId;
                        $goodsStock->goodsId = $delGoodsId;
                        $goodsStock->workingId = $delWorkingId;
                        $goodsStock->num = $goodsStock->num - $delNum;
                        $goodsStock->save();
                    }
                }
            }
            $tran->commit();
        }catch (\Exception $e){
            $tran->rollBack();
            \Yii::info('save return production fail---'.$e->getMessage().'--file--'.$e->getFile().'---line--'.$e->getLine());
            $returnArr['code'] = Code::PARAM_ERR;
            $returnArr['msg'] = $e->getCode() == Code::PARAM_ERR ? $e->getMessage() : '保存失败';
        }
        return $returnArr;
    }

}