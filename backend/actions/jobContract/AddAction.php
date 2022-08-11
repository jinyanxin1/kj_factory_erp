<?php

namespace backend\actions\jobContract;

/**
* Created by cqj
* User: cqj
* Date: 2020-09-10
* Time: 15:52
* 新增
*/
use common\models\jobContract\JobContractForm;
use common\library\helper\Code;
use backend\actions\BaseAction;

class AddAction extends BaseAction
{
	public function run() {
		$model = new JobContractForm() ;
		//TODO 具体情况接收参数
		$model->attributes = $this->request()->post() ;
		$ret = $model->add() ;
		return $this->returnApi($ret['code'], $ret['msg']) ;
	}
}