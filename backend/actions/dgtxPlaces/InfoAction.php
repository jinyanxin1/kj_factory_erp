<?php

namespace backend\actions\dgtxPlaces;

/**
* Created by cqj
* User: cqj
* Date: 2020-07-02
* Time: 09:28
* 详情
*/
use common\models\system\dgtxPlaces\DgtxPlacesForm;
use common\library\helper\Code;
use backend\actions\BaseAction;

class InfoAction extends BaseAction
{
	public function run() {
		$model = new DgtxPlacesForm() ;
		$info = [] ;
		$model->attributes = $this->request()->post() ;
		$model->id = intval(\Yii::$app->request->post('id')) ;
		$data = $model->getInfo() ;
		if (!empty($data)) {
			$info = $model->formatInfo() ;
		}
		return $this->returnApi(Code::SUCCESS, 'ok', [ 'info' => $info ]) ;
	}
}