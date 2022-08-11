<?php
/**
 * Created by Eclipse.
 * User: ziv
 * Date: 2019/10/29
 * Time: 10:38
 * 仓库模型
 */

namespace common\models\warehouse;

use common\models\BaseModel;
use common\models\system\section\SectionModel;

class WarehouseModel extends BaseModel
{
    const BRANCH_HOUSE = 2;//分仓库
    const ZONG_HOUSE = 1;//总仓库

    public static function tableName()
    {
        return 'jxt_jxc_warehouse';
    }

    public static $typeList = [
        self::BRANCH_HOUSE => '分仓库',
        self::ZONG_HOUSE => '总仓库'
    ];

    //得到所有仓库
    public static function getAllHouse()
    {
        $house =  WarehouseModel::find()->where(['isValid'=>WarehouseModel::IS_VALID_OK]);
        $house = $house->indexBy('warehouseId')->asArray()->all();
        return $house;
    }

    public static function getById($id,$isArr = false)
    {
        $info = self::find()->where(['warehouseId'=>$id,'isValid'=>self::IS_VALID_OK]);
        if($isArr === true){
            $info->asArray();
        }
        return $info->one();
    }

    //根据idList得到数据，已id作为键输出
    public static function getByIdList($idList)
    {
        $model = self::find()->where(['warehouseId'=>$idList,'isValid'=>self::IS_VALID_OK])->indexBy('warehouseId')->asArray()->all();
        return $model;
    }
    
    
    //格式化数据
    public static function formate($data)
    {
        $showList = [];
        if( count($data)>0 ){
            $typeList = self::$typeList;
            foreach($data as $item){
                $item['type'] = intval($item['type']);
                $item['typeName'] = isset($typeList[$item['type']]) ? $typeList[$item['type']] : '未知';
                $item['warehouseId'] = intval($item['warehouseId']);
                $showList[] = $item;
            }
        }
        return $showList;
    }
    
}
