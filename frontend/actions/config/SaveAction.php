<?php

namespace frontend\actions\config;

/**
* Created by cqj
* User: cqj
* Date: 2020-07-23
* Time: 08:44
* 修改
*/
use common\models\config\ConfigForm;
use common\library\helper\Code;
use frontend\actions\WxAction;

class SaveAction extends WxAction
{
	public function run() {
		$model = new ConfigForm() ;
		//TODO 具体情况接收参数
		$model->attributes = $this->request()->post() ;
		$model->publicDay = $this->request()->post('publicDay') ;
		$model->contractDay = $this->request()->post('contractDay') ;
		$ret = $model->update() ;
		return $this->returnApi($ret['code'], $ret['msg']) ;
	}
}