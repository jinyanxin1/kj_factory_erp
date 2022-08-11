<?php

namespace frontend\actions\staffPosition;

/**
* Created by cqj
* User: cqj
* Date: 2020-07-07
* Time: 14:22
* 详情
*/
use common\models\staffPosition\StaffPositionForm;
use common\library\helper\Code;
use frontend\actions\WxAction;

class InfoAction extends WxAction
{
	public function run() {
		$model = new StaffPositionForm() ;
		$info = [] ;
		$model->attributes = $this->request()->post() ;
		$model->positionId = intval(\Yii::$app->request->post('positionId')) ;
		$data = $model->getInfo() ;
		if (!empty($data)) {
			$info = $model->formatInfo() ;
		}
		return $this->returnApi(Code::SUCCESS, 'ok', [ 'info' => $info ]) ;
	}
}