<?php

namespace frontend\actions\staffSection;

/**
* Created by cqj
* User: cqj
* Date: 2020-07-07
* Time: 14:22
* 详情
*/
use common\models\staffSection\StaffSectionForm;
use common\library\helper\Code;
use frontend\actions\WxAction;

class InfoAction extends WxAction
{
	public function run() {
		$model = new StaffSectionForm() ;
		$info = [] ;
		$model->attributes = $this->request()->post() ;
		$model->sectionId = intval(\Yii::$app->request->post('sectionId')) ;
		$data = $model->getInfo() ;
		if (!empty($data)) {
			$info = $model->formatInfo() ;
		}
		return $this->returnApi(Code::SUCCESS, 'ok', [ 'info' => $info ]) ;
	}
}