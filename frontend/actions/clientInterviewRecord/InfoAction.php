<?php

namespace frontend\actions\clientInterviewRecord;

/**
* Created by cqj
* User: cqj
* Date: 2020-07-10
* Time: 09:48
* 详情
*/
use common\models\clientInterviewRecord\ClientInterviewRecordForm;
use common\library\helper\Code;
use frontend\actions\WxAction;

class InfoAction extends WxAction
{
	public function run() {
		$model = new ClientInterviewRecordForm() ;
		$info = [] ;
		$model->attributes = $this->request()->post() ;
		$model->recordId = intval(\Yii::$app->request->post('recordId')) ;
		$data = $model->getInfo() ;
		if (!empty($data)) {
			$info = $model->formatInfo() ;
		}
		return $this->returnApi(Code::SUCCESS, 'ok', [ 'info' => $info ]) ;
	}
}