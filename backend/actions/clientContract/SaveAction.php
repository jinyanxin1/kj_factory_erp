<?php

namespace backend\actions\clientContract;

/**
* Created by cqj
* User: cqj
* Date: 2020-07-10
* Time: 09:48
* 修改
*/
use common\models\clientContract\ClientContractForm;
use common\library\helper\Code;
use backend\actions\BaseAction;

class SaveAction extends BaseAction
{
	public function run() {
		$model = new ClientContractForm() ;
		//TODO 具体情况接收参数
		$model->attributes = $this->request()->post() ;
		$model->contractId = $this->request()->post('contractId') ;
		$model->creator = $this->request()->post('creator') ;
		$model->createTime = $this->request()->post('createTime') ;
		$model->updater = $this->request()->post('updater') ;
		$model->updateTime = $this->request()->post('updateTime') ;
		$model->isValid = $this->request()->post('isValid') ;
		$model->title = $this->request()->post('title') ;
		$model->startTime = $this->request()->post('startTime') ;
		$model->endTime = $this->request()->post('endTime') ;
		$model->pic = $this->request()->post('pic') ;
		$model->clientId = $this->request()->post('clientId') ;
		$model->staffId = $this->request()->post('staffId') ;
		$ret = $model->update() ;
		return $this->returnApi($ret['code'], $ret['msg']) ;
	}
}