<?php

namespace frontend\actions\jobCareerRecord;

/**
* Created by cqj
* User: cqj
* Date: 2020-07-07
* Time: 14:23
* 新增
*/
use common\models\jobCareerRecord\JobCareerRecordForm;
use common\library\helper\Code;
use frontend\actions\WxAction;

class AddAction extends WxAction
{
	public function run() {
		$model = new JobCareerRecordForm() ;
		//TODO 具体情况接收参数
		$model->attributes = $this->request()->post() ;
		$model->status = $this->request()->post('status') ;
		$model->jobId = $this->request()->post('jobId') ;
		$model->staffId = $this->request()->post('staffId') ;
		$model->clientId = $this->request()->post('clientId') ;
		$model->supplierId = $this->request()->post('supplierId') ;
		$model->creator = $this->request()->post('creator') ;
		$model->createTime = $this->request()->post('createTime') ;
		$model->updater = $this->request()->post('updater') ;
		$model->updateTime = $this->request()->post('updateTime') ;
		$model->isValid = $this->request()->post('isValid') ;
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
		$model->emergencyContact = $this->request()->post('emergencyContact') ;
		$model->emergencyTell = $this->request()->post('emergencyTell') ;
		$model->first = $this->request()->post('first') ;
		$model->laborContractPic = $this->request()->post('laborContractPic') ;
		$model->cedicalReportPic = $this->request()->post('cedicalReportPic') ;
		$model->time = $this->request()->post('time') ;
		$model->leaveReason = $this->request()->post('leaveReason') ;
		$model->leavePic = $this->request()->post('leavePic') ;
		$model->attributes = $this->request()->post() ;
		$ret = $model->add() ;
		return $this->returnApi($ret['code'], $ret['msg']) ;
	}
}