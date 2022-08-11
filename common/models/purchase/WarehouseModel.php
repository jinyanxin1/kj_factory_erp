<?php
/**
 * Created by Eclipse.
 * User: ziv
 * Date: 2019/10/29
 * Time: 10:38
 * 仓库模型
 */

namespace common\models\purchase;

use common\models\BaseModel;
use Yii;


/**
 * This is the model class for table "kj_ware_house".
 *
 * @property int $id
 * @property string|null $number 编号
 * @property string|null $name 仓库名称
 * @property string|null $address 地址
 * @property string|null $keeper 保管员
 * @property string|null $creator
 * @property string|null $createTime
 * @property string|null $updater
 * @property string|null $updateTime
 * @property int|null $isValid 0未删除；1已删除
 */
class WarehouseModel extends BaseModel
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'kj_goods_ware_house';
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'number' => '编号',
            'name' => '仓库名称',
            'address' => '地址',
            'keeper' => '保管员',
            'creator' => 'Creator',
            'createTime' => 'Create Time',
            'updater' => 'Updater',
            'updateTime' => 'Update Time',
            'isValid' => '0未删除；1已删除',
        ];
    }


    //得到所有仓库
    public static function getAllHouse()
    {
        $house =  WarehouseModel::find()->where(['isValid'=>WarehouseModel::IS_VALID_OK]);
        $house = $house->indexBy('id')->asArray()->all();
        return $house;
    }

    //根据idList得到数据，已id作为键输出
    public static function getByIdList($idList)
    {
        $model = WarehouseModel::find()->where(['id'=>$idList,'isValid'=>WarehouseModel::IS_VALID_OK])->indexBy('id')->asArray()->all();
        return $model;
    }

}
