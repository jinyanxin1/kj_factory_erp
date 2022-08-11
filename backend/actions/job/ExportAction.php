<?php
/**
 * User: cqj
 * Date: 2020/9/1
 * Time: 9:39 上午
 */

namespace backend\actions\job;


use backend\actions\BaseAction;
use common\models\jobInfo\JobInfoForm;
use yii\helpers\Json;

class ExportAction extends BaseAction
{
    public function run () {
        $model = new JobInfoForm() ;
        $list = [] ;
        //TODO 具体情况接收条件参数
        $model->attributes = $this->request()->get() ;
        $model->loginUserId = $this->loginUserId ;
        $model->sex = intval(\Yii::$app->request->get('sex',-1)) ;
        $model->clientId = intval(\Yii::$app->request->get('clientId',0)) ;
        $model->startTime = \Yii::$app->request->get('startTime') ;
        $model->endTime = \Yii::$app->request->get('endTime') ;
        $model->skillId = \Yii::$app->request->get('skillId') ;
        $model->jobId = \Yii::$app->request->get('jobId') ;
        $model->name = \Yii::$app->request->get('name');
        $model->phone = \Yii::$app->request->get('phone');
        $model->status = \Yii::$app->request->get('status');
        $model->staffId = $this->staffId;
        \Yii::info(Json::encode($this->request()->get()));
        $ret = $model->getAll();
        $data = isset($ret['list']) ? $ret['list'] : [] ;
        \Yii::info('数据:'.Json::encode($ret));
        $list = [] ;
        if (!empty($data)) {
            $list = $model->formatExport() ;
        }
        $fileName =  iconv('utf-8', 'gbk', '人才');
        $this->exportData($list,$fileName,['姓名','年龄','性别','岗位','手机号','状态','招聘专员','工作厂']);
        exit();
    }
}