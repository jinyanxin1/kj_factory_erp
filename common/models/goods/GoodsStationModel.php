<?php
/**
 *
 * author: jinyanxin
 * Date: 2020/11/18
 * Time: 9:30
 * PHP version 7
 * 岗位关联产品
 */

namespace common\models\goods;


use common\models\BaseModel;
use Yii;

/**
 * This is the model class for table "kj_goods_station".
 *
 * @property int $id
 * @property string|null $goodsId 产品id
 * @property int|null $groupId 权限组id
 * @property string|null $creator
 * @property string|null $createTime
 * @property string|null $updater
 * @property string|null $updateTime
 * @property int|null $isValid
 */
class GoodsStationModel extends BaseModel
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'kj_goods_station';
    }


    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'goodsId' => 'Goods ID',
            'materialId' => 'Material ID',
            'creator' => 'Creator',
            'createTime' => 'Create Time',
            'updater' => 'Updater',
            'updateTime' => 'Update Time',
            'isValid' => 'Is Valid',
        ];
    }


}