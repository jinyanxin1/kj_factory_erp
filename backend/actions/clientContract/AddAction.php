<?php

namespace backend\actions\clientContract;

/**
* Created by cqj
* User: cqj
* Date: 2020-07-10
* Time: 09:48
* 新增
*/
use common\models\clientContract\ClientContractForm;
use common\library\helper\Code;
use backend\actions\BaseAction;

class AddAction extends BaseAction
{
	public function run() {
		$model = new ClientContractForm() ;
		//TODO 具体情况接收参数
		$model->attributes = $this->request()->post() ;
        $model->title = $this->request()->post('title') ;
        $model->basisId = $this->request()->post('basisId') ;
		$model->startTime = $this->request()->post('startTime') ;
		$model->endTime = $this->request()->post('endTime') ;
        $model->pic = $this->request()->post('pic') ;
        $model->time = $this->request()->post('time') ;
		$model->clientId = $this->request()->post('clientId') ;
		$model->staffId = $this->request()->post('staffId') ;
		$model->attributes = $this->request()->post() ;
		$ret = $model->add() ;
		return $this->returnApi($ret['code'], $ret['msg']) ;
	}
}