<?php
/**
 * @Author: jinyanxin
 * @Date: 2020/2/12
 * @Time: 15:21
 * 领用，退领详情表
 */


namespace common\models\purchase\borrow;

use common\library\helper\Code;
use common\models\BaseForm;
use common\models\BaseModel;
use common\models\goods\GoodsMaterialModel;
use common\models\goods\GoodsModel;
use common\models\purchase\GoodsStockModel;
use common\models\purchase\StockRecordModel;
use common\models\workingProcedure\GoodsWorkingProcedureModel;
use yii\db\Exception;

class BorrowDetailModel extends BaseModel
{

    public static function tableName()
    {
        return 'kj_goods_borrow_detail';
    }

    public static function getById($id,$isArr = true)
    {
        $info = self::find()->where(['borrowDetailId'=>$id,'isValid'=>self::IS_VALID_OK]);
        if($isArr === true){
            $info->asArray();
        }
        return $info->one();
    }

    //根据主表id得到数据
    public static function getByBorrowId($borrowId)
    {
        $data = self::find()->where(['borrowId'=>$borrowId,'isValid'=>self::IS_VALID_OK])->asArray()->all();
        return $data;
    }

    //保存数据
    public static function saveData($houseId,$data,$borrowId,$type,$remark,$userName,$date,$goodsType)
    {
        $returnArr = ['code'=>Code::PARAM_ERR,'msg'=>'保存失败'];
        if(count($data) > 0){
            if($type === BorrowModel::TYPE_COLLAR_USE){
                $stockRecordType = StockRecordModel::TYPE_COLLAR_USE;
            }else if($type === BorrowModel::TYPE_WITHDRAWAL_OF_COLLAR){
                $stockRecordType = StockRecordModel::TYPE_WITHDRAWAL_OF_COLLAR;
            }else{
                $returnArr['msg'] = '类型错误';
                return $returnArr;
            }
            //得到之前的记录
            $detail = self::getByBorrowId($borrowId);
            $detailList = count($detail) > 0 ? array_combine(array_column($detail,'borrowDetailId'),$detail) : [];
            $detailIds = count($detail) > 0 ? array_column($detail,'borrowDetailId') : [];
            $existStockRecordIds = StockRecordModel::getByUnionIdAndType($stockRecordType,$borrowId,$houseId);
            $goods = GoodsModel::getAllData();
            foreach($data as $dataInfo){
                if(!isset($goods[$dataInfo['goodsId']])){
                    $returnArr['msg'] = '产品不存在';
                    return $returnArr;
                }
                $goodsInfo = $goods[$dataInfo['goodsId']];
                $detailId = intval($dataInfo['detailId']);
                $goodsId = intval($dataInfo['goodsId']);
                $workingId = intval($dataInfo['workingId']);
                $goodsName = $goodsInfo['name'];
                $num = $dataInfo['num'];
                $price = BaseForm::amountToCent($dataInfo['price']);
                if($detailId > 0){
                    $detailInfo = self::getById($detailId,false);
                    if($detailInfo === null){
                        $returnArr['msg'] = '详情不存在';
                        return $returnArr;
                    }
                    //编辑时，库存修改的数量
                    $updateNum = $num - $detailInfo->num;
                    $detailIds = array_diff($detailIds,[$detailId]);
                }else{
                    $detailInfo = new self();
                    $updateNum = $num;
                }
                $detailInfo->goodsType = $goodsType;
                $detailInfo->borrowId = $borrowId;
                $detailInfo->goodsId = $goodsId;
                $detailInfo->workingId = $workingId;
                $detailInfo->num = $num;
                $detailInfo->price = $price;
                if(!$detailInfo->save()){
                    $returnArr['msg'] = '详情保存失败';
                    return $returnArr;
                }
                //更新库存，保存库存记录
                $stock = GoodsStockModel::find()->where(['wareHouseId'=>$houseId,'goodsId'=>$goodsId,'workingId'=>$workingId,'isValid'=>GoodsStockModel::IS_VALID_OK])->one();
                if(empty($stock)){
                    $stock = new GoodsStockModel();
                }
                $stock->wareHouseId = $houseId;
                $stock->goodsId = $goodsId;
                $stock->workingId = $workingId;
                if($type === BorrowModel::TYPE_COLLAR_USE){
                    $stock->num = $stock->num - $updateNum;
                }else if($type === BorrowModel::TYPE_WITHDRAWAL_OF_COLLAR){
                    //退领
                    $stock->num = $stock->num + $updateNum;
                }else{
                    $returnArr['msg'] = '类型错误';
                    return $returnArr;
                }
                if(!$stock->save()){
                    $returnArr['msg'] = '库存更新失败';
                    return $returnArr;
                }
                //添加库存记录
                $stockRecord = StockRecordModel::find()->where(['wareHouseId'=>$houseId,'goodsId'=>$goodsId,'workingId'=>$workingId,'type'=>$stockRecordType,'unionId'=>$borrowId,'isValid'=>StockRecordModel::IS_VALID_OK])->one();
                if($stockRecord === null){
                    $stockRecord = new StockRecordModel();
                }
                $stockRecord->goodsType = $goodsType;
                $stockRecord->wareHouseId = $houseId;
                $stockRecord->goodsId = $goodsId;
                $stockRecord->workingId = $workingId;
                $stockRecord->num = $num;
                $stockRecord->price = $price;
                $stockRecord->type = $stockRecordType;
                $stockRecord->unionId = $borrowId;
                $stockRecord->remark = $remark;
                $stockRecord->userName = $userName;
                $stockRecord->date = $date;
                $stockRecord->isValid = StockRecordModel::IS_VALID_OK;
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
                        $stock = GoodsStockModel::find()->where(['wareHouseId'=>$houseId,'goodsId'=>$goodsId,'workingId'=>$workingId,'isValid'=>GoodsStockModel::IS_VALID_OK])->one();
                        if(empty($stock)){
                            $stock = new GoodsStockModel();
                        }
                        $stock->wareHouseId = $houseId;
                        $stock->goodsId = $goodsId;
                        $stock->workingId = $workingId;
                        if($type === BorrowModel::TYPE_COLLAR_USE){
                            $stock->num = $stock->num + $num;
                        }else if($type === BorrowModel::TYPE_WITHDRAWAL_OF_COLLAR){
                            //退领
                            $stock->num = $stock->num - $num;
                        }else{
                            $returnArr['msg'] = '类型错误';
                            return $returnArr;
                        }
                        if(!$stock->save()){
                            $returnArr['msg'] = '编辑时，库存更新失败';
                            return $returnArr;
                        }
                    }
                }
                self::updateAll(['isValid'=>self::IS_VALID_NO,'updateTime'=>date('Y-m-d H:i:s')],['borrowDetailId'=>$detailIds]);
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
                    'detailId'=>intval($dataInfo['borrowDetailId']),
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