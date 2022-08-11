<?php
/**
 *
 * author: jinyanxin
 * Date: 2020/9/7
 * Time: 9:09
 * PHP version 7
 * 物品类别表
 */

namespace common\models\goods;


use common\models\BaseModel;
use Yii;


/**
 * This is the model class for table "kj_goods_category".
 *
 * @property int $id
 * @property string|null $number 编号
 * @property string|null $name 名称
 * @property string|null $creator
 * @property string|null $createTime
 * @property string|null $updater
 * @property string|null $updateTime
 * @property int|null $isValid
 */
class GoodsCategoryModel extends BaseModel
{

    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'kj_goods_category';
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'number' => '编号',
            'name' => '名称',
            'creator' => 'Creator',
            'createTime' => 'Create Time',
            'updater' => 'Updater',
            'updateTime' => 'Update Time',
            'isValid' => 'Is Valid',
        ];
    }

    public static function getByIdList($idList)
    {
        $data = self::find()->where(['id'=>$idList,'isValid'=>self::IS_VALID_OK])->indexBy('id')->asArray()->all();
        return $data;
    }

}