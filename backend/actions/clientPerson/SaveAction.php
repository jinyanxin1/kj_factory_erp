<?php

namespace backend\actions\clientPerson;

/**
* Created by cqj
* User: cqj
* Date: 2020-07-10
* Time: 09:48
* 修改
*/
use common\models\clientPerson\ClientPersonForm;
use common\library\helper\Code;
use backend\actions\BaseAction;

class SaveAction extends BaseAction
{
	public function run() {
		$model = new ClientPersonForm() ;
		//TODO 具体情况接收参数
		$model->attributes = $this->request()->post() ;
		$model->personId = $this->request()->post('personId') ;
		$model->clientId = $this->request()->post('clientId') ;
		$model->tell = $this->request()->post('tell') ;
		$model->phone = $this->request()->post('phone') ;
		$model->name = $this->request()->post('name') ;
		$model->department = $this->request()->post('department') ;
		$model->position = $this->request()->post('position') ;
		$model->remark = $this->request()->post('remark') ;
		$model->email = $this->request()->post('email') ;
		$model->weixin = $this->request()->post('weixin') ;
		$model->qq = $this->request()->post('qq') ;
		$ret = $model->update() ;
		return $this->returnApi($ret['code'], $ret['msg']) ;
	}
}