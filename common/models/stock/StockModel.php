<?php
/**
 * Created by Eclipse.
 * User: ziv
 * Date: 2019/10/29
 * Time: 10:38
 * 库存模型
 */

namespace common\models\stock;

use common\library\helper\Code;
use common\models\BaseForm;
use common\models\BaseModel;
use common\models\goods\GoodsModel;
use common\models\warehouse\WarehouseModel;

class StockModel extends BaseModel
{
    

    public static function tableName()
    {
        return 'jxt_jxc_stock';
    }

    //得到一个商品的所有库存
    public static function countStockNumByGoodsId($goodsId)
    {
        $house = WarehouseModel::getAllHouse();
        $houseIds = array_column($house,'warehouseId');
        $count = self::find()->where(['goodsId'=>$goodsId,'isValid'=>self::IS_VALID_OK,'warehouseId'=>$houseIds])->sum('stockNum');
        return $count;
    }

    //根据仓库id得到数据
    public static function getByHouseId($houseId)
    {
        $data = self::find()->where(['warehouseId'=>$houseId,'isValid'=>self::IS_VALID_OK])->asArray()->all();
        return $data;
    }

    //得到商品ids的所有库存
    public static function getStockNumByGoodsIds($goodsIds,$houseId)
    {
        $model = self::find()->select('goodsId,stockNum')
            ->where(['goodsId'=>$goodsIds,'warehouseId'=>$houseId])->indexBy('goodsId')->asArray()->all();
        return $model;
    }

    /*
     * 保存记录，更新商品库存
     * $data 进出库管理中增加的的商品库存记录
     * $purchaseId 进货主表id
     * */
    public static function saveData($houseId,$data,$purchaseId,$type,$remark,$userName,$date)
    {

        $returnArr = ['code'=>Code::SUCCESS,'msg'=>'更新成功'];
        if(count($data) > 0){
            $existStockRecord = StockRecordModel::find()->where(['warehouseId'=>$houseId,'type'=>$type,'unionId'=>$purchaseId,'isValid'=>StockRecordModel::IS_VALID_OK])->asArray()->all();
            $existStockRecordIds = count($existStockRecord) > 0 ? array_column($existStockRecord,'stockRecordId') : [];
            foreach($data as $dataInfo){
                if($type === StockRecordModel::TYPE_PURCHASE){
                    $goodsId = intval($dataInfo['goodsId']);
                    $num = intval($dataInfo['num']);
                    $updateNum = intval($dataInfo['updateNum']);
                    $price = $dataInfo['price'];
                }else if($type === StockRecordModel::TYPE_RETURN_GOODS){
                    $goodsId = intval($dataInfo['goodsId']);
                    $num = intval($dataInfo['num']);
                    $updateNum =  0 - intval($dataInfo['updateNum']);
                    $price = $dataInfo['price'];
                }else{
                    $returnArr['code'] = Code::PARAM_ERR;
                    $returnArr['msg'] = '操作类型错误';
                    break;
                }
                $save = self::updateNum($houseId,$purchaseId,$goodsId,$num,$updateNum,$type,$remark,$userName,$price,$date);
                if($save['code'] !== Code::SUCCESS){
                    $returnArr['code'] = Code::PARAM_ERR;
                    $returnArr['msg'] = !empty($save['msg']) ? $save['msg'] : '更新失败';
                    break;
                }
                $stockRecordId = $save['stockRecord'];
                //判断这个记录id是否存在，若存在，则去掉
                if(in_array($stockRecordId,$existStockRecordIds)){
                    $existStockRecordIds = array_diff($existStockRecordIds,[$stockRecordId]);
                }
            }
            if(count($existStockRecordIds) > 0){
                StockRecordModel::updateAll(['isValid'=>self::IS_VALID_NO],['stockRecordId'=>$existStockRecordIds]);
            }
        }
        return $returnArr;
    }

    public static function updateNum($houseId,$unionId,$goodsId,$num,$updateNum,$type,$remark,$userName,$price,$date)
    {

        $stock = self::find()->where(['warehouseId'=>$houseId,'goodsId'=>$goodsId,'isValid'=>self::IS_VALID_OK])->one();
        if($stock === null){
            $stock = new self();
            $stockNum = 0 ;
        }else{
            $stockNum = intval($stock->stockNum);
        }
        if($type === StockRecordModel::TYPE_RETURN_GOODS){
            if(($stockNum + $updateNum) < 0){
                return ['code'=>Code::PARAM_ERR,'msg'=>'退货数量大于库存数量'];
            }
        }
        $stock->warehouseId = $houseId;
        $stock->goodsId = $goodsId;
        $stock->stockNum = $stockNum + $updateNum;
        if(!$stock->save()){
            return ['code'=>Code::PARAM_ERR,'msg'=>'库存更新失败'];
        }
        $stockRecord = StockRecordModel::find()->where(['warehouseId'=>$houseId,'type'=>$type,'goodsId'=>$goodsId,'unionId'=>$unionId,'isValid'=>StockRecordModel::IS_VALID_OK])->one();
        if($stockRecord === null){
            $stockRecord = new StockRecordModel();
        }
        $stockRecord->warehouseId = $houseId;
        $stockRecord->goodsId = $goodsId;
        $stockRecord->num = $num;
        $stockRecord->pice = BaseForm::amountToCent($price);
        $stockRecord->type = $type;
        $stockRecord->unionId = $unionId;
        $stockRecord->remark = $remark;
        $stockRecord->userName = $userName;
        $stockRecord->date = $date;
        if(!$stockRecord->save()){
            return ['code'=>Code::PARAM_ERR,'msg'=>'库存记录表更新失败'];
        }
        return ['code'=>Code::SUCCESS,'msg'=>'ok','stockRecord'=>$stockRecord->stockRecordId];
    }

