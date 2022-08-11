<?php

namespace backend\actions\clientInterviewRecord;

/**
* Created by cqj
* User: cqj
* Date: 2020-07-10
* Time: 09:48
* 修改
*/
use common\models\clientInterviewRecord\ClientInterviewRecordForm;
use common\library\helper\Code;
use backend\actions\BaseAction;

class SaveAction extends BaseAction
{
	public function run() {
		$model = new ClientInterviewRecordForm() ;
		//TODO 具体情况接收参数
		$model->attributes = $this->request()->post() ;
		$model->recordId = $this->request()->post('recordId') ;
		$model->creator = $this->request()->post('creator') ;
		$model->createTime = $this->request()->post('createTime') ;
		$model->updater = $this->request()->post('updater') ;
		$model->updateTime = $this->request()->post('updateTime') ;
		$model->isValid = $this->request()->post('isValid') ;
		$model->title = $this->request()->post('title') ;
		$model->time = $this->request()->post('time') ;
		$model->staffId = $this->request()->post('staffId') ;
		$model->clientId = $this->request()->post('clientId') ;
		$model->content = $this->request()->post('content') ;
		$model->pic = $this->request()->post('pic') ;
		$model->start = $this->request()->post('start') ;
		$model->end = $this->request()->post('end') ;
		$model->personId = $this->request()->post('personId') ;
		$model->followId = $this->request()->post('followId') ;
		$ret = $model->update() ;
		return $this->returnApi($ret['code'], $ret['msg']) ;
	}
}