<?php

namespace backend\actions\clientContract;

/**
* Created by cqj
* User: cqj
* Date: 2020-07-10
* Time: 09:48
* 详情
*/
use common\models\clientContract\ClientContractForm;
use common\library\helper\Code;
use backend\actions\BaseAction;

class InfoAction extends BaseAction
{
	public function run() {
		$model = new ClientContractForm() ;
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