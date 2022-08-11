<?php

namespace frontend\actions\staffLeave;

/**
* Created by cqj
* User: cqj
* Date: 2020-07-07
* Time: 14:22
* 修改
*/
use common\models\staffLeave\StaffLeaveForm;
use common\library\helper\Code;
use frontend\actions\WxAction;

class SaveAction extends WxAction
{
	public function run() {
		$model = new StaffLeaveForm() ;
		//TODO 具体情况接收参数
		$model->attributes = $this->request()->post() ;
		$model->leaveId = $this->request()->post('leaveId') ;
		$model->staffId = $this->request()->post('staffId') ;
		$model->creator = $this->request()->post('creator') ;
		$model->createTime = $this->request()->post('createTime') ;
		$model->updater = $this->request()->post('updater') ;
		$model->updateTime = $this->request()->post('updateTime') ;
		$model->isValid = $this->request()->post('isValid') ;
		$model->time = $this->request()->post('time') ;
		$model->leaveReason = $this->request()->post('leaveReason') ;
		$model->leavePic = $this->request()->post('leavePic') ;
		$ret = $model->update() ;
		return $this->returnApi($ret['code'], $ret['msg']) ;
	}
}