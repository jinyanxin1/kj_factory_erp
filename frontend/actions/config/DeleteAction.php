<?php

namespace frontend\actions\config;

/**
* Created by cqj
* User: cqj
* Date: 2020-07-23
* Time: 08:44
* 删除
*/
use common\models\config\ConfigForm;
use common\library\helper\Code;
use frontend\actions\WxAction;

class DeleteAction extends WxAction
{
	public function run() {
		$model = new ConfigForm() ;
		$model->attributes = $this->request()->post() ;
		$model->configId = intval(\Yii::$app->request->post('configId')) ;
		$ret = is_array($model->configId) ? $model->delBatch() : $model->del() ;
		return $this->returnApi($ret['code'], $ret['msg']) ;
	}
}