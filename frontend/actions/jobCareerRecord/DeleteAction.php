<?php

namespace frontend\actions\jobCareerRecord;

/**
* Created by cqj
* User: cqj
* Date: 2020-07-07
* Time: 14:23
* 删除
*/
use common\models\jobCareerRecord\JobCareerRecordForm;
use common\library\helper\Code;
use frontend\actions\WxAction;

class DeleteAction extends WxAction
{
	public function run() {
		$model = new JobCareerRecordForm() ;
		$model->attributes = $this->request()->post() ;
		$model->recordId = intval(\Yii::$app->request->post('recordId')) ;
		$ret = is_array($model->recordId) ? $model->delBatch() : $model->del() ;
		return $this->returnApi($ret['code'], $ret['msg']) ;
	}
}