<?php

namespace backend\actions\jobInterviewRecord;

/**
* Created by cqj
* User: cqj
* Date: 2020-07-07
* Time: 14:23
* 修改
*/
use common\models\jobInterviewRecord\JobInterviewRecordForm;
use common\library\helper\Code;
use backend\actions\BaseAction;

class SaveAction extends BaseAction
{
	public function run() {
		$model = new JobInterviewRecordForm() ;
		//TODO 具体情况接收参数
		$model->attributes = $this->request()->post() ;
		$model->interviewId = $this->request()->post('interviewId') ;
		$model->clientId = $this->request()->post('clientId') ;
		$model->position = $this->request()->post('position') ;
		$model->time = $this->request()->post('time') ;
		$model->remark = $this->request()->post('remark') ;
		$ret = $model->update() ;
		return $this->returnApi($ret['code'], $ret['msg']) ;
	}
}