<?php

namespace frontend\actions\jobInterviewRecord;

/**
* Created by cqj
* User: cqj
* Date: 2020-07-07
* Time: 14:23
* 修改
*/
use common\models\jobInterviewRecord\JobInterviewRecordForm;
use common\library\helper\Code;
use frontend\actions\WxAction;

class SaveAction extends WxAction
{
	public function run() {
		$model = new JobInterviewRecordForm() ;
		//TODO 具体情况接收参数
		$model->attributes = $this->request()->post() ;
		$model->interviewId = $this->request()->post('interviewId') ;
		$model->status = $this->request()->post('status') ;
		$model->jobId = $this->request()->post('jobId') ;
		$model->clientId = $this->request()->post('clientId') ;
		$model->staffId = $this->request()->post('staffId') ;
		$model->creator = $this->request()->post('creator') ;
		$model->createTime = $this->request()->post('createTime') ;
		$model->updater = $this->request()->post('updater') ;
		$model->updateTime = $this->request()->post('updateTime') ;
		$model->isValid = $this->request()->post('isValid') ;
		$model->position = $this->request()->post('position') ;
		$model->time = $this->request()->post('time') ;
		$model->skill = $this->request()->post('skill') ;
		$model->remark = $this->request()->post('remark') ;
		$model->address = $this->request()->post('address') ;
		$model->education = $this->request()->post('education') ;
		$model->name = $this->request()->post('name') ;
		$model->phone = $this->request()->post('phone') ;
		$model->sex = $this->request()->post('sex') ;
		$ret = $model->update() ;
		return $this->returnApi($ret['code'], $ret['msg']) ;
	}
}