<?php

namespace frontend\actions\job;

/**
* Created by cqj
* User: cqj
* Date: 2020-07-07
* Time: 14:23
* 所有列表
*/
use common\models\jobInfo\JobInfoForm;
use common\library\helper\Code;
use frontend\actions\WxAction;

class AllAction extends WxAction
{
	public function run() {
		$model = new JobInfoForm() ;
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