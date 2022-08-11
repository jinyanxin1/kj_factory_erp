<?php

namespace frontend\actions\staffLeave;

/**
* Created by cqj
* User: cqj
* Date: 2020-07-07
* Time: 14:22
* 删除
*/
use common\models\staffLeave\StaffLeaveForm;
use common\library\helper\Code;
use frontend\actions\WxAction;

class DeleteAction extends WxAction
{
	public function run() {
		$model = new StaffLeaveForm() ;
		$model->attributes = $this->request()->post() ;
		$model->leaveId = intval(\Yii::$app->request->post('leaveId')) ;
		$ret = is_array($model->leaveId) ? $model->delBatch() : $model->del() ;
		return $this->returnApi($ret['code'], $ret['msg']) ;
	}
}