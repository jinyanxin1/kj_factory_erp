<?php

namespace backend\actions\clientInfo;

/**
* Created by cqj
* User: cqj
* Date: 2020-07-10
* Time: 09:48
* 详情
*/
use common\models\clientInfo\ClientInfoForm;
use common\library\helper\Code;
use backend\actions\BaseAction;

class InfoAction extends BaseAction
{
	public function run() {
		$model = new ClientInfoForm() ;
		$info = [] ;
		$model->attributes = $this->request()->post() ;
		$model->clientId = intval(\Yii::$app->request->post('clientId')) ;
		$data = $model->getInfo() ;
		if (!empty($data)) {
			$info = $model->formatInfo() ;
		}
		return $this->returnApi(Code::SUCCESS, 'ok', [ 'info' => $info ]) ;
	}
}