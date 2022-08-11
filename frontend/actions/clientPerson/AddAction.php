<?php

namespace frontend\actions\clientPerson;

/**
* Created by cqj
* User: cqj
* Date: 2020-07-10
* Time: 09:48
* 新增
*/
use common\models\clientPerson\ClientPersonForm;
use common\library\helper\Code;
use frontend\actions\WxAction;

class AddAction extends WxAction
{
	public function run() {
		$model = new ClientPersonForm() ;
		//TODO 具体情况接收参数
		$model->attributes = $this->request()->post() ;
		$model->clientId = $this->request()->post('clientId');
		$model->tell = $this->request()->post('tell') ;
		$model->phone = $this->request()->post('phone') ;
		$model->name = $this->request()->post('name') ;
		$model->department = $this->request()->post('department') ;
		$model->position = $this->request()->post('position') ;
		$model->remark = $this->request()->post('remark') ;
		$model->email = $this->request()->post('email') ;
		$model->weixin = $this->request()->post('weixin') ;
        $model->qq = $this->request()->post('qq') ;
		$model->attributes = $this->request()->post() ;
		$ret = $model->add() ;
		return $this->returnApi($ret['code'], $ret['msg']) ;
	}
}