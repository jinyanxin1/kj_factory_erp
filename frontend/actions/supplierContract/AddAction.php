<?php

namespace frontend\actions\supplierContract;

/**
* Created by cqj
* User: cqj
* Date: 2020-07-16
* Time: 10:22
* 新增
*/
use common\models\supplierContract\SupplierContractForm;
use common\library\helper\Code;
use frontend\actions\WxAction;

class AddAction extends WxAction
{
	public function run() {
		$model = new SupplierContractForm() ;
		//TODO 具体情况接收参数
		$model->attributes = $this->request()->post() ;
		$model->title = $this->request()->post('title') ;
        $model->basisId = $this->request()->post('basisId') ;
        $model->startTime = $this->request()->post('startTime') ;
		$model->endTime = $this->request()->post('endTime') ;
		$model->pic = $this->request()->post('pic') ;
		$model->supplierId = $this->request()->post('supplierId') ;
		$model->staffId = $this->request()->post('staffId') ;
		$model->attributes = $this->request()->post() ;
		$ret = $model->add() ;
		return $this->returnApi($ret['code'], $ret['msg']) ;
	}
}