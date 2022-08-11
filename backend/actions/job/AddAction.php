<?php

namespace backend\actions\job;

/**
* Created by cqj
* User: cqj
* Date: 2020-07-07
* Time: 14:23
* 新增
*/
use common\models\jobInfo\JobInfoForm;
use common\library\helper\Code;
use backend\actions\BaseAction;

class AddAction extends BaseAction
{
	public function run() {
		$model = new JobInfoForm() ;
		//TODO 具体情况接收参数
		$model->attributes = $this->request()->post() ;
		$model->clientId = $this->request()->post('clientId') ;
		$model->staffId = $this->request()->post('staffId') ;
		$model->supplierId = $this->request()->post('supplierId') ;
		$model->name = $this->request()->post('name') ;
		$model->sex = $this->request()->post('sex') ;
		$model->phone = $this->request()->post('phone') ;
		$model->birthday = $this->request()->post('birthday') ;
		$model->education = $this->request()->post('education') ;
		$model->channelId = $this->request()->post('channelId') ;
        $model->remark = $this->request()->post('remark') ;
        $model->age = $this->request()->post('age') ;
        $model->address = $this->request()->post('address') ;
        $model->isLunarCalendar = $this->request()->post('isLunarCalendar') ;
        $model->idCard = $this->request()->post('idCard') ;
        $model->skillId = $this->request()->post('skillId') ;
		$model->attributes = $this->request()->post() ;
        $ret = $model->add() ;
		return $this->returnApi($ret['code'], $ret['msg'],['id'=>$model->jobId]) ;
	}
}