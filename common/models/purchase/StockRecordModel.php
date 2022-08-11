<?php
/**
 * @Author: jinyanxin
 * @Date: 2020/2/5
 * @Time: 9:28
 */


namespace common\models\purchase;


use common\models\BaseForm;
use common\models\BaseModel;
use common\models\goods\GoodsCategoryModel;
use common\models\goods\GoodsModel;
use common\models\purchase\WarehouseModel;
use common\models\workingProcedure\GoodsWorkingProcedureModel;

/**
 * This is the model class for table "kj_goods_stock_record".
 *
 * @property int $stockRecordId
 * @property int|null $goodsType 1产品；2物料
 * @property int|null $wareHouseId 仓库id
 * @property int|null $goodsId 商品id
 * @property int|null $workingId 工序id
 * @property int|null $num 数量
 * @property int|null $price 金额
 * @property int|null $type 11进货，12拨入，13退领，14销售退回，21退货，22拨出，23领用，24销售、25报损，31库存调整
 * @property int|null $unionId 关联ID
 * @property string|null $remark 备注
 * @property string|null $userName 经手人
 * @property string|null $date 日期
 * @property string|null $creator
 * @property string|null $createTime
 * @property string|null $updater
 * @property string|null $updateTime
 * @property int|null $isValid 0未删除；1已删除
 */
class StockRecordModel  extends BaseModel
{

    const TYPE_PURCHASE = 11;//进货
    const TYPE_DIAL_IN = 12;//拨入
    const TYPE_WITHDRAWAL_OF_COLLAR = 13;//退领
    const TYPE_SALE_RETURN = 14;//销售退回
    const TYPE_RETURN_GOODS = 21;//退货
    const TYPE_ALLOCATE = 22;//拨出
    const TYPE_COLLAR_USE = 23;//领用
    const TYPE_SALE = 24;//销售
    const TYPE_REPORT_LOSS = 25;//报损
    const TYPE_INVA = 31;//库存调整
    const TYPE_ALLOCATION = 41;//调拨
    const TYPE_IN_STORAGE = 51;//生产入库
    const TYPE_CONSUMPTION = 61;//生产消耗

    public static $inHouse = [
        self::TYPE_PURCHASE,
        self::TYPE_DIAL_IN,
        self::TYPE_WITHDRAWAL_OF_COLLAR,
        self::TYPE_SALE_RETURN,
        self::TYPE_INVA,
    ];
    public static $outHouse = [
        self::TYPE_RETURN_GOODS,
        self::TYPE_ALLOCATE,
        self::TYPE_COLLAR_USE,
        self::TYPE_SALE,
        self::TYPE_REPORT_LOSS
    ];

    public static $typeName = [
        self::TYPE_PURCHASE => '进货',
        self::TYPE_DIAL_IN => '拨入',
        self::TYPE_WITHDRAWAL_OF_COLLAR => '退领',
        self::TYPE_SALE_RETURN => '销售退回',
        self::TYPE_RETURN_GOODS => '退货',
        self::TYPE_ALLOCATE => '拨出',
        self::TYPE_COLLAR_USE => '领用',
        self::TYPE_SALE => '销售',
        self::TYPE_REPORT_LOSS => '报损',
        self::TYPE_INVA => '库存调整',
        self::TYPE_ALLOCATION => '调拨',
        self::TYPE_IN_STORAGE => '生产入库',
        self::TYPE_CONSUMPTION => '生产消耗',
    ];

