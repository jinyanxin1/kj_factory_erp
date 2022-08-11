<?php

namespace backend\actions\jobSocialSecurity;

/**
* Created by cqj
* User: cqj
* Date: 2020-07-07
* Time: 14:23
* 所有列表
*/
use common\models\jobSocialSecurity\JobSocialSecurityForm;
use common\library\helper\Code;
use backend\actions\BaseAction;

class AllAction extends BaseAction
{
	public function run() {
		$model = new JobSocialSecurityForm() ;
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