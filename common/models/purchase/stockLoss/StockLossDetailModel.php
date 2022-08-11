<?php
/**
 * @Author: jinyanxin
 * @Date: 2020/2/12
 * @Time: 8:50
 * 报损详情表
 */


namespace common\models\purchase\stockLoss;


use common\library\helper\Code;
use common\models\BaseForm;
use common\models\BaseModel;
use common\models\goods\GoodsMaterialModel;
use common\models\goods\GoodsModel;
use common\models\purchase\GoodsStockModel;
use common\models\purchase\StockRecordModel;
use common\models\workingProcedure\GoodsWorkingProcedureModel;
use yii\db\Exception;

class StockLossDetailModel extends BaseModel
{

    public static function tableName()
    {
        return 'kj_goods_stock_loss_detail';
    }

    //根据id得到数据
    public static function getById($id,$isArr = false)
    {
        $info = self::find()->where(['stockLossDetailId'=>$id,'isValid'=>self::IS_VALID_OK]);
        if($isArr === true){
            $info->asArray();
        }
        return $info->one();
    }

    //根据报损主表id得到数据
    public static function getDataByStockLossId($stockLossId)
    {
        $data = self::find()->where(['stockLossId'=>$stockLossId,'isValid'=>self::IS_VALID_OK])->asArray()->all();
        return $data;
    }

    //保存数据
    public static function saveData($stockLossId,$data,$houseId,$remark,$userName,$date,$goodsType)
    {
        $returnArr = ['code'=>Code::PARAM_ERR,'msg'=>'保存失败'];
        if(count($data) > 0){
            $type = StockRecordModel::TYPE_REPORT_LOSS;
            //得到之前的记录
            $detail = self::getDataByStockLossId($stockLossId);
            $detailList = count($detail) > 0 ? array_combine(array_column($detail,'stockLossDetailId'),$detail) : [];
            $detailIds = count($detail) > 0 ? array_column($detail,'stockLossDetailId') : [];
            $existStockRecord = StockRecordModel::find()->where(['wareHouseId'=>$houseId,'type'=>$type,'unionId'=>$stockLossId,'isValid'=>StockRecordModel::IS_VALID_OK])->asArray()->all();
            $existStockRecordIds = count($existStockRecord) > 0 ? array_column($existStockRecord,'stockRecordId') : [];
            $goods = GoodsModel::find()->where(['isValid'=>GoodsModel::IS_VALID_OK])->indexBy('id')->asArray()->all();
            foreach($data as $dataInfo){
                if(!isset($goods[$dataInfo['goodsId']])){
                    $returnArr['msg'] = '产品不存在';
                    return $returnArr;
                }
                $goodsInfo = $goods[$dataInfo['goodsId']];
                $detailId = intval($dataInfo['detailId']);
                $goodsId = intval($dataInfo['goodsId']);
                $workingId = intval($dataInfo['workingId']);
                $num = $dataInfo['num'];
                $price = BaseForm::amountToCent($dataInfo['price']);
                if($detailId > 0){
                    $detailInfo = self::getById($detailId,false);
                    if($detailInfo === null){
                        $returnArr['msg'] = '报损详情不存在';
                        return $returnArr;
                    }
                    $detailIds = array_diff($detailIds,[$detailId]);
                    $updateNum = $num - $detailInfo['num'] ;
                }else{
                    $detailInfo = new self();
                    $updateNum = $num;
                }
                $detailInfo->goodsType = $goodsType;
                $detailInfo->stockLossId = $stockLossId;
                $detailInfo->goodsId = $goodsId;
                $detailInfo->workingId = $workingId;
                $detailInfo->num = $num;
                $detailInfo->price = $price;
                if(!$detailInfo->save()){
                    $returnArr['msg'] = '报损详情保存失败';
                    return $returnArr;
                }
                //更新库存
                $stock = GoodsStockModel::find()->where(['wareHouseId'=>$houseId,'goodsId'=>$goodsId,'workingId'=>$workingId,'isValid'=>self::IS_VALID_OK])->one();
                if(empty($stock)){
                    $stock = new GoodsStockModel();
                }
                $stock->goodsId = $goodsId;
                $stock->wareHouseId = $houseId;
                $stock->workingId =$workingId;
                $stock->num = $stock->num - $updateNum;
                if(!$stock->save()){
                    $returnArr['msg'] = '报损库存更新失败';
                    return $returnArr;
                }
                //保存 库存记录
                $stockRecord = StockRecordModel::find()->where(['wareHouseId'=>$houseId,'goodsId'=>$goodsId,'workingId'=>$workingId,'unionId'=>$stockLossId,'type'=>StockRecordModel::TYPE_REPORT_LOSS,'isValid'=>StockRecordModel::IS_VALID_OK])->one();
                if($stockRecord === null){
                    $stockRecord = new StockRecordModel();
                }
                $stockRecord->goodsType = $goodsType;
                $stockRecord->wareHouseId = $houseId;
                $stockRecord->goodsId = $goodsId;
                $stockRecord->workingId = $workingId;
                $stockRecord->num = $num;
                $stockRecord->price = $price;
                $stockRecord->type = StockRecordModel::TYPE_REPORT_LOSS;
                $stockRecord->unionId = $stockLossId;
                $stockRecord->remark = $remark;
                $stockRecord->userName = $userName;
                $stockRecord->date = $date;
                if(!$stockRecord->save()){
                    $returnArr['msg'] = '库存记录保存失败';
                    return $returnArr;
                }
                $stockRecordId = $stockRecord->stockRecordId;
                //判断这个记录id是否存在，若存在，则去掉
                if(in_array($stockRecordId,$existStockRecordIds)){
                    $existStockRecordIds = array_diff($existStockRecordIds,[$stockRecordId]);
                }
            }

            if(count($existStockRecordIds) > 0){
                StockRecordModel::updateAll(['isValid'=>self::IS_VALID_NO,'updateTime'=>date('Y-m-d H:i:s')],['stockRecordId'=>$existStockRecordIds]);
            }
            if(count($detailIds) > 0){//编辑时，一条报损记录中，如果某个商品在这条进货记录中删掉，那么，之前这个商品的进货记录也需要删掉，库存需要更新
                //更新库存
                foreach($detailIds as $item){
                    if(isset($detailList[$item])){
                        if(!isset($goods[$detailList[$item]['goodsId']])){
                            $returnArr['code'] = Code::PARAM_ERR;
                            $returnArr['msg'] = '产品不存在';
                            return $returnArr;
                        }
                        $delGoodsInfo = $goods[$detailList[$item]['goodsId']];
                        $goodsId = $detailList[$item]['goodsId'];
                        $workingId = $detailList[$item]['workingId'];
                        $num = $detailList[$item]['num'];
                        $stock = GoodsStockModel::find()->where(['wareHouseId'=>$houseId,'goodsId'=>$goodsId,'workingId'=>$workingId,'isValid'=>self::IS_VALID_OK])->one();
                        if(empty($stock)){
                            $stock = new GoodsStockModel();
                        }
                        $stock->goodsId = $goodsId;
                        $stock->wareHouseId = $houseId;
                        $stock->workingId =$workingId;
                        $stock->num = $stock->num + $num;
                        if(!$stock->save()){
                            $returnArr['msg'] = '删除报损库存更新失败';
                            return $returnArr;
                        }
                    }
                }
                self::updateAll(['isValid'=>self::IS_VALID_NO,'updateTime'=>date('Y-m-d H:i:s')],['stockLossDetailId'=>$detailIds]);
            }
            $returnArr['code'] = Code::SUCCESS;
            $returnArr['msg'] = '保存成功';
        }
        return $returnArr;
    }

