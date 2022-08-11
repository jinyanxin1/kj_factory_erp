<?php

namespace frontend\actions\jobInterviewRecord;

/**
* Created by cqj
* User: cqj
* Date: 2020-07-07
* Time: 14:23
* 删除
*/
use common\models\jobInterviewRecord\JobInterviewRecordForm;
use common\library\helper\Code;
use frontend\actions\WxAction;

class DeleteAction extends WxAction
{
	public function run() {
		$model = new JobInterviewRecordForm() ;
		$model->attributes = $this->request()->post() ;
		$model->interviewId = intval(\Yii::$app->request->post('interviewId')) ;
		$ret = is_array($model->InterviewId) ? $model->delBatch() : $model->del() ;
		return $this->returnApi($ret['code'], $ret['msg']) ;
	}
}