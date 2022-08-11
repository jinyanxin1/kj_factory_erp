<?php

namespace backend\actions\supplierRecord;

/**
* Created by cqj
* User: cqj
* Date: 2020-07-16
* Time: 10:20
* 新增
*/
use common\models\supplierRecord\SupplierRecordForm;
use common\library\helper\Code;
use backend\actions\BaseAction;

class AddAction extends BaseAction
{
	public function run() {
		$model = new SupplierRecordForm() ;
		//TODO 具体情况接收参数
		$model->attributes = $this->request()->post() ;
		$model->supplierId = $this->request()->post('supplierId') ;
		$model->phone = $this->request()->post('phone') ;
        $model->staffId = $this->request()->post('staffId') ;
        $model->clientId = $this->request()->post('clientId') ;
        $model->count = $this->request()->post('count') ;
        $model->position = $this->request()->post('position') ;
		$model->attributes = $this->request()->post() ;
		$ret = $model->add() ;
		return $this->returnApi($ret['code'], $ret['msg']) ;
	}
}