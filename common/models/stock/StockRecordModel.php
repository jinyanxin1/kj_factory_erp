<?php
/**
 * @Author: jinyanxin
 * @Date: 2020/2/5
 * @Time: 9:28
 */


namespace common\models\stock;


use backend\actions\templateMsg\IsShowAction;
use common\models\BaseForm;
use common\models\BaseModel;
use common\models\goods\GoodsCategoryModel;
use common\models\goods\GoodsModel;
use common\models\warehouse\WarehouseModel;

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
    ];

    public static function tableName()
    {
        return 'jxt_jxc_stock_record';
    }

    /*
     * 根据记录得到库存
     * */
    public static function getNumByHouseIdAndGoodsId($houseId,$goodsId)
    {
        $inNum = self::find()->where(['goodsId'=>$goodsId,'warehouseId'=>$houseId,'type'=>self::$inHouse,'isValid'=>self::IS_VALID_OK])->sum('num');
        $outNum = self::find()->where(['goodsId'=>$goodsId,'warehouseId'=>$houseId,'type'=>self::$outHouse,'isValid'=>self::IS_VALID_OK])->sum('num');
        return $inNum- $outNum;
    }


    //格式化数据
    public static function format($data)
    {
        $returnArr = [];
        if(count($data) > 0){
            $houseIds = array_column($data,'warehouseId');
            $goodsIds = array_column($data,'goodsId');
            $house = WarehouseModel::getByIdList($houseIds);
            $goods = GoodsModel::getByIdList($goodsIds);
            $categoryIds = array_column($goods,'categoryId');
            $category = GoodsCategoryModel::getByIdList($categoryIds);
            $typeName = self::$typeName;
            foreach($data as $dataInfo){
                $info = $dataInfo;
                $info['houseName'] = isset($house[$dataInfo['warehouseId']]) ? $house[$dataInfo['warehouseId']]['warehouseName'] : '';
                $info['goodsName'] = isset($goods[$dataInfo['goodsId']]) ? $goods[$dataInfo['goodsId']]['goodsName'] : '';
                $categoryId = isset($goods[$dataInfo['goodsId']]) ? $goods[$dataInfo['goodsId']]['categoryId'] : 0;
                $info['categoryName'] = isset($category[$categoryId]) ? $category[$categoryId]['categoryName'] : '';
                $info['typeName'] = isset($typeName[$dataInfo['type']]) ? $typeName[$dataInfo['type']] : '';
                $info['attr'] = isset($goods[$dataInfo['goodsId']]) ? $goods[$dataInfo['goodsId']]['attr'] : '';
                $info['unit'] = isset($goods[$dataInfo['goodsId']]) ? $goods[$dataInfo['goodsId']]['unit'] : '';
                $info['pice'] = BaseForm::amountToYuan(intval($dataInfo['pice']) * intval($dataInfo['num']));
                $returnArr[] = $info;
            }
        }
        return $returnArr;
    }

    //根据时间段统计数据
    public static function statisticsByTime($houseId,$goodsIds,$startTime,$endTime)
    {
        $returnArr = [];
        $model = self::find()->where(['warehouseId'=>$houseId,'goodsId'=>$goodsIds,'isValid'=>self::IS_VALID_OK]);
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
                $num = intval($dataInfo['num']);
                $type = intval($dataInfo['type']);
                if(isset($returnArr[$goodsId])){
                    if(isset($returnArr[$goodsId][$type])){
                        $returnArr[$goodsId][$type] = $returnArr[$goodsId][$type] + $num;
                    }else{
                        $returnArr[$goodsId][$type] = $num;
                    }
                }else{
                    $returnArr[$goodsId][$type] = $num;
                }
            }
        }
        return $returnArr;
    }


}