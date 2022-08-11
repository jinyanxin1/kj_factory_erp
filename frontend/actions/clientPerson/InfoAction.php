<?php

namespace frontend\actions\clientPerson;

/**
* Created by cqj
* User: cqj
* Date: 2020-07-10
* Time: 09:48
* 详情
*/
use common\models\clientPerson\ClientPersonForm;
use common\library\helper\Code;
use frontend\actions\WxAction;

class InfoAction extends WxAction
{
	public function run() {
		$model = new ClientPersonForm() ;
		$info = [] ;
		$model->attributes = $this->request()->post() ;
		$model->personId = intval(\Yii::$app->request->post('personId')) ;
		$data = $model->getInfo() ;
		if (!empty($data)) {
			$info = $model->formatInfo() ;
		}
		return $this->returnApi(Code::SUCCESS, 'ok', [ 'info' => $info ]) ;
	}
}