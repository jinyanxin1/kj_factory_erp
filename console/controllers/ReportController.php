<?php
/**
 * User: cqj
 * Date: 2020/7/27
 * Time: 9:20 上午
 */
namespace console\controllers;

use common\models\report\ReportForm;
use common\models\staffInfo\StaffInfoModel;
use common\models\system\statistical\StatisticalModel;
use yii\console\Controller;

class ReportController extends Controller
{
    /**
     * 定时将超过跟进日期到求职者放入共享资源池
     */
    public function actionIndex() {
        \Yii::info("定时任务开始：每日统计");
        $tran = \Yii::$app->db->beginTransaction();
        StatisticalModel::deleteAll(['time' => date("Y-m-d",strtotime("-1 day"))]);
        try {
            $staff = StaffInfoModel::getAll(['staffId'],[['status' => StaffInfoModel::STATUS_ENTRY]],true);
            $staffAll = $staff['list'];
            $staffIds = [];
            if (!empty($staffAll)) {
                $staffIds = array_column($staffAll,'staffId');
                $form = new ReportForm() ;
                $form->startTime = date("Y-m-d",strtotime("-1 day"));
                $form->endTime = date("Y-m-d",strtotime("-1 day"));
                $form->report();
                if (!empty($form->list)) {
                    foreach ($form->list as $value) {
                        $model  = new StatisticalModel();
                        $model->staffId = $value['staffId'];
                        $model->time = $value['time'];
                        $model->jobAdd = $value['jobAdd'];
                        $model->interviewAdd = $value['interviewAdd'];
                        $model->entryAdd = $value['entryAdd'];
                        $model->interviewGoAdd = $value['interviewGoAdd'];
                        $model->save();
                    }
                    $fStaffIds = array_column($form->list,'staffId');
                    $cStaffIds = array_diff($staffIds,$fStaffIds);

                    foreach ($cStaffIds as $value) {
                        $model  = new StatisticalModel();
                        $model->staffId = $value;
                        $model->time = date("Y-m-d",strtotime("-1 day"));
                        $model->jobAdd = 0;
                        $model->interviewAdd = 0;
                        $model->entryAdd = 0;
                        $model->interviewGoAdd = 0;
                        $model->save();
                    }
                } else {
                    foreach ($staffIds as $value) {
                        $model  = new StatisticalModel();
                        $model->staffId = $value;
                        $model->time = date("Y-m-d",strtotime("-1 day"));
                        $model->jobAdd = 0;
                        $model->interviewAdd = 0;
                        $model->entryAdd = 0;
                        $model->interviewGoAdd = 0;
                        $model->save();
                    }
                }

            }

            $tran->commit();
        }catch (\Exception $exception) {
            $tran->rollBack();
            \Yii::info("定时任务错误：".$exception->getMessage());
        }
        \Yii::info("定时任务开始：每日统计");

    }
}