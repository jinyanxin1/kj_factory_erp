<?php

namespace backend\actions\clientPerson;

/**
* Created by cqj
* User: cqj
* Date: 2020-07-10
* Time: 09:48
* 删除
*/
use common\models\clientPerson\ClientPersonForm;
use common\library\helper\Code;
use backend\actions\BaseAction;

class DeleteAction extends BaseAction
{
	public function run() {
		$model = new ClientPersonForm() ;
		$model->attributes = $this->request()->post() ;
		$model->personId = intval(\Yii::$app->request->post('personId')) ;
		$ret = is_array($model->personId) ? $model->delBatch() : $model->del() ;
		return $this->returnApi($ret['code'], $ret['msg']) ;
	}
}