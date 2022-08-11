<?php

namespace backend\actions\config;

/**
* Created by cqj
* User: cqj
* Date: 2020-07-23
* Time: 08:44
* 修改
*/
use common\models\config\ConfigForm;
use common\library\helper\Code;
use backend\actions\BaseAction;

class SaveAction extends BaseAction
{
	public function run() {
		$model = new ConfigForm() ;
		//TODO 具体情况接收参数
		$model->attributes = $this->request()->post() ;
		$model->publicDay = $this->request()->post('publicDay') ;
        $model->contractDay = $this->request()->post('contractDay') ;
        $model->leaveTime = $this->request()->post('leaveTime') ;
		$ret = $model->update() ;
		return $this->returnApi($ret['code'], $ret['msg']) ;
	}
}