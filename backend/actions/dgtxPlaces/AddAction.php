<?php

namespace backend\actions\dgtxPlaces;

/**
* Created by cqj
* User: cqj
* Date: 2020-07-02
* Time: 09:28
* 新增
*/
use common\library\helper\Code;
use backend\actions\BaseAction;
use common\models\system\dgtxPlaces\DgtxPlacesForm;

class AddAction extends BaseAction
{
	public function run() {
		$model = new DgtxPlacesForm() ;
		//TODO 具体情况接收参数
		$model->attributes = $this->request()->post() ;
		$model->parent_id = $this->request()->post('parent_id') ;
		$model->cname = $this->request()->post('cname') ;
		$model->ctype = $this->request()->post('ctype') ;
		$model->attributes = $this->request()->post() ;
		$ret = $model->add() ;
		return $this->returnApi($ret['code'], $ret['msg']) ;
	}
}