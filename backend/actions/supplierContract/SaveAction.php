<?php

namespace backend\actions\supplierContract;

/**
* Created by cqj
* User: cqj
* Date: 2020-07-16
* Time: 10:22
* 修改
*/
use common\models\supplierContract\SupplierContractForm;
use common\library\helper\Code;
use backend\actions\BaseAction;

class SaveAction extends BaseAction
{
	public function run() {
		$model = new SupplierContractForm() ;
		//TODO 具体情况接收参数
		$model->attributes = $this->request()->post() ;
		$model->contractId = $this->request()->post('contractId') ;
		$model->title = $this->request()->post('title') ;
		$model->startTime = $this->request()->post('startTime') ;
		$model->endTime = $this->request()->post('endTime') ;
		$model->pic = $this->request()->post('pic') ;
		$model->supplierId = $this->request()->post('supplierId') ;
		$model->staffId = $this->request()->post('staffId') ;
		$ret = $model->update() ;
		return $this->returnApi($ret['code'], $ret['msg']) ;
	}
}