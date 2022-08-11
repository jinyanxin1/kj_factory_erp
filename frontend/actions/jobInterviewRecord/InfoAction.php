<?php

namespace frontend\actions\jobInterviewRecord;

/**
* Created by cqj
* User: cqj
* Date: 2020-07-07
* Time: 14:23
* 详情
*/
use common\models\jobInterviewRecord\JobInterviewRecordForm;
use common\library\helper\Code;
use frontend\actions\WxAction;

class InfoAction extends WxAction
{
	public function run() {
		$model = new JobInterviewRecordForm() ;
		$info = [] ;
		$model->attributes = $this->request()->post() ;
		$model->interviewId = intval(\Yii::$app->request->post('interviewId')) ;
		$data = $model->getInfo() ;
		if (!empty($data)) {
			$info = $model->formatInfo() ;
		}
		return $this->returnApi(Code::SUCCESS, 'ok', [ 'info' => $info ]) ;
	}
}