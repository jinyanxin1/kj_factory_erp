<?php

namespace backend\actions\jobInterviewRecord;

/**
* Created by cqj
* User: cqj
* Date: 2020-07-07
* Time: 14:23
* 新增
*/
use common\models\jobInterviewRecord\JobInterviewRecordForm;
use common\library\helper\Code;
use backend\actions\BaseAction;

class AddAction extends BaseAction
{
	public function run() {
		$model = new JobInterviewRecordForm() ;
		//TODO 具体情况接收参数
		$model->attributes = $this->request()->post() ;
        $model->jobId = $this->request()->post('jobId') ;
        $model->registraId = $this->request()->post('registraId') ;
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
		$ret = $model->add() ;
		return $this->returnApi($ret['code'], $ret['msg']) ;
	}
}