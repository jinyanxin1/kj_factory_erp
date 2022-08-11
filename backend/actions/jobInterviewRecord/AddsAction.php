<?php
/**
 * User: cqj
 * Date: 2020/7/27
 * Time: 8:56 上午
 */

namespace backend\actions\jobInterviewRecord;


use backend\actions\BaseAction;
use common\models\jobInterviewRecord\JobInterviewRecordForm;

class AddsAction extends BaseAction
{
    public function run() {
        $model = new JobInterviewRecordForm() ;
        //TODO 具体情况接收参数
        $model->attributes = $this->request()->post() ;
        $model->jobId = $this->request()->post('jobId') ;
        $model->clientId = $this->request()->post('clientId') ;
        $model->staffId = $this->request()->post('staffId') ;
        $model->position = $this->request()->post('position') ;
        $model->time = $this->request()->post('time') ;
        $model->skill = $this->request()->post('skill') ;
        $model->remark = $this->request()->post('remark') ;
        $model->address = $this->request()->post('address') ;
        $model->education = $this->request()->post('education') ;
        $model->name = $this->request()->post('name') ;
        $model->phone = $this->request()->post('phone') ;
        $model->sex = $this->request()->post('sex') ;
        $model->attributes = $this->request()->post() ;
        if (empty($model->staffId)) {
            $model->staffId = $this->staffId;
        }
        $ret = $model->adds() ;
        return $this->returnApi($ret['code'], $ret['msg']) ;
    }
}