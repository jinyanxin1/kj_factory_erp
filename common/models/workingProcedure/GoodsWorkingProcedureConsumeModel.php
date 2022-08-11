<?php
/**
 *
 * author: jinyanxin
 * Date: 2021/7/27
 * Time: 14:19
 * PHP version 7
 */

namespace common\models\workingProcedure;

use common\models\BaseModel;
use Yii;

/**
 * This is the model class for table "kj_goods_working_procedure_consume". 工序消耗产品数量配置表
 *
 * @property int $id
 * @property int|null $workingId 工序id
 * @property int|null $goodsId 产品或物料id
 * @property int|null $goodsWorkingId 关联产品的工序id
 * @property int|null $type 0消耗产品；1消耗物料
 * @property int|null $consume 消耗数量
 * @property string|null $creator
 * @property string|null $createTime
 * @property string|null $updater
 * @property string|null $updateTime
 * @property int|null $isValid
 */
class GoodsWorkingProcedureConsumeModel extends BaseModel
{
    //类型： 0消耗产品；1消耗物料
    const TYPE_MATERIAL = 1;
    const TYPE_GOODS = 0;
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'kj_goods_working_procedure_consume';
    }


    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'workingId' => '工序id',
            'goodsId' => '产品或物料id',
            'goodsWorkingId'=>'关联产品的工序id',
            'type' => '类型',
            'consume' => '消耗数量',
            'creator' => 'Creator',
            'createTime' => 'Create Time',
            'updater' => 'Updater',
            'updateTime' => 'Update Time',
            'isValid' => 'Is Valid',
        ];
    }
}