<?php

namespace frontend\actions\clientPerson;

/**
* Created by cqj
* User: cqj
* Date: 2020-07-10
* Time: 09:48
* 删除
*/
use common\models\clientPerson\ClientPersonForm;
use common\library\helper\Code;
use frontend\actions\WxAction;

class DeleteAction extends WxAction
{
	public function run() {
		$model = new ClientPersonForm() ;
		$model->attributes = $this->request()->post() ;
		$model->personId = intval(\Yii::$app->request->post('personId')) ;
		$ret = is_array($model->personId) ? $model->delBatch() : $model->del() ;
		return $this->returnApi($ret['code'], $ret['msg']) ;
	}
}