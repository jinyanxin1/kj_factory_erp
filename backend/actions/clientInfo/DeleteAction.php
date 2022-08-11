<?php

namespace backend\actions\clientInfo;

/**
* Created by cqj
* User: cqj
* Date: 2020-07-10
* Time: 09:48
* 删除
*/
use common\models\clientInfo\ClientInfoForm;
use common\library\helper\Code;
use backend\actions\BaseAction;

class DeleteAction extends BaseAction
{
	public function run() {
		$model = new ClientInfoForm() ;
		$model->attributes = $this->request()->post() ;
		$model->clientId = intval(\Yii::$app->request->post('clientId')) ;
		$ret = $model->del() ;
		return $this->returnApi($ret['code'], $ret['msg']) ;
	}
}