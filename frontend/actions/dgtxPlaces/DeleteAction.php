<?php

namespace frontend\actions\dgtxPlaces;

/**
* Created by cqj
* User: cqj
* Date: 2020-07-02
* Time: 09:28
* 删除
*/
use common\models\system\dgtxPlaces\DgtxPlacesForm;
use common\library\helper\Code;
use frontend\actions\WxAction;

class DeleteAction extends WxAction
{
	public function run() {
		$model = new DgtxPlacesForm() ;
		$model->attributes = $this->request()->post() ;
		$model->id = intval(\Yii::$app->request->post('id')) ;
		$ret = is_array($model->id) ? $model->delBatch() : $model->del() ;
		return $this->returnApi($ret['code'], $ret['msg']) ;
	}
}