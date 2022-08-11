<?php

namespace frontend\actions\clientInterviewRecord;

/**
* Created by cqj
* User: cqj
* Date: 2020-07-10
* Time: 09:48
* 新增
*/
use common\models\clientInterviewRecord\ClientInterviewRecordForm;
use common\library\helper\Code;
use frontend\actions\WxAction;

class AddAction extends WxAction
{
	public function run() {
		$model = new ClientInterviewRecordForm() ;
		//TODO 具体情况接收参数
		$model->attributes = $this->request()->post() ;
		$model->title = $this->request()->post('title') ;
		$model->time = $this->request()->post('time') ;
		$model->staffId = $this->request()->post('staffId') ;
		$model->clientId = $this->request()->post('clientId') ;
		$model->content = $this->request()->post('content') ;
		$model->pic = $this->request()->post('pic') ;
		$model->start = $this->request()->post('start') ;
		$model->end = $this->request()->post('end') ;
		$model->personId = $this->request()->post('personId') ;
        $model->followType = $this->request()->post('followType') ;
        $model->status = $this->request()->post('status') ;
		$model->attributes = $this->request()->post() ;
		$ret = $model->add() ;
		return $this->returnApi($ret['code'], $ret['msg']) ;
	}
}