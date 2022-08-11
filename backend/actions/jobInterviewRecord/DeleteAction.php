<?php

namespace backend\actions\jobInterviewRecord;

/**
* Created by cqj
* User: cqj
* Date: 2020-07-07
* Time: 14:23
* 删除
*/
use common\models\jobInterviewRecord\JobInterviewRecordForm;
use common\library\helper\Code;
use backend\actions\BaseAction;

class DeleteAction extends BaseAction
{
	public function run() {
		$model = new JobInterviewRecordForm() ;
		$model->attributes = $this->request()->post() ;
		$model->interviewId = \Yii::$app->request->post('interviewId') ;
		$ret = is_array($model->interviewId) ? $model->delBatch() : $model->del() ;
		return $this->returnApi($ret['code'], $ret['msg']) ;
	}
}