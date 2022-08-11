<?php

namespace frontend\actions\job;

/**
* Created by cqj
* User: cqj
* Date: 2020-07-07
* Time: 14:23
* 删除
*/
use common\models\jobInfo\JobInfoForm;
use common\library\helper\Code;
use frontend\actions\WxAction;

class DeleteAction extends WxAction
{
	public function run() {
		$model = new JobInfoForm() ;
		$model->attributes = $this->request()->post() ;
		$model->jobId = intval(\Yii::$app->request->post('jobId')) ;
		$ret = is_array($model->jobId) ? $model->delBatch() : $model->del() ;
		return $this->returnApi($ret['code'], $ret['msg']) ;
	}
}