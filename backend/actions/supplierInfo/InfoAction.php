<?php

namespace backend\actions\supplierInfo;

/**
* Created by cqj
* User: cqj
* Date: 2020-07-16
* Time: 10:22
* 详情
*/
use common\models\supplierInfo\SupplierInfoForm;
use common\library\helper\Code;
use backend\actions\BaseAction;

class InfoAction extends BaseAction
{
	public function run() {
		$model = new SupplierInfoForm() ;
		$info = [] ;
		$model->attributes = $this->request()->post() ;
		$model->supplierId = intval(\Yii::$app->request->post('supplierId')) ;
		$data = $model->getInfo() ;
		if (!empty($data)) {
			$info = $model->formatInfo() ;
		}
		return $this->returnApi(Code::SUCCESS, 'ok', [ 'info' => $info ]) ;
	}
}