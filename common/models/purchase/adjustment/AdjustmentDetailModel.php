<?php
/**
 * @Author: jinyanxin
 * @Date: 2020/2/13
 * @Time: 8:42
 * 库存调整详情表
 */


namespace common\models\purchase\adjustment;


use common\library\helper\Code;
use common\models\BaseForm;
use common\models\BaseModel;
use common\models\goods\GoodsModel;
use common\models\purchase\GoodsStockModel;
use common\models\purchase\StockRecordModel;
use common\models\workingProcedure\GoodsWorkingProcedureModel;

class AdjustmentDetailModel  extends BaseModel
{

    public static function tableName()
    {
        return 'kj_goods_adjustment_detail';
    }

    public static function getById($id,$isArr = true)
    {
        $info = self::find()->where(['adjustmentDetailId'=>$id,'isValid'=>self::IS_VALID_OK]);
        if($isArr === true){
            $info->asArray();
        }
        return $info->one();
    }

    //根据主表主键id得到数据
    public static function getDataByAdjustmentId($adjustmentId)
    {
        $data = self::find()->where(['adjustmentId'=>$adjustmentId,'isValid'=>self::IS_VALID_OK])->asArray()->all();
        return $data;
    }

    //保存数据
    public static function saveData($houseId,$adjustmentId,$data,$remark,$userName,$date,$goodsType)
    {
        $returnArr = ['code'=>Code::PARAM_ERR,'msg'=>'保存失败'];
        if(count($data) > 0){
            $type = StockRecordModel::TYPE_INVA;
            //得到之前的记录
            $detail = self::getDataByAdjustmentId($adjustmentId);
            $detailList = count($detail) > 0 ? array_combine(array_column($detail,'adjustmentDetailId'),$detail) : [];
            $detailIds = count($detail) > 0 ? array_column($detail,'adjustmentDetailId') : [];
            $existStockRecord = StockRecordModel::find()->where(['wareHouseId'=>$houseId,'type'=>$type,'unionId'=>$adjustmentId,'isValid'=>StockRecordModel::IS_VALID_OK])->asArray()->all();
            $existStockRecordIds = count($existStockRecord) > 0 ? array_column($existStockRecord,'stockRecordId') : [];
            foreach($data as $dataInfo){
                $detailId = intval($dataInfo['detailId']);
                $goodsId = intval($dataInfo['goodsId']);
                $workingId = intval($dataInfo['workingId']);
                $num = $dataInfo['num'];
                $price = BaseForm::amountToCent($dataInfo['price']);
                if($detailId > 0){
                    $detailInfo = self::getById($detailId,false);
                    if($detailInfo === null){
                        $returnArr['msg'] = '详情记录不存在';
                        break;
                    }
                    $updateNum = $num - $detailInfo->num;
                    $detailIds = array_diff($detailIds,[$detailId]);
                }else{
                    $detailInfo = new self();
                    $updateNum = $num;
                }
                $detailInfo->goodsType = $goodsType;
                $detailInfo->adjustmentId = $adjustmentId;
                $detailInfo->goodsId = $goodsId;
                $detailInfo->workingId = $workingId;
                $detailInfo->num = $num;
                $detailInfo->price = $price;
                if(!$detailInfo->save()){
                    $returnArr['msg'] = '详情记录保存失败';
                    break;
                }
                //更新库存
                $stock = GoodsStockModel::find()->where(['wareHouseId'=>$houseId,'goodsId'=>$goodsId,'workingId'=>$workingId,'isValid'=>GoodsStockModel::IS_VALID_OK])->one();
                if($stock === null){
                    $returnArr['msg'] = '库存不存在';
                    break;
                }
                $stock->num = $num;
                if($stock->num < 0  || !$stock->save() ){
                    $returnArr['msg'] = '库存更新失败';
                    break;
                }
                //添加库存记录
                $stockRecord = StockRecordModel::find()->where(['wareHouseId'=>$houseId,'goodsId'=>$goodsId,'workingId'=>$workingId,'type'=>StockRecordModel::TYPE_INVA,'unionId'=>$adjustmentId,'isValid'=>StockRecordModel::IS_VALID_OK])->one();
                if($stockRecord === null){
                    $stockRecord = new StockRecordModel();
                }
                $stockRecord->goodsType = $goodsType;
                $stockRecord->wareHouseId = $houseId;
                $stockRecord->goodsId = $goodsId;
                $stockRecord->workingId = $workingId;
                $stockRecord->num = $stockRecord->num + $num;
                $stockRecord->price = $price;
                $stockRecord->type = StockRecordModel::TYPE_INVA;
                $stockRecord->unionId = $adjustmentId;
                $stockRecord->remark = $remark;
                $stockRecord->userName = $userName;
                $stockRecord->date = $date;
                if(!$stockRecord->save()){
                    $returnArr['msg'] = '库存记录保存失败';
                    break;
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
                /*foreach($detailIds as $item){
                    if(isset($detailList[$item])){
                        $goodsId = $detailList[$item]['goodsId'];
                        //根据库存记录的数据得到库存
                        $num = StockRecordModel::getNumByHouseIdAndGoodsId($houseId,$goodsId);
                        $stock = GoodsStockModel::find()->where(['wareHouseId'=>$houseId,'goodsId'=>$goodsId,'isValid'=>GoodsStockModel::IS_VALID_OK])->one();
                        if(!empty($stock)){
                            $stock->num = $num;
                            if(!$stock->save()){
                                $returnArr['code'] = Code::PARAM_ERR;
                                $returnArr['msg'] = '库存调整编辑时,更新库存失败';
                                break;
                            }
                        }
                    }
                }*/
                self::updateAll(['isValid'=>self::IS_VALID_NO,'updateTime'=>date('Y-m-d H:i:s')],['adjustmentDetailId'=>$detailIds]);
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
                    'detailId'=>intval($dataInfo['adjustmentDetailId']),
                    'goodsId'=>intval($dataInfo['goodsId']),
                    'workingId'=>intval($dataInfo['workingId']),
                    'num'=>$dataInfo['num'],
                    'price'=>BaseForm::amountToYuan(intval($dataInfo['price'])),
                    'amount'=>BaseForm::amountToYuan($dataInfo['num'] * intval($dataInfo['price'])),
                    'goodsName'=>'',
                    'workingName'=>isset($working[$dataInfo['workingId']]) ? $working[$dataInfo['workingId']]['name'] : '',
                    'unit'=>'',
                    'attr'=>''
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