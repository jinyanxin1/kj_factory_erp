<?php

namespace frontend\actions\supplierContract;

/**
* Created by cqj
* User: cqj
* Date: 2020-07-16
* Time: 10:22
* 详情
*/
use common\models\supplierContract\SupplierContractForm;
use common\library\helper\Code;
use frontend\actions\WxAction;

class InfoAction extends WxAction
{
	public function run() {
		$model = new SupplierContractForm() ;
		$info = [] ;
		$model->attributes = $this->request()->post() ;
		$model->contractId = intval(\Yii::$app->request->post('contractId')) ;
		$data = $model->getInfo() ;
		if (!empty($data)) {
			$info = $model->formatInfo() ;
		}
		return $this->returnApi(Code::SUCCESS, 'ok', [ 'info' => $info ]) ;
	}
}