    public static function tableName()
    {
        return 'kj_goods_stock_record';
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'goodsType' => '类型',
            'wareHouseId' => '仓库id',
            'goodsId' => '商品id',
            'workingId' => '工序id',
            'num' => '数量',
            'price' => '金额',
            'type' => '类型',
            'unionId' => '关联ID',
            'remark' => '备注',
            'userName' => '经手人',
            'date' => '日期',
            'creator' => 'Creator',
            'createTime' => 'Create Time',
            'updater' => 'Updater',
            'updateTime' => 'Update Time',
            'isValid' => '0未删除；1已删除',
        ];
    }

    /*
     * 根据记录得到库存
     * */
    public static function getNumByHouseIdAndGoodsId($houseId,$goodsId)
    {
        $inNum = self::find()->where(['goodsId'=>$goodsId,'wareHouseId'=>$houseId,'type'=>self::$inHouse,'isValid'=>self::IS_VALID_OK])->sum('num');
        $outNum = self::find()->where(['goodsId'=>$goodsId,'wareHouseId'=>$houseId,'type'=>self::$outHouse,'isValid'=>self::IS_VALID_OK])->sum('num');
        return $inNum- $outNum;
    }


    //格式化数据
    public static function format($data)
    {
        $returnArr = [];
        if(count($data) > 0){
            $houseIds = array_unique(array_column($data,'wareHouseId'));
            $goodsIds = array_unique(array_column($data,'goodsId'));
            $workingIds = array_unique(array_column($data,'workingId'));
            $house = WarehouseModel::getByIdList($houseIds);
            $goods = GoodsModel::getByIdList($goodsIds);
            $working = GoodsWorkingProcedureModel::getByIdList($workingIds);
            $categoryIds = array_column($goods,'categoryId');
            $category = GoodsCategoryModel::getByIdList($categoryIds);
            $typeName = self::$typeName;
            foreach($data as $dataInfo){
                $info = $dataInfo;
                $info['houseName'] = isset($house[$dataInfo['wareHouseId']]) ? $house[$dataInfo['wareHouseId']]['name'] : '';
                $info['goodsName'] = isset($goods[$dataInfo['goodsId']]) ? $goods[$dataInfo['goodsId']]['name'] : '';
                $info['workingName'] = isset($working[$dataInfo['workingId']]) ? $working[$dataInfo['workingId']]['name'] : '';
                $info['attr'] = isset($goods[$dataInfo['goodsId']]) ? $goods[$dataInfo['goodsId']]['attr'] : '';
                $categoryId = isset($goods[$dataInfo['goodsId']]) ? $goods[$dataInfo['goodsId']]['categoryId'] : 0;
                $info['categoryName'] = isset($category[$categoryId]) ? $category[$categoryId]['name'] : '';
                $info['typeName'] = isset($typeName[$dataInfo['type']]) ? $typeName[$dataInfo['type']] : '';
                $info['unit'] = isset($goods[$dataInfo['goodsId']]) ? $goods[$dataInfo['goodsId']]['unit'] : '';
                $info['price'] = BaseForm::amountToYuan(intval($dataInfo['price']) * $dataInfo['num']);
                $returnArr[] = $info;
            }
        }
        return $returnArr;
    }

    //根据时间段统计数据
    public static function statisticsByTime($houseId,$goodsIds,$startTime,$endTime)
    {
        $returnArr = [];
        $model = self::find()->where(['wareHouseId'=>$houseId,'goodsId'=>$goodsIds,'isValid'=>self::IS_VALID_OK]);
        if(!empty($startTime)){
            $model->andWhere(['>=','date',$startTime]);
        }
        if(!empty($endTime)){
            $model->andWhere(['<=','date',$endTime]);
        }
        $data = $model->asArray()->all();
        if(count($data) > 0){
            foreach($data as $dataInfo){
                $goodsId = intval($dataInfo['goodsId']);
                $workingId = intval($dataInfo['workingId']);
                $key = $goodsId.'-'.$workingId;
                $num = $dataInfo['num'];
                $type = intval($dataInfo['type']);
                if(isset($returnArr[$key])){
                    if(isset($returnArr[$key][$type])){
                        $returnArr[$key][$type] = $returnArr[$key][$type] + $num;
                    }else{
                        $returnArr[$key][$type] = $num;
                    }
                }else{
                    $returnArr[$key][$type] = $num;
                }
            }
        }
        return $returnArr;
    }

    /*
     * type 类型
     * unionId 关联id
     * houseid 仓库id
     * 根据类型，仓库id，关联id得到流水记录id
     * */
    public static function getByUnionIdAndType($type,$unionId,$houseId)
    {
        $existStockRecord = StockRecordModel::find()->where(['wareHouseId'=>$houseId,'type'=>$type,'unionId'=>$unionId,'isValid'=>StockRecordModel::IS_VALID_OK])->asArray()->all();
        $existStockRecordIds = count($existStockRecord) > 0 ? array_column($existStockRecord,'stockRecordId') : [];
        return $existStockRecordIds;
    }

}