    /*
     * 格式化数据
     * */
    public static function format($data)
    {

        $returnArr = [];
        if(count($data) > 0){
            $goodsIds = array_column($data,'goodsId');
            $houseIds = array_column($data,'warehouseId');
            $goods = GoodsModel::getByIdList($goodsIds);
            $house = WarehouseModel::getByIdList($houseIds);
            foreach($data as $info){
                $dataInfo['goodsName'] = '';
                $dataInfo['houseName'] = '';
                $dataInfo['stockNum'] = intval($info['stockNum']);
                $dataInfo['warehouseId'] = intval($info['warehouseId']);
                $dataInfo['goodsId'] = intval($info['goodsId']);
                if(isset($goods[$info['goodsId']])){
                    $dataInfo['goodsName'] = $goods[$info['goodsId']]['goodsName'];
                }
                if(isset($house[$info['warehouseId']])){
                    $dataInfo['houseName'] = $house[$info['warehouseId']]['warehouseName'];
                }
                $returnArr[] = $dataInfo;
            }
        }
        return $returnArr;
    }


    /*
     * 调拨操作时，库存更新
     * */
    public static function updateByAllocation($allocationId,$outHouseId,$inHouseId,$goodsId,$num,$updateNum,$price,$remark,$userName,$date)
    {
        $returnArr = ['code'=>Code::PARAM_ERR,'msg'=>'库存更新失败'];
        //调出库存量更新
        $outHouseStock = self::find()->where(['warehouseId'=>$outHouseId,'goodsId'=>$goodsId,'isValid'=>self::IS_VALID_OK])->one();
        if($outHouseStock === null){
            $returnArr['msg'] = '该商品没有库存';
            return $returnArr;
        }
        $stockNum = intval($outHouseStock->stockNum);
        if($stockNum < $updateNum){
            $returnArr['msg'] = '该商品库存量过少';
            return $returnArr;
        }
        $outHouseStock->stockNum = $stockNum - $updateNum;
        if(!$outHouseStock->save()){
            $returnArr['msg'] = '调出仓库库存量更新失败';
            return $returnArr;
        }
        //调入库存量更新
        $inHouseStock = self::find()->where(['warehouseId'=>$inHouseId,'goodsId'=>$goodsId,'isValid'=>self::IS_VALID_OK])->one();
        if($inHouseStock === null){
            $inHouseStock = new self();
            $inStockNum = 0;
        }else{
            $inStockNum = $inHouseStock->stockNum;
        }
        $inHouseStock->warehouseId = $inHouseId;
        $inHouseStock->goodsId = $goodsId;
        $inHouseStock->stockNum = $inStockNum + $updateNum;
        if(!$inHouseStock->save()){
            $returnArr['msg'] = '调入仓库库存量更新失败';
            return $returnArr;
        }
        //拨入库存记录更新
        $inStockRecord = new StockRecordModel();
        $inStockRecord->warehouseId = $inHouseId;
        $inStockRecord->goodsId = $goodsId;
        $inStockRecord->num = $num;
        $inStockRecord->pice = $price;
        $inStockRecord->type = StockRecordModel::TYPE_DIAL_IN;
        $inStockRecord->unionId = $allocationId;
        $inStockRecord->remark = $remark;
        $inStockRecord->userName = $userName;
        $inStockRecord->date = $date;
        if(!$inStockRecord->save()){
            $returnArr['msg'] = '拨入库存记录表更新失败';
            return $returnArr;
        }
        //拨出库存记录表更新
        $outStockRecord = new StockRecordModel();
        $outStockRecord->warehouseId = $outHouseId;
        $outStockRecord->goodsId = $goodsId;
        $outStockRecord->num = $num;
        $outStockRecord->pice = $price;
        $outStockRecord->type = StockRecordModel::TYPE_ALLOCATE;
        $outStockRecord->unionId = $allocationId;
        $outStockRecord->remark = $remark;
        $outStockRecord->userName = $userName;
        $outStockRecord->date = $date;
        if(!$outStockRecord->save()){
            $returnArr['msg'] = '拨出库存记录表更新失败';
            return $returnArr;
        }
        $returnArr['code'] = Code::SUCCESS;
        $returnArr['msg'] = '保存成功';
        return $returnArr;
    }
    
}
