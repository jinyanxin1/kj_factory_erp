<?php

namespace frontend\actions\jobContract;

/**
* Created by cqj
* User: cqj
* Date: 2020-09-10
* Time: 15:52
* 详情
*/
use common\models\jobContract\JobContractForm;
use common\library\helper\Code;
use backend\actions\BaseAction;
use frontend\actions\WxAction;

class InfoAction extends WxAction
{
	public function run() {
		$model = new JobContractForm() ;
		$info = [] ;
		$model->attributes = $this->request()->post() ;
		$model->contractId = intval(\Yii::$app->request->post('contractId')) ;
		$data = $model->getInfo() ;
		if (!empty($data)) {
			$info = $model->formatInfo() ;
		}
		return $this->returnApi(Code::SUCCESS, 'ok', [ 'info' => $info ]) ;
	}
}