<?php

namespace backend\actions\jobContract;

/**
* Created by cqj
* User: cqj
* Date: 2020-09-10
* Time: 15:52
* 删除
*/
use common\models\jobContract\JobContractForm;
use common\library\helper\Code;
use backend\actions\BaseAction;

class DeleteAction extends BaseAction
{
	public function run() {
		$model = new JobContractForm() ;
		$model->attributes = $this->request()->post() ;
		$model->contractId = intval(\Yii::$app->request->post('contractId')) ;
		$ret = is_array($model->contractId) ? $model->delBatch() : $model->del() ;
		return $this->returnApi($ret['code'], $ret['msg']) ;
	}
}