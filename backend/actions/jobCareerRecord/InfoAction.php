<?php

namespace backend\actions\jobCareerRecord;

/**
* Created by cqj
* User: cqj
* Date: 2020-07-07
* Time: 14:23
* 详情
*/
use common\models\jobCareerRecord\JobCareerRecordForm;
use common\library\helper\Code;
use backend\actions\BaseAction;

class InfoAction extends BaseAction
{
	public function run() {
		$model = new JobCareerRecordForm() ;
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