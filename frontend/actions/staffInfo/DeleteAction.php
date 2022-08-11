<?php

namespace frontend\actions\staffInfo;

/**
* Created by cqj
* User: cqj
* Date: 2020-07-07
* Time: 14:22
* 删除
*/
use common\models\staffInfo\StaffInfoForm;
use common\library\helper\Code;
use frontend\actions\WxAction;

class DeleteAction extends WxAction
{
	public function run() {
		$model = new StaffInfoForm() ;
		$model->attributes = $this->request()->post() ;
		$model->staffId = intval(\Yii::$app->request->post('staffId')) ;
		$ret = is_array($model->staffId) ? $model->delBatch() : $model->del() ;
		return $this->returnApi($ret['code'], $ret['msg']) ;
	}
}