<?php

namespace frontend\actions\staffContract;

/**
* Created by cqj
* User: cqj
* Date: 2020-07-07
* Time: 14:22
* 删除
*/
use common\models\staffContract\StaffContractForm;
use common\library\helper\Code;
use frontend\actions\WxAction;

class DeleteAction extends WxAction
{
	public function run() {
		$model = new StaffContractForm() ;
		$model->attributes = $this->request()->post() ;
		$model->contractId = intval(\Yii::$app->request->post('contractId')) ;
		$ret = is_array($model->contractId) ? $model->delBatch() : $model->del() ;
		return $this->returnApi($ret['code'], $ret['msg']) ;
	}
}