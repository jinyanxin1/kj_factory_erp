<?php

namespace backend\actions\supplierRecord;

/**
* Created by cqj
* User: cqj
* Date: 2020-07-16
* Time: 10:20
* 删除
*/
use common\models\supplierRecord\SupplierRecordForm;
use common\library\helper\Code;
use backend\actions\BaseAction;

class DeleteAction extends BaseAction
{
	public function run() {
		$model = new SupplierRecordForm() ;
		$model->attributes = $this->request()->post() ;
		$model->recordId = intval(\Yii::$app->request->post('recordId')) ;
		$ret = is_array($model->recordId) ? $model->delBatch() : $model->del() ;
		return $this->returnApi($ret['code'], $ret['msg']) ;
	}
}