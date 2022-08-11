<?php

namespace backend\actions\clientPerson;

/**
* Created by cqj
* User: cqj
* Date: 2020-07-10
* Time: 09:48
* 所有列表
*/
use common\models\clientPerson\ClientPersonForm;
use common\library\helper\Code;
use backend\actions\BaseAction;

class AllAction extends BaseAction
{
	public function run() {
		$model = new ClientPersonForm() ;
		$list = [] ;
		//TODO 具体情况接收条件参数
		$model->attributes = $this->request()->post() ;
        $model->clientId = intval(\Yii::$app->request->post('clientId')) ;
        $model->name = (\Yii::$app->request->post('name')) ;
        $ret = $model->getAll() ;
		$data = isset($ret['list']) ? $ret['list'] : [] ;
		if (!empty($data)) {
			$list = $model->formatAll() ;
		}
		return $this->returnApi(Code::SUCCESS, 'ok', [ 'list' => $list ]) ;
	}
}