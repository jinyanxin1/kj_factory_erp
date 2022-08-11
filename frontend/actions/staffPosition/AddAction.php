<?php

namespace frontend\actions\staffPosition;

/**
* Created by cqj
* User: cqj
* Date: 2020-07-07
* Time: 14:22
* 新增
*/
use common\models\staffPosition\StaffPositionForm;
use common\library\helper\Code;
use frontend\actions\WxAction;

class AddAction extends WxAction
{
	public function run() {
		$model = new StaffPositionForm() ;
		//TODO 具体情况接收参数
		$model->attributes = $this->request()->post() ;
		$model->parentId = $this->request()->post('parentId',0) ;
		$model->name = $this->request()->post('name') ;
		$model->attributes = $this->request()->post() ;
		$ret = $model->add() ;
		return $this->returnApi($ret['code'], $ret['msg']) ;
	}
}