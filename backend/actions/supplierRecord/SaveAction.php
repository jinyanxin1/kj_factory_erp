<?php

namespace backend\actions\supplierRecord;

/**
* Created by cqj
* User: cqj
* Date: 2020-07-16
* Time: 10:20
* 修改
*/
use common\models\supplierRecord\SupplierRecordForm;
use common\library\helper\Code;
use backend\actions\BaseAction;

class SaveAction extends BaseAction
{
	public function run() {
		$model = new SupplierRecordForm() ;
		//TODO 具体情况接收参数
		$model->attributes = $this->request()->post() ;
		$model->recordId = $this->request()->post('recordId') ;
		$model->supplierId = $this->request()->post('supplierId') ;
		$model->phone = $this->request()->post('phone') ;
		$model->content = $this->request()->post('content') ;
		$model->staffId = $this->request()->post('staffId') ;
		$ret = $model->update() ;
		return $this->returnApi($ret['code'], $ret['msg']) ;
	}
}