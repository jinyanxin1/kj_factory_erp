<?php
/**
 *
 * author: jinyanxin
 * Date: 2020/9/8
 * Time: 10:08
 * PHP version 7
 * 销售单质检记录表
 */

namespace common\models\qualityTesting;


use common\models\BaseModel;
use Yii;

/**
 * This is the model class for table "kj_quality_testing_log".
 *
 * @property int $id
 * @property int $salesOrderId
 * @property int|null $status 1质检成功；2质检失败
 * @property string|null $describe
 * @property string|null $creator
 * @property string|null $createTime
 * @property string|null $updater
 * @property string|null $updateTime
 * @property int|null $isValid
 */
class QualityTestingLogModel extends BaseModel
{
    //1质检成功；2质检失败
    const QUALITY_TESTING_SUCCESS = 1;//质检成功
    const QUALITY_TESTING_FAIL = 2;//质检失败

    public static $statusList = [
        self::QUALITY_TESTING_SUCCESS => '质检成功',
        self::QUALITY_TESTING_FAIL => '质检失败'
    ];

    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'kj_quality_testing_log';
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'salesOrderId' => '销售单',
            'status' => '状态',
            'describe' => '描述',
            'creator' => 'Creator',
            'createTime' => 'Create Time',
            'updater' => 'Updater',
            'updateTime' => 'Update Time',
            'isValid' => 'Is Valid',
        ];
    }

}