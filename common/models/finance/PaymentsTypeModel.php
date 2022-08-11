<?php
/**
 *
 * author: jinyanxin
 * Date: 2020/9/9
 * Time: 9:40
 * PHP version 7
 *  收支类型表
 */

namespace common\models\finance;


use common\models\BaseModel;
use Yii;

/**
 * This is the model class for table "kj_payments_type".
 *
 * @property int $id
 * @property int|null $type 1收入类型；2支出类型
 * @property string $name
 * @property string|null $creator
 * @property string|null $createTime
 * @property string|null $updater
 * @property string|null $updateTime
 * @property int|null $isValid
 */
class PaymentsTypeModel extends BaseModel
{
    //1收入类型；2支出类型
    const TYPE_INCOME = 1;
    const TYPE_EXPENDITURE = 2;

    public static $typeList = [
        self::TYPE_INCOME => '收入',
        self::TYPE_EXPENDITURE => '支出'
    ];


    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'kj_payments_type';
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'type' => '类型',
            'name' => '名称',
            'creator' => 'Creator',
            'createTime' => 'Create Time',
            'updater' => 'Updater',
            'updateTime' => 'Update Time',
            'isValid' => 'Is Valid',
        ];
    }


    public static function getIdByType($type)
    {
        $model = self::find()->select('id')->where(['type'=>$type,'isValid'=>self::IS_VALID_OK])->asArray()->all();
        return count($model) > 0 ? array_column($model,'id') : [];
    }

}