<?php
/**
 * @Author: jinyanxin
 * @Date: 2020/2/11
 * @Time: 10:47
 * 调拨主表
 */


namespace common\models\purchase\allocation;


use common\library\helper\Code;
use common\models\BaseModel;
use common\models\goods\GoodsModel;
use common\models\purchase\GoodsStockModel;
use common\models\purchase\StockRecordModel;
use common\models\purchase\WarehouseModel;
use yii\db\Exception;

class AllocationModel extends BaseModel
{

    public static function tableName()
    {
        return 'kj_goods_allocation';
    }

    public static function getById($id,$isArr=true)
    {
        $info = self::find()->where(['allocationId'=>$id,'isValid'=>self::IS_VALID_OK]);
        if($isArr === true){
            $info->asArray();
        }
        return $info->one();
    }

    /*
     * 根据id删除数据
     * 调拨主表，调拨详情表删除记录
     * 库存表修改调入仓库，调出仓库的库存，删除库存记录
     * */
    public static function delById($id)
    {
        $bol = true;
        $allocation = AllocationModel::getById($id,true);
        $transaction = \Yii::$app->db->beginTransaction();
        try{
            $inHouseId = intval($allocation['enterwareHouseId']);
            $outHouseId = intval($allocation['outwareHouseId']);
            $detail = AllocationDetailModel::getDataByAllocationId($id);
            if(count($detail) > 0){
                foreach($detail as $detailInfo){
                    $goodsId = intval($detailInfo['goodsId']);
                    $goods = GoodsModel::getById($goodsId);
                    if(!empty($goods)){
                        $num = intval($detailInfo['num']);
                        $inStock = GoodsStockModel::find()->where(['wareHouseId'=>$inHouseId,'goodsId'=>$goodsId])->one();
                        if($inStock === null){
                            throw new Exception('---调入库存记录无---');
                        }
                        $inStock->num = $inStock->num - $num;
                        if(!$inStock->save()){
                            throw new Exception('---调入库存更新失败---');
                        }
                        if(intval($inStock->num) < 0){
                            throw  new \Exception('记录删除后库存小于0，删除失败');
                            break;
                        }
                        $outStock = GoodsStockModel::find()->where(['wareHouseId'=>$outHouseId,'goodsId'=>$goodsId])->one();
                        if($outStock === null){
                            throw new Exception('---调出库存记录无---');
                        }
                        $outStock->num = $outStock->num + $num;
                        if(intval($outStock->num) < 0){
                            throw  new \Exception('记录删除后库存小于0，删除失败');
                            break;
                        }
                        if(!$outStock->save()){
                            throw new Exception('---调出库存更新失败---');
                        }
                    }
                }
            }
            //删除调拨表记录
            AllocationModel::updateAll(['isValid'=>AllocationModel::IS_VALID_NO,'updateTime'=>date('Y-m-d H:i:s')],['allocationId'=>$id]);
            AllocationDetailModel::updateAll(['isValid'=>AllocationDetailModel::IS_VALID_NO,'updateTime'=>date('Y-m-d H:i:s')],['allocationId'=>$id]);
            //删除库存记录
            StockRecordModel::updateAll(['isValid'=>StockRecordModel::IS_VALID_NO,'updateTime'=>date('Y-m-d H:i:s')],['unionId'=>$id,'type'=>StockRecordModel::TYPE_DIAL_IN]);
            StockRecordModel::updateAll(['isValid'=>StockRecordModel::IS_VALID_NO,'updateTime'=>date('Y-m-d H:i:s')],['unionId'=>$id,'type'=>StockRecordModel::TYPE_ALLOCATE]);
            $transaction->commit();
        }catch (\Exception $e){
            $transaction->rollBack();
            \Yii::info('----allocation del fail error msg'.$e->getMessage());
            $bol = false;
            return ['bol'=>$bol,'msg'=>$e->getMessage()];
        }
        return ['bol'=>$bol,'msg'=>'ok'];
    }

    /*
     * 格式化数据
     * */
    public static function format($data)
    {
        $house = WarehouseModel::getAllHouse();
        $returnArr = [];
        foreach($data as $item){
            $info = [
                'id'=>intval($item['allocationId']),
                'date'=> $item['date'],
                'userName'=>$item['userName'],
                'remark'=>$item['remark'],
                'createTime'=>$item['createTime'],
                'outHouse'=>'',
                'inHouse'=>'',
                'outHouseId'=>intval($item['outwareHouseId']),
                'inHouseId'=>intval($item['enterwareHouseId'])
            ];
            if(isset($house[$item['outwareHouseId']])){
                $info['outHouse'] = $house[$item['outwareHouseId']]['warehouseName'];
            }
            if(isset($house[$item['enterwareHouseId']])){
                $info['inHouse'] = $house[$item['enterwareHouseId']]['warehouseName'];
            }
            $returnArr[] = $info;
        }
        return $returnArr;
    }

    /*
     * 调拨数据保存
     *  查看商品在调出仓库中是否存在
     *      若不存在 报错返回
     *      若存在
     *          查看调拨的数量是否小于等于库存量
     *          若大于库存量 报错返回
     *          若小于库存量
     *                    调拨表，调拨详情表添加记录，该商品的调出仓库的库存量 减少 更新，调入仓库的库存量 增加 更新，库存记录表保存记录
     * */
    public static function saveData($allocationId,$data,$outHouseId,$inHouseId,$remark,$userName,$date,$goodsType)
    {
        $returnArr = ['code'=>Code::PARAM_ERR,'msg'=>'保存失败'];
        if(count($data) > 0){
            $transaction = \Yii::$app->db->beginTransaction();
            try{
                if($allocationId > 0){
                    $allocationInfo = self::getById($allocationId,false);
                    if($allocationInfo === null){
                        throw  new Exception('---调拨记录不存在----');
                    }
                }else{
                    $allocationInfo = new self();
                }
                $allocationInfo->goodsType = $goodsType;
                $allocationInfo->sn = date('YmdHis');
                $allocationInfo->outwareHouseId = $outHouseId;
                $allocationInfo->enterwareHouseId = $inHouseId;
                $allocationInfo->remark = $remark;
                $allocationInfo->userName = $userName;
                $allocationInfo->date = $date;
                if(!$allocationInfo->save()){
                    throw new Exception('---调拨记录保存失败---');
                }
                $allocationId = $allocationInfo->allocationId;
                \Yii::info('-------save allocationInfo success-----');
                //保存调拨详情
                $saveDetail = AllocationDetailModel::saveData($data,$allocationId,$outHouseId,$inHouseId,$remark,$userName,$date,$goodsType);
                if($saveDetail['code'] !== Code::SUCCESS){
                    throw  new Exception('---调拨时，库存更新失败---');
                }
                $transaction->commit();
                \Yii::info('-----success allocation ---------');
                $returnArr['code'] = Code::SUCCESS;
                $returnArr['msg'] = '保存成功';
            }catch (\Exception $e){
                $transaction->rollBack();
                \Yii::info('----save allocation fail msg'.$e->getMessage().'---file-'.$e->getFile().'---line-'.$e->getLine());
            }
        }
        return $returnArr;
    }

}