<?php
/**
 * @Author: jinyanxin
 * @Date: 2020/2/12
 * @Time: 8:50
 * 报损详情表
 */


namespace common\models\stock;


use common\library\helper\Code;
use common\models\BaseForm;
use common\models\BaseModel;
use common\models\goods\GoodsModel;
use Faker\Provider\Base;

class StockLossDetailModel extends BaseModel
{

    public static function tableName()
    {
        return 'jxt_jxc_stock_loss_detail';
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
    public static function saveData($stockLossId,$data,$houseId,$remark,$userName,$date)
    {
        $returnArr = ['code'=>Code::PARAM_ERR,'msg'=>'保存失败'];
        if(count($data) > 0){
            $type = StockRecordModel::TYPE_REPORT_LOSS;
            //得到之前的记录
            $detail = self::getDataByStockLossId($stockLossId);

            $detailList = count($detail) > 0 ? array_combine(array_column($detail,'stockLossDetailId'),$detail) : [];
            $detailIds = count($detail) > 0 ? array_column($detail,'stockLossDetailId') : [];
            $existStockRecord = StockRecordModel::find()->where(['warehouseId'=>$houseId,'type'=>$type,'unionId'=>$stockLossId,'isValid'=>StockRecordModel::IS_VALID_OK])->asArray()->all();
            $existStockRecordIds = count($existStockRecord) > 0 ? array_column($existStockRecord,'stockRecordId') : [];
            foreach($data as $dataInfo){
                $detailId = intval($dataInfo['detailId']);
                $goodsId = intval($dataInfo['goodsId']);
                $num = intval($dataInfo['num']);
                $price = BaseForm::amountToCent($dataInfo['price']);
                if($detailId > 0){
                    $detailInfo = self::getById($detailId,false);
                    if($detailInfo === null){
                        $returnArr['msg'] = '报损详情不存在';
                        break;
                    }
                    $detailIds = array_diff($detailIds,[$detailId]);
                    $updateNum = $num - $detailInfo['num'] ;
                }else{
                    $detailInfo = new self();
                    $updateNum = $num;
                }
                $detailInfo->stockLossId = $stockLossId;
                $detailInfo->goodsId = $goodsId;
                $detailInfo->num = $num;
                $detailInfo->price = $price;
                if(!$detailInfo->save()){
                    $returnArr['msg'] = '报损详情保存失败';
                    break;
                }
                //更新库存记录
                $stock = StockModel::find()->where(['warehouseId'=>$houseId,'goodsId'=>$goodsId,'isValid'=>self::IS_VALID_OK])->one();

                if($stock === null){
                    $stock = new self();
                    $stockNum = 0 ;
                }else{
                    $stockNum = intval($stock->stockNum);
                }
                if(($stockNum - $updateNum) < 0){
                    return ['code'=>Code::PARAM_ERR,'msg'=>'报损数量大于库存数量'];
                }
                $stock->warehouseId = $houseId;
                $stock->goodsId = $goodsId;
                $stock->stockNum = $stockNum - $updateNum;
                if(!$stock->save()){
                    return ['code'=>Code::PARAM_ERR,'msg'=>'库存更新失败'];
                }
                //保存 库存记录

                $stockRecord = StockRecordModel::find()->where(['warehouseId'=>$houseId,'goodsId'=>$goodsId,'unionId'=>$stockLossId,'type'=>$type,'isValid'=>StockRecordModel::IS_VALID_OK])->one();
                if($stockRecord === null){
                    $stockRecord = new StockRecordModel();
                }
                $stockRecord->warehouseId = $houseId;
                $stockRecord->goodsId = $goodsId;
                $stockRecord->num = $num;
                $stockRecord->pice = $price;
                $stockRecord->type = StockRecordModel::TYPE_REPORT_LOSS;
                $stockRecord->unionId = $stockLossId;
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
                self::updateAll(['isValid'=>self::IS_VALID_NO],['stockLossDetailId'=>$detailIds]);
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
                    'detailId'=>intval($dataInfo['stockLossDetailId']),
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