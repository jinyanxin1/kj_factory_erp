<?php

namespace backend\actions\industry;

/**
* Created by cqj
* User: cqj
* Date: 2020-07-17
* Time: 10:31
* 新增
*/
use common\models\industry\IndustryForm;
use common\library\helper\Code;
use backend\actions\BaseAction;

class AddAction extends BaseAction
{
	public function run() {
		$model = new IndustryForm() ;
		//TODO 具体情况接收参数
		$model->attributes = $this->request()->post() ;
		$model->name = $this->request()->post('name') ;
		$model->pId = $this->request()->post('pId',0) ;
		$model->attributes = $this->request()->post() ;
		$ret = $model->add() ;
		return $this->returnApi($ret['code'], $ret['msg']) ;
	}
}