<?php
/**
 * 77499
 * 2022/8/3
 */


namespace backend\actions\job;


use backend\actions\BaseAction;
use common\library\helper\Code;
use common\models\clientInfo\ClientInfoModel;
use common\models\jobCareerRecord\JobCareerRecordModel;
use common\models\jobInfo\JobInfoForm;
use common\models\jobInfo\JobInfoModel;
use common\models\jobInterviewRecord\JobInterviewRecordModel;
use common\models\staffInfo\StaffInfoModel;

class PublicExportAction extends BaseAction
{

    public function run()
    {
        $model = new JobInfoForm() ;
        $list = [] ;
        $model->sex = intval(\Yii::$app->request->get('sex',-1)) ;
        $model->skillId = \Yii::$app->request->get('skillId'); ;
        $model->name = trim(\Yii::$app->request->get('name'));
        $model->phone = trim(\Yii::$app->request->get('phone'));
        $model->channelId = $this->request()->get('channelId');
        $model->idCard = $this->request()->get('idCard');
        $model->oldStaffId = intval($this->request()->get('staffId'));
        $model->startTime = $this->request()->get('startTime');//最后一次入职时间搜索
        $model->endTime = $this->request()->get('endTime');


        $ret = $model->getPublic() ;
        $data = isset($ret['list']) ? $ret['list'] : [] ;
        $exportData = [];
        if(count($data) > 0){
            $staffIds = count($data) > 0 ? array_unique(array_column($data,'oldStaffId')) : [];
            $staff = StaffInfoModel::find()->where(['staffId'=>$staffIds,'isValid'=>StaffInfoModel::IS_VALID_OK])
                ->indexBy('staffId')->asArray()->all();
            $jobIds = array_column($data,'jobId');
            //求职技能
            $skillName = JobInfoForm::getSkillName($jobIds);
            foreach ($data as $value) {
                $level = "";//上家离职公司
                $interview = "";//上家面试公司
                //上家离职的公司
                $careerRecord = JobCareerRecordModel::find()
                    ->where(['status' => JobCareerRecordModel::STATUS_LEAVE])
                    ->andWhere(['jobId' => $value['jobId']])
                    ->orderBy('time desc')
                    ->limit(1)
                    ->asArray()
                    ->one();
                //上家面试的公司
                $interviewRecord = JobInterviewRecordModel::find()
                    ->where(['jobId' => $value['jobId']])
                    ->orderBy('time desc')
                    ->limit(1)
                    ->asArray()
                    ->one();
                $cIds = [];
                if (!empty($careerRecord)) {
                    $cIds[] = $careerRecord['clientId'];
                }
                if (!empty($interviewRecord)) {
                    $cIds[] = $interviewRecord['clientId'];
                }
                if(count($cIds) > 0){
                    $cidR = ClientInfoModel::find()
                        ->where(['clientId' => $cIds])
                        ->asArray()
                        ->indexBy('clientId')
                        ->all();
                    if (!empty($careerRecord)) {
                        $level = $cidR[$careerRecord['clientId']]['name'] ?? '';
                    }
                    if (!empty($interviewRecord)) {
                        $interview = $cidR[$interviewRecord['clientId']]['name'] ?? '';
                    }
                }
                if (!empty($value['birthday'])) {
                    $bTime = strtotime($value['birthday']);
                    $age = $model->getAge($bTime,$value['isLunarCalendar']);
                } else {
                    $age = $value['age'];
                }
                $item = [
                    $value['name'],
                    $age,
                    isset(JobInfoModel::$SEX_ENUM[$value['sex']]) ? JobInfoModel::$SEX_ENUM[$value['sex']] : '',
                    isset($skillName[$value['jobId']]) ? $skillName[$value['jobId']] : '' ,
                    $interview,
                    $level,
                    $value['phone'],
                    isset($staff[$value['oldStaffId']]) ? $staff[$value['oldStaffId']]['name'] : '',
                    $value['workTime']
                ];
                $exportData[] = $item;
            }
        }
        //导出
        $fileName =  iconv('utf-8', 'gbk', '共享资源');
        $this->exportData($exportData,$fileName,[
            '姓名','年龄','性别','技能','上家面试公司','上家离职公司','手机号','客服专员','上次入职时间'
        ]);
        exit();
    }

}