<?php

namespace backend\actions\staffLeave;

/**
* Created by cqj
* User: cqj
* Date: 2020-07-07
* Time: 14:22
* 新增
*/
use common\models\staffLeave\StaffLeaveForm;
use common\library\helper\Code;
use backend\actions\BaseAction;

class AddAction extends BaseAction
{
	public function run() {
		$model = new StaffLeaveForm() ;
		//TODO 具体情况接收参数
		$model->attributes = $this->request()->post() ;
		$model->staffId = $this->request()->post('staffId') ;
		$model->time = $this->request()->post('time') ;
		$model->leaveReason = $this->request()->post('leaveReason') ;
        $model->leavePic = $this->request()->post('leavePic') ;
        $model->leaveType = $this->request()->post('leaveType') ;
		$model->attributes = $this->request()->post() ;
		$ret = $model->add() ;
		return $this->returnApi($ret['code'], $ret['msg']) ;
	}
}