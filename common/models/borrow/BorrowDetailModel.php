<?php
/**
 * @Author: jinyanxin
 * @Date: 2020/2/12
 * @Time: 15:21
 * 领用，退领详情表
 */


namespace common\models\borrow;


use backend\actions\area\UpdateAction;
use common\library\helper\Code;
use common\models\BaseForm;
use common\models\BaseModel;
use common\models\goods\GoodsModel;
use common\models\stock\StockModel;
use common\models\stock\StockRecordModel;

class BorrowDetailModel extends BaseModel
{

    public static function tableName()
    {
        return 'jxt_jxc_borrow_detail';
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
    public static function saveData($houseId,$data,$borrowId,$type,$remark,$userName,$date)
    {
        $returnArr = ['code'=>Code::PARAM_ERR,'msg'=>'保存失败'];
        if(count($data) > 0){
            //得到之前的记录
            $detail = self::getByBorrowId($borrowId);
            $detailList = count($detail) > 0 ? array_combine(array_column($detail,'borrowDetailId'),$detail) : [];
            $detailIds = count($detail) > 0 ? array_column($detail,'borrowDetailId') : [];
            $existStockRecord = StockRecordModel::find()->where(['warehouseId'=>$houseId,'type'=>$type,'unionId'=>$borrowId,'isValid'=>StockRecordModel::IS_VALID_OK])->asArray()->all();
            $existStockRecordIds = count($existStockRecord) > 0 ? array_column($existStockRecord,'stockRecordId') : [];
            foreach($data as $dataInfo){
                $detailId = intval($dataInfo['detailId']);
                $goodsId = intval($dataInfo['goodsId']);
                $goodsInfo = GoodsModel::getById($goodsId,true);
                if(empty($goodsInfo)){
                    $returnArr['msg'] = '商品不存在';
                    break;
                }
                $goodsName = $goodsInfo['goodsName'];
                $num = intval($dataInfo['num']);
                $price = BaseForm::amountToCent($dataInfo['price']);
                if($detailId > 0){
                    $detailInfo = self::getById($detailId,false);
                    if($detailInfo === null){
                        $returnArr['msg'] = '详情不存在';
                        break;
                    }
                    //编辑时，库存修改的数量
                    $updateNum = $num - $detailInfo->num;
                    $detailIds = array_diff($detailIds,[$detailId]);
                }else{
                    $detailInfo = new self();
                    $updateNum = $num;
                }
                $detailInfo->borrowId = $borrowId;
                $detailInfo->goodsId = $goodsId;
                $detailInfo->num = $num;
                $detailInfo->price = $price;
                if(!$detailInfo->save()){
                    $returnArr['msg'] = '详情保存失败';
                    break;
                }
                //更新库存，保存库存记录
                $stock = StockModel::find()->where(['warehouseId'=>$houseId,'goodsId'=>$goodsId])->one();
                if($stock === null){
                    $returnArr['msg'] = $goodsName.'商品没有库存';
                    break;
                }
                if($type === BorrowModel::TYPE_COLLAR_USE){
                    //领用
                    if(($stock->stockNum - $updateNum) < 0){
                        $returnArr['msg'] = $goodsName.'商品库存不够';
                        break;
                    }
                    $stock->stockNum = $stock->stockNum - $updateNum;
                }else if($type === BorrowModel::TYPE_WITHDRAWAL_OF_COLLAR){
                    //退领
                    $stock->stockNum = $stock->stockNum + $updateNum;
                }else{
                    $returnArr['msg'] = '类型错误';
                    break;
                }
                if(!$stock->save()){
                    $returnArr['msg'] = '库存更新失败';
                    break;
                }
                //添加库存记录
                if($type === BorrowModel::TYPE_COLLAR_USE){
                    $stockRecordType = StockRecordModel::TYPE_COLLAR_USE;
                }else if($type === BorrowModel::TYPE_WITHDRAWAL_OF_COLLAR){
                    $stockRecordType = StockRecordModel::TYPE_WITHDRAWAL_OF_COLLAR;
                }else{
                    $returnArr['msg'] = '类型错误';
                    break;
                }
                $stockRecord = StockRecordModel::find()->where(['warehouseId'=>$houseId,'goodsId'=>$goodsId,'type'=>$stockRecordType,'unionId'=>$borrowId])->one();
                if($stockRecord === null){
                    $stockRecord = new StockRecordModel();
                }
                $stockRecord->warehouseId = $houseId;
                $stockRecord->goodsId = $goodsId;
                $stockRecord->num = $num;
                $stockRecord->pice = $price;
                $stockRecord->type = $stockRecordType;
                $stockRecord->unionId = $borrowId;
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
                StockRecordModel::updateAll(['isValid'=>self::IS_VALID_NO],['stockRecordId'=>$existStockRecordIds]);
            }
            if(count($detailIds) > 0){//编辑时，一条报损记录中，如果某个商品在这条进货记录中删掉，那么，之前这个商品的进货记录也需要删掉，库存需要更新
                //更新库存
                foreach($detailIds as $item){
                    if(isset($detailList[$item])){
                        $goodsId = $detailList[$item]['goodsId'];
                        $num = $detailList[$item]['num'];
                        $stock = StockModel::find()->where(['warehouseId'=>$houseId,'goodsId'=>$goodsId,'isValid'=>StockModel::IS_VALID_OK])->one();
                        if(!empty($stock)){
                            $stock->stockNum = $stock->stockNum + $num;
                            if(!$stock->save()){
                                $returnArr['code'] = Code::PARAM_ERR;
                                $returnArr['msg'] = '编辑时,更新库存失败';
                                break;
                            }
                        }
                    }
                }
                self::updateAll(['isValid'=>self::IS_VALID_NO],['borrowDetailId'=>$detailIds]);
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
            $goodsIds = array_column($data,'goodsId');
            $goods = GoodsModel::getByIdList($goodsIds);
            foreach($data as $dataInfo){
                $info = [
                    'detailId'=>intval($dataInfo['borrowDetailId']),
                    'goodsId'=>intval($dataInfo['goodsId']),
                    'num'=>intval($dataInfo['num']),
                    'price'=>BaseForm::amountToYuan(intval($dataInfo['price'])),
                    'amount'=>BaseForm::amountToYuan(intval($dataInfo['num']) * intval($dataInfo['price'])),
                    'goodsName'=>'',
                    'attr'=>'',
                    'unit'=>'',
                ];
                $totalAmount += $info['amount'];
                if(isset($goods[$dataInfo['goodsId']])){
                    $goodsInfo = $goods[$dataInfo['goodsId']];
                    $info['goodsName'] = $goodsInfo['goodsName'];
                    $info['attr'] = $goodsInfo['attr'];
                    $info['unit'] = $goodsInfo['unit'];
                }
                $showList[] = $info;
            }
            $returnArr['showList'] = $showList;
            $returnArr['amount'] = $totalAmount;
        }
        return $returnArr;
    }

}