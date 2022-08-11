<?php

namespace backend\actions\staffInfo;

/**
* Created by cqj
* User: cqj
* Date: 2020-07-07
* Time: 14:22
* 删除
*/
use common\models\staffInfo\StaffInfoForm;
use common\library\helper\Code;
use backend\actions\BaseAction;

class DeleteAction extends BaseAction
{
	public function run() {
		$model = new StaffInfoForm() ;
		$model->attributes = $this->request()->post() ;
		$model->staffId = intval(\Yii::$app->request->post('staffId')) ;
		$ret = $model->del() ;
		return $this->returnApi($ret['code'], $ret['msg']) ;
	}
}