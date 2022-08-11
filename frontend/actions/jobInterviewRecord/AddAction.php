<?php

namespace frontend\actions\jobInterviewRecord;

/**
* Created by cqj
* User: cqj
* Date: 2020-07-07
* Time: 14:23
* 新增
*/
use common\models\jobInterviewRecord\JobInterviewRecordForm;
use common\library\helper\Code;
use frontend\actions\WxAction;

class AddAction extends WxAction
{
	public function run() {
		$model = new JobInterviewRecordForm() ;
		//TODO 具体情况接收参数
		$model->attributes = $this->request()->post() ;
		$model->jobId = $this->request()->post('jobId') ;
		$model->clientId = $this->request()->post('clientId') ;
		$model->staffId = $this->staffId ;
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
		$ret = $model->add() ;
		return $this->returnApi($ret['code'], $ret['msg']) ;
	}
}