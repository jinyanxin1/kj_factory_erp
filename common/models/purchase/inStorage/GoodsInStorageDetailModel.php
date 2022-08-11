<?php
/**
 *
 * author: jinyanxin
 * Date: 2020/11/18
 * Time: 10:57
 * PHP version 7
 * 生产入库详情表
 */

namespace common\models\purchase\inStorage;


use common\library\helper\Code;
use common\models\BaseModel;
use common\models\goods\GoodsMaterialModel;
use common\models\goods\GoodsModel;
use common\models\purchase\consumption\GoodsConsumptionDetailModel;
use common\models\purchase\consumption\GoodsConsumptionModel;
use common\models\purchase\GoodsStockModel;
use common\models\purchase\StockRecordModel;
use Yii;

/**
 * This is the model class for table "kj_goods_in_storage_detail".
 *
 * @property int $storageDetailId 表id
 * @property int|null $workId 职工工单id
 * @property int|null $goodsType 1产品；2物料
 * @property int $storageId 生产入库主表id
 * @property int $goodsId 商品id
 * @property int $workingId 工序id
 * @property int $num 数量
 * @property int $price 进货价格
 * @property string|null $createTime 创建时间
 * @property string|null $creator 创建者
 * @property string|null $updateTime 修改时间
 * @property string|null $updater 修改者
 * @property int|null $isValid 0正常，1删除
 */
