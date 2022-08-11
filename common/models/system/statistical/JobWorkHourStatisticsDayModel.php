<?php
/**
 *
 * author: jinyanxin
 * Date: 2020/10/24
 * Time: 10:00
 * PHP version 7
 * 人才系统工时统计
 */

namespace common\models\system\statistical;


use common\models\BaseModel;
use Yii;

/**
 * This is the model class for table "kj_job_work_hour_statistic_day".
 *
 * @property int $id
 * @property int|null $jobId 人才id
 * @property int|null $clientId 客户id
 * @property string|null $date 统计日期
 * @property int|null $workHour 工时
 * @property int|null $isUsed 是否结算
 * @property string|null $creator
 * @property string|null $createTime
 * @property string|null $updater
 * @property string|null $updateTime
 * @property int|null $isValid
 */
class JobWorkHourStatisticsDayModel extends BaseModel
{
    //是否结算：0未结算；1已结算
    const USED_NO = 0;
    const USED_YES = 1;
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'kj_job_work_hour_statistic_day';
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'jobId' => '人才ID',
            'clientId' => '客户ID',
            'date' => '日期',
            'workHour' => '工时',
            'isUsed' => '是否结算',
            'creator' => 'Creator',
            'createTime' => 'Create Time',
            'updater' => 'Updater',
            'updateTime' => 'Update Time',
            'isValid' => 'Is Valid',
        ];
    }

    public static function getById($id,$isArr = false)
    {
        $info = JobWorkHourStatisticsDayModel::find()->where(['id'=>$id,'isValid'=>JobWorkHourStatisticsDayModel::IS_VALID_OK]);
        if($isArr === true){
            $info->asArray();
        }
        return $info->one();
    }

    /*
     * 根据日期获取未结算的工时统计
     * */
    public static function getWorkHourByDate($date)
    {
        $data = JobWorkHourStatisticsDayModel::find()->where([
            'date'=>$date,
            'isUsed'=>JobWorkHourStatisticsDayModel::USED_NO,
            'isValid'=>JobWorkHourStatisticsDayModel::IS_VALID_OK
        ])->asArray()->all();
        return $data;
    }

}