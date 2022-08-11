<?php

namespace frontend\actions\industry;

/**
* Created by cqj
* User: cqj
* Date: 2020-07-17
* Time: 10:31
* 详情
*/
use common\models\industry\IndustryForm;
use common\library\helper\Code;
use frontend\actions\WxAction;

class InfoAction extends WxAction
{
	public function run() {
		$model = new IndustryForm() ;
		$info = [] ;
		$model->attributes = $this->request()->post() ;
		$model->industryId = intval(\Yii::$app->request->post('industryId')) ;
		$data = $model->getInfo() ;
		if (!empty($data)) {
			$info = $model->formatInfo() ;
		}
		return $this->returnApi(Code::SUCCESS, 'ok', [ 'info' => $info ]) ;
	}
}