class GoodsInStorageDetailModel extends BaseModel
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'kj_goods_in_storage_detail';
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'storageDetailId' => '表id',
            'workId' => '职工工单id',
            'goodsType' => '1产品；2物料',
            'storageId' => '生产入库主表id',
            'goodsId' => '商品id',
            'workingId' => '工序id',
            'num' => '数量',
            'price' => '进货价格',
            'createTime' => '创建时间',
            'creator' => '创建者',
            'updateTime' => '修改时间',
            'updater' => '修改者',
            'isValid' => '0正常，1删除',
        ];
    }


    public static function saveData($houseId,$data,$storageId,$remark,$userName,$date,$staffId)
    {
        $type = StockRecordModel::TYPE_IN_STORAGE;
        $returnArr = ['code'=>Code::PARAM_ERR,'msg'=>'保存失败'];
        if(empty($data)){
            return ['code'=>Code::PARAM_ERR,'msg'=>'产品记录空'];
        }
        //得到之前的记录
        $detail = self::find()->where(['storageId'=>$storageId,'isValid'=>self::IS_VALID_OK])->asArray()->all();
        $detailIds = count($detail) > 0 ? array_column($detail,'storageDetailId') : [];
        $goods = GoodsModel::getAllData();
        //删除之前的流水记录
        StockRecordModel::updateAll(['isValid'=>StockRecordModel::IS_VALID_NO,'updateTime'=>date('Y-m-d H:i:s')],['type'=>StockRecordModel::TYPE_IN_STORAGE,'unionId'=>$storageId]);
        foreach ($data as $dataInfo) {
            if(!isset($goods[$dataInfo['goodsId']])){
                $returnArr['msg'] = '产品不存在';
                return $returnArr;
            }
            $goodsInfo = $goods[$dataInfo['goodsId']];
            $goodsId = intval($dataInfo['goodsId']);
            $goodsName = $goodsInfo['name'];
            $num = $dataInfo['num'];
            $detailInfo = self::find()->where(['storageId'=>$storageId,'goodsId'=>$goodsId,'isValid'=>self::IS_VALID_OK])->one();
            if(empty($detailInfo)){
                $detailInfo = new self();
                $updateNum = $num;
            }else{
                //编辑时，库存修改的数量
                $updateNum = $num - $detailInfo->num;
                $detailIds = array_diff($detailIds,[$detailInfo->storageDetailId]);
            }
            $detailInfo->goodsType = GoodsModel::TYPE_PRODUCTION;
            $detailInfo->storageId = $storageId;
            $detailInfo->goodsId = $goodsId;
            $detailInfo->num = $num;
            $detailInfo->price = 0;
            if(!$detailInfo->save()){
                $returnArr['msg'] = '生产入库详情保存失败';
                return $returnArr;
            }
            //添加流水记录
            $storageStockRecord = StockRecordModel::find()->where(['type'=>StockRecordModel::TYPE_IN_STORAGE,'unionId'=>$storageId,'goodsId'=>$goodsId])->one();
            if(empty($storageStockRecord)){
                $storageStockRecord = new StockRecordModel();
            }
            $storageStockRecord->goodsType = GoodsModel::TYPE_PRODUCTION;
            $storageStockRecord->wareHouseId = $houseId;
            $storageStockRecord->goodsId = $goodsId;
            $storageStockRecord->num = $num;
            $storageStockRecord->price = 0;
            $storageStockRecord->type = StockRecordModel::TYPE_IN_STORAGE;
            $storageStockRecord->unionId = $storageId;
            $storageStockRecord->remark = $remark;
            $storageStockRecord->userName = $userName;
            $storageStockRecord->date = $date;
            if(!$storageStockRecord->save()){
                $returnArr['msg'] = '生产入库流水记录添加失败';
                return $returnArr;
            }
            //更新库存
            $goodsStock = GoodsStockModel::find()->where(['goodsId'=>$goodsId,'wareHouseId'=>$houseId,'isValid'=>GoodsStockModel::IS_VALID_OK])->one();
            if(empty($goodsStock)){
                $goodsStock = new GoodsStockModel();
                $stockNum = 0;
            }else{
                $stockNum = $goodsStock->num;
            }
            $stockNum = $stockNum + $updateNum;
            if($stockNum < 0){
                $returnArr['msg'] = $goodsName.'库存小于0';
                return $returnArr;
            }
            $goodsStock->goodsId = $goodsId;
            $goodsStock->wareHouseId = $houseId;
            $goodsStock->num = $stockNum;
            if(!$goodsStock->save()){
                $returnArr['msg'] = $goodsName.'库存更新失败';
                return $returnArr;
            }
            //减少物料，更新物料库存
            $material = GoodsMaterialModel::find()->where(['goodsId'=>$goodsId,'isValid'=>GoodsMaterialModel::IS_VALID_OK])->asArray()->all();
            if(!empty($material)){
                //增加物料消耗记录
                $consumption = GoodsConsumptionModel::find()->where(['storageId'=>$storageId,'isValid'=>GoodsConsumptionModel::IS_VALID_OK])->one();
                if(empty($consumption)){
                    $consumption = new GoodsConsumptionModel();
                }
                $consumption->goodsType = GoodsModel::TYPE_MATERIEL;
                $consumption->houseId = $houseId;
                $consumption->consumptionDate = $date;
                $consumption->sn = GoodsConsumptionModel::getNumber(GoodsConsumptionModel::SN_PRIX);
                $consumption->totalAmount = 0;
                $consumption->remark = '产品生产消耗物料';
                $consumption->userName = $userName;
                $consumption->staffId = $staffId;
                if(!$consumption->save()){
                    $returnArr['msg'] = '物料消耗保存失败';
                    return $returnArr;
                }
                $consumptionId = $consumption->consumptionId;
                //先删除生产消耗流水记录
                StockRecordModel::updateAll(['isValid'=>StockRecordModel::IS_VALID_NO,'updateTime'=>date('Y-m-d H:i:s')],['type'=>StockRecordModel::TYPE_CONSUMPTION,'unionId'=>$consumptionId]);
                //查看原来存在消耗详情记录
                $existConsumptionDetail = GoodsConsumptionDetailModel::find()->where(['consumptionId'=>$consumptionId,'isValid'=>GoodsConsumptionDetailModel::IS_VALID_OK])
                    ->indexBy('goodsId')->asArray()->all();
                $existConsumptionDetailIds = array_column($existConsumptionDetail,'consumptionDetailId');
                foreach ($material as $materialInfo) {
                    //半成品关联的物料id
                    $materialId = intval($materialInfo['materialId']);
                    $materialNum = intval($materialInfo['number']);
                    $consumptionNum = $materialNum * $num;//消耗数量
                    $consumptionDetail = GoodsConsumptionDetailModel::find()->where(['goodsId'=>$materialId,'consumptionId'=>$consumptionId,'isValid'=>GoodsConsumptionDetailModel::IS_VALID_OK])->one();
                    if(empty($consumptionDetail)){
                        $consumptionDetail = new GoodsConsumptionDetailModel();
                        $materialUpdateNum = $consumptionNum;
                    }else{
                        $materialUpdateNum = $consumptionNum - $consumptionDetail->num;
                        $existConsumptionDetailIds = array_diff($existConsumptionDetailIds,[$consumptionDetail->consumptionDetailId]);
                    }
                    $consumptionDetail->goodsType = GoodsModel::TYPE_MATERIEL;
                    $consumptionDetail->consumptionId = $consumptionId;
                    $consumptionDetail->goodsId = $materialId;
                    $consumptionDetail->num = $consumptionNum;
                    $consumptionDetail->price = 0;
                    if(!$consumptionDetail->save()){
                        $returnArr['msg'] = '物料消耗详情保存失败';
                        return $returnArr;
                    }
                    //保存生产消耗流水记录
                    $consumptionStockRecord = StockRecordModel::find()->where(['type'=>StockRecordModel::TYPE_CONSUMPTION,'unionId'=>$consumptionId,'goodsId'=>$materialId])->one();
                    if(empty($consumptionStockRecord)){
                        $consumptionStockRecord = new StockRecordModel();
                    }
                    $consumptionStockRecord->goodsType = GoodsModel::TYPE_MATERIEL;
                    $consumptionStockRecord->wareHouseId = $houseId;
                    $consumptionStockRecord->goodsId = $materialId;
                    $consumptionStockRecord->num = $consumptionNum;
                    $consumptionStockRecord->price = 0;
                    $consumptionStockRecord->type = StockRecordModel::TYPE_CONSUMPTION;
                    $consumptionStockRecord->unionId = $consumptionId;
                    $consumptionStockRecord->remark = '生产产品消耗物料';
                    $consumptionStockRecord->userName = $userName;
                    $consumptionStockRecord->date = $date;
                    if(!$consumptionStockRecord->save()){
                        $returnArr['msg'] = '物料消耗流水记录保存失败';
                        return $returnArr;
                    }
                    //更新库存
                    $materialStock = GoodsStockModel::find()->where(['wareHouseId'=>$houseId,'goodsId'=>$materialId,'isValid'=>GoodsStockModel::IS_VALID_OK])->one();
                    if(empty($materialStock)){
                        $returnArr['msg'] = '物料库存不存在';
                        return $returnArr;
                    }
                    //物料是消耗的
                    $materialStock->num = $materialStock->num - $materialUpdateNum;
                    if($materialStock->num < 0){
                        Yii::info('in storage update material fail---'.$materialId.'----'.$materialUpdateNum);
                        $returnArr['msg'] = '物料库存小于0';
                        return $returnArr;
                    }
                    if(!$materialStock->save()){
                        Yii::info('in storage update material fail---'.$materialId.'----');
                        $returnArr['msg'] = '物料库存更新失败';
                        return $returnArr;
                    }
                }
                //删掉之前的消耗详情记录
                if(count($existConsumptionDetailIds) > 0){
                    foreach ($existConsumptionDetailIds as $eId){
                        $dInfo = GoodsConsumptionDetailModel::find()->where(['consumptionDetailId'=>$eId,'isValid'=>GoodsConsumptionDetailModel::IS_VALID_OK])->one();
                        if(!empty($dInfo)){
                            $dInfo->isValid = GoodsConsumptionDetailModel::IS_VALID_NO;
                            if(!$dInfo->save()){
                                $returnArr['msg'] = '消耗记录删除失败';
                                return $returnArr;
                            }
                            //更新库存
                            $dMaterialId = $dInfo->goodsId;
                            $dStockMaterial = GoodsStockModel::find()->where(['wareHouseId'=>$houseId,'goodsId'=>$dMaterialId,'isValid'=>GoodsStockModel::IS_VALID_OK])->one();
                            if(empty($dStockMaterial)){
                                $returnArr['msg'] = '物料库存不存在d';
                                return $returnArr;
                            }
                            $dStockMaterial->num = $dStockMaterial->num + $dInfo->num;
                            if(!$dStockMaterial->save()){
                                $returnArr['msg'] = '物料库存更新失败d';
                                return $returnArr;
                            }
                        }
                    }
                }
            }
        }
        //删除之前的入库详情记录
        if(!empty($detailIds)){
            foreach ($detailIds as $detailId) {
                $info = self::find()->where(['storageDetailId'=>$detailId,'isValid'=>self::IS_VALID_OK])->one();
                if(!empty($info)){
                    $info->isValid = self::IS_VALID_NO;
                    if(!$info->save()){
                        $returnArr['msg'] = '生产入库详情删除失败1';
                        return $returnArr;
                    }
                    //库存减少
                    $dStorageStock = GoodsStockModel::find()->where(['goodsId'=>$info->goodsId,'wareHouseId'=>$houseId,'isValid'=>GoodsStockModel::IS_VALID_OK])->one();
                    if(empty($dStorageStock)){
                        Yii::info('----in storage fail no exist d goodsId'.$info->goodsId);
                        $returnArr['msg'] = '产品库存不存在';
                        return $returnArr;
                    }
                    $dStorageStock->num =  $dStorageStock->num - $info->num;
                    if($dStorageStock->num < 0){
                        Yii::info('----in storage fail no exist d goodsId'.$info->goodsId);
                        $returnArr['msg'] = '产品库存小于0';
                        return $returnArr;
                    }
                    if(!$dStorageStock->save()){
                        $returnArr['msg'] = 'd产品库存更新失败';
                        return $returnArr;
                    }
                }
            }
        }
        $returnArr['code'] = Code::SUCCESS;
        $returnArr['msg'] = 'ok';
        return $returnArr;
    }


}