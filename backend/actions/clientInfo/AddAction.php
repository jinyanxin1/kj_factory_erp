<?php

namespace backend\actions\clientInfo;

/**
* Created by cqj
* User: cqj
* Date: 2020-07-10
* Time: 09:48
* 新增
*/
use common\models\clientInfo\ClientInfoForm;
use common\library\helper\Code;
use backend\actions\BaseAction;

class AddAction extends BaseAction
{
	public function run() {
		$model = new ClientInfoForm() ;
		//TODO 具体情况接收参数
		$model->attributes = $this->request()->post() ;
		$model->name = $this->request()->post('name') ;
		$model->type = $this->request()->post('type') ;
		$model->staffId = $this->request()->post('staffId') ;
		$model->industryId = $this->request()->post('industryId') ;
        $model->area = $this->request()->post('area') ;
        $model->price = $this->request()->post('price') ;
        $model->logo = $this->request()->post('logo') ;
        $model->tell = $this->request()->post('tell') ;
		$model->address = $this->request()->post('address') ;
		$model->introduction = $this->request()->post('introduction') ;
		$model->website = $this->request()->post('website') ;
        $model->range = $this->request()->post('range') ;
		$model->attributes = $this->request()->post() ;
		$ret = $model->add() ;
		return $this->returnApi($ret['code'], $ret['msg']) ;
	}
}