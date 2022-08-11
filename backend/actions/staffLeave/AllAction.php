<?php

namespace backend\actions\staffLeave;

/**
* Created by cqj
* User: cqj
* Date: 2020-07-07
* Time: 14:22
* 所有列表
*/
use common\models\staffLeave\StaffLeaveForm;
use common\library\helper\Code;
use backend\actions\BaseAction;

class AllAction extends BaseAction
{
	public function run() {
		$model = new StaffLeaveForm() ;
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