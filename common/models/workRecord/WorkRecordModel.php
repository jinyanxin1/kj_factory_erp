<?php
/**
 *
 * author: jinyanxin
 * Date: 2021/7/27
 * Time: 16:08
 * PHP version 7
 */

namespace common\models\workRecord;


use common\models\BaseModel;
use Yii;

/**
 * This is the model class for table "kj_staff_work_record". 职工工单记录表
 *
 * @property int $id
 * @property int|null $staffId 职工id
 * @property int|null $type 类型：1计时；2计件；3休息
 * @property string|null $date 工单日期（或休息开始日期）
 * @property string|null $endDate 休息结束日期
 * @property int|null $goodsId 产品id
 * @property int|null $workingId 工序id
 * @property int|null $amount 工时(或计件数量或休息天数)
 * @property int|null $price 单位工价
 * @property string|null $remark 备注
 * @property string|null $creator
 * @property string|null $createTime
 * @property string|null $updater
 * @property string|null $updateTime
 * @property int|null $isValid
 */
class WorkRecordModel extends BaseModel
{
    //类型：1计时；2计件；3休息
    const TYPE_TIME = 1;
    const TYPE_PIECES = 2;
    const TYPE_XIUXI = 3;

    public static $typeList = [
        self::TYPE_TIME => '计时',
        self::TYPE_PIECES => '计件',
        self::TYPE_XIUXI => '休息'
    ];
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'kj_staff_work_record';
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'staffId' => '职工id',
            'type' => '类型',
            'date' => '工单日期',
            'endDate' => '休息结束日期',
            'goodsId' => '产品id',
            'workingId' => '工序id',
            'amount' => '工时(或计件数量)',
            'price' => '单位工价',
            'remark' => '备注',
            'creator' => 'Creator',
            'createTime' => 'Create Time',
            'updater' => 'Updater',
            'updateTime' => 'Update Time',
            'isValid' => 'Is Valid',
        ];
    }

}