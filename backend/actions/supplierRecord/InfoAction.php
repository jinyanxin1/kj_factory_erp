<?php

namespace backend\actions\supplierRecord;

/**
* Created by cqj
* User: cqj
* Date: 2020-07-16
* Time: 10:20
* 详情
*/
use common\models\supplierRecord\SupplierRecordForm;
use common\library\helper\Code;
use backend\actions\BaseAction;

class InfoAction extends BaseAction
{
	public function run() {
		$model = new SupplierRecordForm() ;
		$info = [] ;
		$model->attributes = $this->request()->post() ;
		$model->recordId = intval(\Yii::$app->request->post('recordId')) ;
		$data = $model->getInfo() ;
		if (!empty($data)) {
			$info = $model->formatInfo() ;
		}
		return $this->returnApi(Code::SUCCESS, 'ok', [ 'info' => $info ]) ;
	}
}