    //格式化数据
    public static function format($data)
    {
        $returnArr = ['showList'=>[],'amount'=>0.00];
        if(count($data) > 0){
            $showList = [];
            $totalAmount = 0;
            $goodsIds = array_unique(array_column($data,'goodsId'));
            $goods = GoodsModel::getByIdList($goodsIds);
            $workingIds = array_unique(array_column($data,'workingId'));
            $working = GoodsWorkingProcedureModel::getByIdList($workingIds);
            foreach($data as $dataInfo){
                $info = [
                    'detailId'=>intval($dataInfo['stockLossDetailId']),
                    'goodsId'=>intval($dataInfo['goodsId']),
                    'workingId'=>intval($dataInfo['workingId']),
                    'num'=>$dataInfo['num'],
                    'price'=>BaseForm::amountToYuan(intval($dataInfo['price'])),
                    'amount'=>BaseForm::amountToYuan($dataInfo['num'] * intval($dataInfo['price'])),
                    'goodsName'=>'',
                    'workingName'=>isset($working[$dataInfo['workingId']]) ? $working[$dataInfo['workingId']]['name'] : '',
                    'unit'=>'',
                    'attr'=>'',
                ];
                $totalAmount += $info['amount'];
                if(isset($goods[$dataInfo['goodsId']])){
                    $goodsInfo = $goods[$dataInfo['goodsId']];
                    $info['goodsName'] = $goodsInfo['name'];
                    $info['unit'] = $goodsInfo['unit'];
                    $info['attr'] = $goodsInfo['attr'];
                }
                $showList[] = $info;
            }
            $returnArr['showList'] = $showList;
            $returnArr['amount'] = $totalAmount;
        }
        return $returnArr;
    }

}