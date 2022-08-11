<?php

namespace frontend\actions\supplierInfo;

/**
* Created by cqj
* User: cqj
* Date: 2020-07-16
* Time: 10:22
* 删除
*/
use common\models\supplierInfo\SupplierInfoForm;
use common\library\helper\Code;
use frontend\actions\WxAction;

class DeleteAction extends WxAction
{
	public function run() {
		$model = new SupplierInfoForm() ;
		$model->attributes = $this->request()->post() ;
		$model->supplierId = intval(\Yii::$app->request->post('supplierId')) ;
		$ret = is_array($model->supplierId) ? $model->delBatch() : $model->del() ;
		return $this->returnApi($ret['code'], $ret['msg']) ;
	}
}