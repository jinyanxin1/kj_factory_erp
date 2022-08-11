<?php

namespace frontend\actions\staffLeave;

/**
* Created by cqj
* User: cqj
* Date: 2020-07-07
* Time: 14:22
* 详情
*/
use common\models\staffLeave\StaffLeaveForm;
use common\library\helper\Code;
use frontend\actions\WxAction;

class InfoAction extends WxAction
{
	public function run() {
		$model = new StaffLeaveForm() ;
		$info = [] ;
		$model->attributes = $this->request()->post() ;
		$model->leaveId = intval(\Yii::$app->request->post('leaveId')) ;
		$data = $model->getInfo() ;
		if (!empty($data)) {
			$info = $model->formatInfo() ;
		}
		return $this->returnApi(Code::SUCCESS, 'ok', [ 'info' => $info ]) ;
	}
}