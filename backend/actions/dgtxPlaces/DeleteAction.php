<?php

namespace backend\actions\dgtxPlaces;

/**
* Created by cqj
* User: cqj
* Date: 2020-07-02
* Time: 09:28
* 删除
*/
use common\models\system\dgtxPlaces\DgtxPlacesForm;
use common\library\helper\Code;
use backend\actions\BaseAction;

class DeleteAction extends BaseAction
{
	public function run() {
		$model = new DgtxPlacesForm() ;
		$model->attributes = $this->request()->post() ;
		$model->id = intval(\Yii::$app->request->post('id')) ;
		$ret = is_array($model->id) ? $model->delBatch() : $model->del() ;
		return $this->returnApi($ret['code'], $ret['msg']) ;
	}
}