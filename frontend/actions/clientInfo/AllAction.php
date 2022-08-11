<?php

namespace frontend\actions\clientInfo;

/**
* Created by cqj
* User: cqj
* Date: 2020-07-10
* Time: 09:48
* 所有列表
*/
use common\models\clientInfo\ClientInfoForm;
use common\library\helper\Code;
use frontend\actions\WxAction;

class AllAction extends WxAction
{
	public function run() {
		$model = new ClientInfoForm() ;
		$list = [] ;
		//TODO 具体情况接收条件参数
		$model->attributes = $this->request()->post() ;
		$ret = $model->getAll() ;
		$data = isset($ret['list']) ? $ret['list'] : [] ;
		if (!empty($data)) {
			$list = $model->formatAll() ;
		}
		return $this->returnApi(Code::SUCCESS, 'ok', [ 'list' => $list ]) ;
	}
}