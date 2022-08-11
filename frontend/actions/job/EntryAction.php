<?php
/**
 * User: cqj
 * Date: 2020/7/7
 * Time: 4:15 下午
 * 入职
 */

namespace frontend\actions\job;


use frontend\actions\WxAction;
use common\models\jobCareerRecord\JobCareerRecordForm;

class EntryAction extends WxAction
{
    public function run() {
        $model = new JobCareerRecordForm() ;
        //TODO 具体情况接收参数
        $model->attributes = $this->request()->post() ;
        $model->jobId = $this->request()->post('jobId') ;
        $model->staffId = $this->request()->post('staffId') ;
        $model->clientId = $this->request()->post('clientId') ;
        $model->supplierId = $this->request()->post('supplierId') ;
        $model->department = $this->request()->post('department') ;
        $model->startTime = $this->request()->post('startTime') ;
        $model->endTime = $this->request()->post('endTime') ;
        $model->idCard = $this->request()->post('idCard') ;
        $model->position = $this->request()->post('position') ;
        $model->interviewTime = $this->request()->post('interviewTime') ;
        $model->trainTime = $this->request()->post('trainTime') ;
        $model->politicalStatus = $this->request()->post('politicalStatus') ;
        $model->bank = $this->request()->post('bank') ;
        $model->bankCard = $this->request()->post('bankCard') ;
        $model->address = $this->request()->post('address') ;
        $model->emergency = $this->request()->post('emergency') ;
//        $model->emergencyContact = $this->request()->post('emergencyContact') ;
//        $model->emergencyTell = $this->request()->post('emergencyTell') ;
        $model->first = $this->request()->post('first') ;
        $model->laborContractPic = $this->request()->post('laborContractPic') ;
        $model->cedicalReportPic = $this->request()->post('cedicalReportPic') ;
        $model->socialSecurity = $this->request()->post('socialSecurity') ;
        $model->remark = $this->request()->post('remark') ;
        $model->time = $this->request()->post('time') ;
        $model->idCardReversePic = $this->request()->post('idCardReversePic') ;
        $model->idCardPositivePic = $this->request()->post('idCardPositivePic');
        $model->bankReversePic = $this->request()->post('bankReversePic') ;
        $model->bankPositivePic = $this->request()->post('bankPositivePic');
        $model->jobNumber = $this->request()->post('jobNumber');
        $model->attributes = $this->request()->post() ;
        $ret = $model->entry() ;
        return $this->returnApi($ret['code'], $ret['msg']) ;
    }
}