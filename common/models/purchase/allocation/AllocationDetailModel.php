<?php
/**
 * @Author: jinyanxin
 * @Date: 2020/2/11
 * @Time: 10:48
 * 调拨详情表
 */


namespace common\models\purchase\allocation;


use common\library\helper\Code;
use common\models\BaseForm;
use common\models\BaseModel;
use common\models\goods\GoodsModel;
use common\models\purchase\GoodsStockModel;
use common\models\purchase\StockRecordModel;

class AllocationDetailModel extends BaseModel
{

    public static function tableName()
    {
        return 'kj_goods_allocation_detail';
    }

    //根据id得到数据
    public static function getById($id,$isArr = true)
    {
        $info = self::find()->where(['allocationDetailId'=>$id,'isValid'=>self::IS_VALID_OK]);
        if($isArr === true){
            $info->asArray();
        }
        return $info->one();
    }

    //根据调拨主表id得到数据
    public static function getDataByAllocationId($allocationId)
    {
        $data = self::find()->where(['allocationId'=>$allocationId,'isValid'=>self::IS_VALID_OK])->asArray()->all();
        return $data;
    }

    //格式化数据
    public static function format($data)
    {
        $returnArr = [];
        if(count($data) > 0){
            $goodsIds = array_column($data,'goodsId');
            $goods = GoodsModel::getByIdList($goodsIds);
            foreach($data as $dataInfo){
                $info = [
                    'detailId'=>intval($dataInfo['allocationDetailId']),
                    'goodsId'=>intval($dataInfo['goodsId']),
                    'num'=>$dataInfo['num'],
                    'price'=>BaseForm::amountToYuan(intval($dataInfo['price'])),
                    'amount'=>BaseForm::amountToYuan($dataInfo['num'] * intval($dataInfo['price'])),
                    'goodsName'=>'',
                    'unit'=>'',
                    'attr'=>'',
                ];
                if(isset($goods[$dataInfo['goodsId']])){
                    $goodsInfo = $goods[$dataInfo['goodsId']];
                    $info['goodsName'] = $goodsInfo['name'];
                    $info['unit'] = $goodsInfo['unit'];
                    $info['attr'] = $goodsInfo['attr'];
                }
                $returnArr[] = $info;
            }
        }
        return $returnArr;
    }

    /*
     * 保存详情
     * */
    public static function saveData($data,$allocationId,$outHouseId,$inHouseId,$remark,$userName,$date,$goodsType)
    {
        $returnArr = ['code'=>Code::PARAM_ERR,'msg'=>'保存失败'];
        if(count($data) > 0){
            //得到之前的记录
            $detail = self::getDataByAllocationId($allocationId);
            $detailList = count($detail) > 0 ? array_combine(array_column($detail,'allocationDetailId'),$detail) : [];
            $detailIds = count($detail) > 0 ? array_column($detail,'allocationDetailId') : [];
            //如果是编辑时，删除之前的调拨库存记录
            StockRecordModel::updateAll(['isValid'=>StockRecordModel::IS_VALID_NO,'updateTime'=>date('Y-m-d H:i:s')],['unionId'=>$allocationId,'type'=>[StockRecordModel::TYPE_DIAL_IN,StockRecordModel::TYPE_ALLOCATE]]);
            foreach($data as $dataInfo){
                $detailId = intval($dataInfo['detailId']);
                $goodsId = intval($dataInfo['goodsId']);
                $num = $dataInfo['num'];
                $price = BaseForm::amountToCent($dataInfo['price']);
                if($detailId > 0){
                    $allocationDetailInfo = self::getById($detailId,false);
                    if($allocationDetailInfo === null){
                        $returnArr['msg'] = '调拨详情记录不存在';
                        break;
                    }
                    $updateNum = $num - $allocationDetailInfo->num;
                    $detailIds = array_diff($detailIds,[$detailId]);
                }else{
                    $allocationDetailInfo = new self();
                    $updateNum = $num;
                }
                $allocationDetailInfo->goodsType = $goodsType;
                $allocationDetailInfo->allocationId = $allocationId;
                $allocationDetailInfo->goodsId = $goodsId;
                $allocationDetailInfo->num = $num;
                $allocationDetailInfo->price = $price;
                if(!$allocationDetailInfo->save()){
                    $returnArr['msg'] = '调拨详情记录保存失败';
                    break;
                }
                //更新库存
                $updateStock = GoodsStockModel::updateByAllocation($allocationId,$outHouseId,$inHouseId,$goodsId,$num,$updateNum,$price,$remark,$userName,$date,$goodsType);
                if($updateStock['code'] !== Code::SUCCESS){
                    $returnArr['msg'] = $updateStock['msg'];
                    break;
                }
            }
            if(count($detailIds) > 0){//编辑时，一条进货记录中，如果某个商品在这条进货记录中删掉，那么，之前这个商品的进货记录也需要删掉，库存需要更新
                //更新库存
                foreach($detailIds as $item){
                    if(isset($detailList[$item])){
                        $goodsId = $detailList[$item]['goodsId'];
                        $num = $detailList[$item]['num'];
                        //调入
                        $inStock = GoodsStockModel::find()->where(['warehouseId'=>$inHouseId,'goodsId'=>$goodsId,'isValid'=>GoodsStockModel::IS_VALID_OK])->one();
                        if(!empty($inStock)){
                            $inStock->num = $inStock->num - $num;
                            if(!$inStock->save()){
                                $returnArr['code'] = Code::PARAM_ERR;
                                $returnArr['msg'] = '编辑时,调入更新库存失败';
                                break;
                            }
                        }
                        //调出
                        $outStock = GoodsStockModel::find()->where(['warehouseId'=>$outHouseId,'goodsId'=>$goodsId,'isValid'=>GoodsStockModel::IS_VALID_OK])->one();
                        if(!empty($outStock)){
                            $outStock->num = $outStock->num + $num;
                            if(!$outStock->save()){
                                $returnArr['code'] = Code::PARAM_ERR;
                                $returnArr['msg'] = '编辑时,调出更新库存失败';
                                break;
                            }
                        }
                    }
                }
                self::updateAll(['isValid'=>self::IS_VALID_NO,'updateTime'=>date('Y-m-d H:i:s')],['allocationDetailId'=>$detailIds]);
            }
            $returnArr['code'] = Code::SUCCESS;
            $returnArr['msg'] = '保存成功';
        }
        return $returnArr;
    }

}