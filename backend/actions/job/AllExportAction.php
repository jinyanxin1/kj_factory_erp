<?php
/**
 * 77499
 * 2022/8/3
 */


namespace backend\actions\job;


use backend\actions\BaseAction;
use common\library\helper\Code;
use common\models\clientInfo\ClientInfoModel;
use common\models\jobInfo\JobInfoForm;
use common\models\jobInfo\JobInfoModel;
use common\models\staffInfo\StaffInfoModel;
use yii\helpers\Json;

class AllExportAction extends BaseAction
{

    public function run() {
        $model = new JobInfoForm() ;
        $list = [] ;
        $model->loginUserId = $this->loginUserId ;
        $model->sex = intval(\Yii::$app->request->get('sex',-1)) ;
        $model->clientId = intval(\Yii::$app->request->get('clientId',0)) ;
        $model->createStartTime = \Yii::$app->request->get('createStartTime') ;
        $model->createEndTime = \Yii::$app->request->get('createEndTime') ;
        $model->skillId = \Yii::$app->request->get('skillId') ;
        $model->jobId = \Yii::$app->request->get('jobId') ;
        $model->name = \Yii::$app->request->get('name');
        $model->phone = \Yii::$app->request->get('phone');
        $model->status = \Yii::$app->request->get('status');
        $model->channelId = $this->request()->get('channelId');
        $model->idCard = $this->request()->get('idCard');
        $model->staffId = intval($this->request()->get('staffId'));//客服专员名称搜索
        $ret = $model->getAllJob() ;
        $data = isset($ret['list']) ? $ret['list'] : [] ;
        $exportData = [];
        if(count($data) > 0){
            $staffIds = count($data) > 0 ? array_unique(array_column($data,'staffId')) : [];
            $staff = StaffInfoModel::find()->where(['staffId'=>$staffIds,'isValid'=>StaffInfoModel::IS_VALID_OK])
                ->indexBy('staffId')->asArray()->all();
            $clientId = array_column($data,'clientId');
            $client = ClientInfoModel::find()
                ->where(['clientId' => $clientId])
                ->asArray()
                ->indexBy('clientId')
                ->all();
            foreach($data as $value){
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
                    $value['position'],
                    isset($staff[$value['staffId']]) ? $staff[$value['staffId']]['name'] : '',
                    $value['phone'],
                    isset(JobInfoModel::$STATUS_ENUM[$value['status']]) ? JobInfoModel::$STATUS_ENUM[$value['status']] : '',
                    $value['createTime'],
                    $value['workTime'],
                    $value['leaveTime'],
                    isset($client[$value['clientId']]['name']) ? $client[$value['clientId']]['name'] : ''
                ];
                $exportData[] = $item;
            }
        }
        //导出
        $fileName =  iconv('utf-8', 'gbk', '全部人才');
        $this->exportData($exportData,$fileName,[
            '姓名','年龄','性别','岗位','客服专员','手机号','状态','创建时间','入职时间','离职时间','工作厂'
        ]);
        exit();
    }

}