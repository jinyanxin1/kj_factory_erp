<?php
/**
 *
 * author: jinyanxin
 * Date: 2020/9/7
 * Time: 9:11
 * PHP version 7
 * 物品库存表
 */

namespace common\models\purchase;


use common\library\helper\Code;
use common\models\BaseForm;
use common\models\BaseModel;
use Yii;


/**
 * This is the model class for table "kj_goods_stock".
 *
 * @property int $id
 * @property int|null $goodsId 物品id
 * @property int|null $workingId 工序id
 * @property int|null $wareHouseId 仓库id
 * @property int|null $num 数量
 * @property string|null $creator
 * @property string|null $createTime
 * @property string|null $updater
 * @property string|null $updateTime
 * @property int|null $isValid
 */
class GoodsStockModel extends BaseModel
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'kj_goods_stock';
    }


    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'goodsId' => '物品id',
            'workingId' => '工序id',
            'wareHouseId' => '仓库id',
            'num' => '数量',
            'creator' => 'Creator',
            'createTime' => 'Create Time',
            'updater' => 'Updater',
            'updateTime' => 'Update Time',
            'isValid' => 'Is Valid',
        ];
    }


    /**
     * 根据物品id，得到库存
     * */
    public static function getStockByGoodsIds($goodsIds,$workingId=0)
    {
        $data = GoodsStockModel::find()
            ->select('goodsId,SUM(`num`) as `totalNum`')
            ->where(['goodsId'=>$goodsIds,'isValid'=>self::IS_VALID_OK]);
        if($workingId > 0){
            $data->andWhere(['workingId'=>$workingId]);
        }
       $data =  $data->groupBy('goodsId')->indexBy('goodsId')->asArray()->all();
        return $data;
    }


    //根据仓库id得到数据
    public static function getByHouseId($houseId)
    {
        $data = GoodsStockModel::find()->where(['wareHouseId'=>$houseId,'isValid'=>GoodsStockModel::IS_VALID_OK])->asArray()->all();
        return $data;
    }

    //得到一个商品的所有库存
    public static function countStockNumByGoodsId($goodsId)
    {
        $house = WarehouseModel::getAllHouse();
        $houseIds = array_column($house,'id');
        $count = self::find()->where(['goodsId'=>$goodsId,'isValid'=>self::IS_VALID_OK,'wareHouseId'=>$houseIds])->sum('num');
        return $count;
    }

    /*
     * 保存记录，更新商品库存
     * $data 进出库管理中增加的的商品库存记录
     * $purchaseId 进货主表id
     * */
    public static function saveData($houseId,$data,$purchaseId,$type,$remark,$userName,$date,$goodsType)
    {

        $returnArr = ['code'=>Code::SUCCESS,'msg'=>'更新成功'];
        if(count($data) > 0){
            $existStockRecord = StockRecordModel::find()->where(['wareHouseId'=>$houseId,'type'=>$type,'unionId'=>$purchaseId,'isValid'=>StockRecordModel::IS_VALID_OK])->asArray()->all();
            $existStockRecordIds = count($existStockRecord) > 0 ? array_column($existStockRecord,'stockRecordId') : [];
            foreach($data as $dataInfo){
                if($type === StockRecordModel::TYPE_PURCHASE){
                    $goodsId = intval($dataInfo['goodsId']);
                    $num = $dataInfo['num'];
                    $updateNum = intval($dataInfo['updateNum']);
                    $price = $dataInfo['price'];
                }else if($type === StockRecordModel::TYPE_RETURN_GOODS){
                    $goodsId = intval($dataInfo['goodsId']);
                    $num = $dataInfo['num'];
                    $updateNum =  0 - intval($dataInfo['updateNum']);
                    $price = $dataInfo['price'];
                }else{
                    $returnArr['code'] = Code::PARAM_ERR;
                    $returnArr['msg'] = '操作类型错误';
                    break;
                }
                $save = self::updateNum($houseId,$purchaseId,$goodsId,$num,$updateNum,$type,$remark,$userName,$price,$date,$goodsType);
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
                StockRecordModel::updateAll(['isValid'=>self::IS_VALID_NO,'updateTime'=>date('Y-m-d H:i:s')],['stockRecordId'=>$existStockRecordIds]);
            }
        }
        return $returnArr;
    }

    public static function updateNum($houseId,$unionId,$goodsId,$num,$updateNum,$type,$remark,$userName,$price,$date,$goodsType)
    {

        $stock = self::find()->where(['wareHouseId'=>$houseId,'goodsId'=>$goodsId,'isValid'=>self::IS_VALID_OK])->one();
        if($stock === null){
            $stock = new self();
            $stockNum = 0 ;
        }else{
            $stockNum = intval($stock->num);
        }
        if($type === StockRecordModel::TYPE_RETURN_GOODS){
            if(($stockNum + $updateNum) < 0){
                return ['code'=>Code::PARAM_ERR,'msg'=>'退货数量大于库存数量'];
            }
        }
        $stock->wareHouseId = $houseId;
        $stock->goodsId = $goodsId;
        $stock->num = $stockNum + $updateNum;
        if(!$stock->save()){
            return ['code'=>Code::PARAM_ERR,'msg'=>'库存更新失败'];
        }
        $stockRecord = StockRecordModel::find()->where(['wareHouseId'=>$houseId,'type'=>$type,'goodsId'=>$goodsId,'unionId'=>$unionId,'isValid'=>StockRecordModel::IS_VALID_OK])->one();
        if($stockRecord === null){
            $stockRecord = new StockRecordModel();
        }
        $stockRecord->goodsType = $goodsType;
        $stockRecord->wareHouseId = $houseId;
        $stockRecord->goodsId = $goodsId;
        $stockRecord->num = $num;
        $stockRecord->price = BaseForm::amountToCent($price);
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
     * 调拨操作时，库存更新
     * */
    public static function updateByAllocation($allocationId,$outHouseId,$inHouseId,$goodsId,$num,$updateNum,$price,$remark,$userName,$date,$goodsType)
    {
        $returnArr = ['code'=>Code::PARAM_ERR,'msg'=>'库存更新失败'];
        //调出库存量更新
        $outHouseStock = GoodsStockModel::find()->where(['wareHouseId'=>$outHouseId,'goodsId'=>$goodsId,'isValid'=>GoodsStockModel::IS_VALID_OK])->one();
        if($outHouseStock === null){
            $returnArr['msg'] = '该商品没有库存';
            return $returnArr;
        }
        $stockNum = intval($outHouseStock->num);
        if($stockNum < $updateNum){
            $returnArr['msg'] = '该商品库存量过少';
            return $returnArr;
        }
        $outHouseStock->num = $stockNum - $updateNum;
        if(!$outHouseStock->save()){
            $returnArr['msg'] = '调出仓库库存量更新失败';
            return $returnArr;
        }
        //调入库存量更新
        $inHouseStock = GoodsStockModel::find()->where(['wareHouseId'=>$inHouseId,'goodsId'=>$goodsId,'isValid'=>GoodsStockModel::IS_VALID_OK])->one();
        if($inHouseStock === null){
            $inHouseStock = new self();
            $inStockNum = 0;
        }else{
            $inStockNum = $inHouseStock->num;
        }
        $inHouseStock->wareHouseId = $inHouseId;
        $inHouseStock->goodsId = $goodsId;
        $inHouseStock->num = $inStockNum + $updateNum;
        if(!$inHouseStock->save()){
            $returnArr['msg'] = '调入仓库库存量更新失败';
            return $returnArr;
        }
        //拨入库存记录更新
        $inStockRecord = StockRecordModel::find()->where([
            'wareHouseId'=>$inHouseId,'type'=>StockRecordModel::TYPE_DIAL_IN,
            'goodsId'=>$goodsId,'unionId'=>$allocationId,'isValid'=>StockRecordModel::IS_VALID_OK])->one();
        if(empty($inStockRecord)){
            $inStockRecord = new StockRecordModel();
        }
        $inStockRecord->goodsType = $goodsType;
        $inStockRecord->wareHouseId = $inHouseId;
        $inStockRecord->goodsId = $goodsId;
        $inStockRecord->num = $num;
        $inStockRecord->price = $price;
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
        $outStockRecord = StockRecordModel::find()->where([
            'wareHouseId'=>$outHouseId,'type'=>StockRecordModel::TYPE_ALLOCATE,
            'goodsId'=>$goodsId,'unionId'=>$allocationId,'isValid'=>StockRecordModel::IS_VALID_OK])->one();
        if(empty($inStockRecord)){
            $outStockRecord = new StockRecordModel();
        }
        $outStockRecord->wareHouseId = $outHouseId;
        $outStockRecord->goodsId = $goodsId;
        $outStockRecord->num = $num;
        $outStockRecord->price = $price;
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