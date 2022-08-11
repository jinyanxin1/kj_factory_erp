<?php

namespace backend\actions\staffInfo;

/**
* Created by cqj
* User: cqj
* Date: 2020-07-07
* Time: 14:22
* 详情
*/
use common\models\staffInfo\StaffInfoForm;
use common\library\helper\Code;
use backend\actions\BaseAction;

class InfoAction extends BaseAction
{
	public function run() {
		$model = new StaffInfoForm() ;
		$info = [] ;
		$model->attributes = $this->request()->post() ;
		$model->staffId = intval(\Yii::$app->request->post('staffId')) ;
		$data = $model->getInfo() ;
		if (!empty($data)) {
			$info = $model->formatInfo() ;
		}
		return $this->returnApi(Code::SUCCESS, 'ok', [ 'info' => $info ]) ;
	}
}