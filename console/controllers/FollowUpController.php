<?php
/**
 * User: cqj
 * Date: 2020/7/27
 * Time: 9:20 上午
 */
namespace console\controllers;

use common\models\config\ConfigForm;
use common\models\jobInfo\JobInfoModel;
use common\models\jobInterviewRecord\JobInterviewRecordModel;
use yii\console\Controller;
use yii\helpers\Json;

class FollowUpController extends Controller
{
    /**
     * 定时将超过跟进日期到求职者放入共享资源池
     */
    public function actionIndex() {
        \Yii::info("定时任务开始：超过跟进日期放入共享资源");
        //获取系统配置
        $config = new ConfigForm();
        $config->getInfo();
        \Yii::info("超过跟进天数为:$config->publicDay");
        if (empty($config->publicDay)) {
            \Yii::info("定时任务结束：未设置天数");
            \Yii::$app->end();
        }
        $tran = \Yii::$app->db->beginTransaction();
        //查询所有跟进中到人才
        $job = JobInfoModel::find()
            ->select(['jobId'])
            ->where(['isValid' => JobInfoModel::IS_VALID_OK])
            ->andWhere(['status' => [JobInfoModel::STATUS_INTERVIEW]])
            ->asArray()
            ->all();

        $jobIds = array_column($job,'jobId');
        //获取所有跟进中到 最后一条面试记录
        $gj = JobInterviewRecordModel::find()
            ->select(['jobId','max(time) as time'])
            ->where(['jobId' => $jobIds])
            ->groupBy('jobId')
            ->asArray()
            ->all();

        try {
            $date = $config->calculate(-$config->publicDay);
            $arr = [] ;
            foreach ($gj as $value) {
                if (strtotime($value['time']) < strtotime($date)) {
                    $arr[] = $value['jobId'];
                }
            }
            \Yii::info("获得需要进入共享资源到人才编号：".Json::encode($arr));
            if (!empty($arr)) {
                $bool = JobInfoModel::updateAll(['status' => JobInfoModel::STATUS_PUBLIC,'staffId' => 0],['jobId' => $arr]);
                \Yii::info("执行结果：".Json::encode($bool));

            }
            $tran->commit();
        }catch (\Exception $exception) {
            $tran->rollBack();
            \Yii::info("定时任务错误：".$exception->getMessage());
        }
    }

    /**
     * 定时将超过跟进日期到求职者放入共享资源池
     */
    public function actionLeave() {
        \Yii::info("定时任务开始：超过跟进日期放入共享资源");
        //获取系统配置
        $config = new ConfigForm();
        $config->getInfo();
        \Yii::info("超过跟进分钟为:$config->leaveTime");
        if (empty($config->leaveTime)) {
            \Yii::info("定时任务结束：未设置分钟数");
            \Yii::$app->end();
        }
        $tran = \Yii::$app->db->beginTransaction();
        //查询所有跟进中到人才
        $job = JobInfoModel::find()
            ->select(['jobId','leaveTime'])
            ->where(['isValid' => JobInfoModel::IS_VALID_OK])
            ->andWhere(['status' => [JobInfoModel::STATUS_LEAVE]])
            ->asArray()
            ->all();

        try {
            $date = date('Y-m-d H:i:s',time() - $config->leaveTime * 60);
//            $date = $config->calculate(-$config->leaveTime);
            $arr = [] ;
            foreach ($job as $value) {
                if (strtotime($value['leaveTime']) < strtotime($date)) {
                    $arr[] = $value['jobId'];
                }
            }
            \Yii::info("获得需要进入共享资源到人才编号：".Json::encode($arr));
            if (!empty($arr)) {
                $bool = JobInfoModel::updateAll(['status' => JobInfoModel::STATUS_PUBLIC,'staffId' => 0],['jobId' => $arr]);
                \Yii::info("执行结果：".Json::encode($bool));

            }
            $tran->commit();
        }catch (\Exception $exception) {
            $tran->rollBack();
            \Yii::info("定时任务错误：".$exception->getMessage());
        }
    }
}