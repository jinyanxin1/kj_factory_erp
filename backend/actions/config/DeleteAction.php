<?php

namespace backend\actions\config;

/**
* Created by cqj
* User: cqj
* Date: 2020-07-23
* Time: 08:44
* 删除
*/
use common\models\config\ConfigForm;
use common\library\helper\Code;
use backend\actions\BaseAction;

class DeleteAction extends BaseAction
{
	public function run() {
		$model = new ConfigForm() ;
		$model->attributes = $this->request()->post() ;
		$model->configId = intval(\Yii::$app->request->post('configId')) ;
		$ret = is_array($model->configId) ? $model->delBatch() : $model->del() ;
		return $this->returnApi($ret['code'], $ret['msg']) ;
	}
}