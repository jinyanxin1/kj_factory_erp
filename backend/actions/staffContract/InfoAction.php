<?php

namespace backend\actions\staffContract;

/**
* Created by cqj
* User: cqj
* Date: 2020-07-07
* Time: 14:22
* 详情
*/
use common\models\staffContract\StaffContractForm;
use common\library\helper\Code;
use backend\actions\BaseAction;

class InfoAction extends BaseAction
{
	public function run() {
		$model = new StaffContractForm() ;
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