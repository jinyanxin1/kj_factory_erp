<?php

namespace backend\actions\supplierInfo;

/**
* Created by cqj
* User: cqj
* Date: 2020-07-16
* Time: 10:22
* 删除
*/
use common\models\supplierInfo\SupplierInfoForm;
use common\library\helper\Code;
use backend\actions\BaseAction;

class DeleteAction extends BaseAction
{
	public function run() {
		$model = new SupplierInfoForm() ;
		$model->attributes = $this->request()->post() ;
		$model->supplierId = intval(\Yii::$app->request->post('supplierId')) ;
		$ret =  $model->del() ;
		return $this->returnApi($ret['code'], $ret['msg']) ;
	}
}