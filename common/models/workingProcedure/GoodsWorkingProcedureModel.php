<?php
/**
 *
 * author: jinyanxin
 * Date: 2021/7/27
 * Time: 13:59
 * PHP version 7
 */

namespace common\models\workingProcedure;


use common\models\BaseModel;
use Yii;

/**
 * This is the model class for table "kj_goods_working_procedure". 产品工序表
 *
 * @property int $id
 * @property int|null $goodsId 商品id
 * @property int|null $sort 排序，第几道工序
 * @property string|null $name 工序名称
 * @property int|null $price 工价
 * @property int|null $consume 消耗上一步工序数量
 * @property string|null $remark 备注
 * @property string|null $creator
 * @property string|null $createTime
 * @property string|null $updater
 * @property string|null $updateTime
 * @property int|null $isValid
 */
class GoodsWorkingProcedureModel extends BaseModel
{

    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'kj_goods_working_procedure';
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'goodsId' => '商品id',
            'sort' => '排序',
            'name' => '工序名称',
            'price' => '工价',
            'consume' => '消耗上一步工序数量',
            'remark' => '备注',
            'creator' => 'Creator',
            'createTime' => 'Create Time',
            'updater' => 'Updater',
            'updateTime' => 'Update Time',
            'isValid' => 'Is Valid',
        ];
    }

    public static function getByIdList($ids)
    {
        $data = self::find()->where(['id'=>$ids,'isValid'=>self::IS_VALID_OK])->indexBy('id')->asArray()->all();
        return $data;
    }

}