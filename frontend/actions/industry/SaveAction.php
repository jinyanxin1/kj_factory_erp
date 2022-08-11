<?php

namespace frontend\actions\industry;

/**
* Created by cqj
* User: cqj
* Date: 2020-07-17
* Time: 10:31
* 修改
*/
use common\models\industry\IndustryForm;
use common\library\helper\Code;
use frontend\actions\WxAction;

class SaveAction extends WxAction
{
	public function run() {
		$model = new IndustryForm() ;
		//TODO 具体情况接收参数
		$model->attributes = $this->request()->post() ;
		$model->industryId = $this->request()->post('industryId') ;
		$model->name = $this->request()->post('name') ;
		$model->pId = $this->request()->post('pId') ;
		$ret = $model->update() ;
		return $this->returnApi($ret['code'], $ret['msg']) ;
	}
}