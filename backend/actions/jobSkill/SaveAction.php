<?php

namespace backend\actions\jobSkill;

/**
* Created by cqj
* User: cqj
* Date: 2020-07-07
* Time: 14:23
* 修改
*/
use common\models\jobSkill\JobSkillForm;
use common\library\helper\Code;
use backend\actions\BaseAction;

class SaveAction extends BaseAction
{
	public function run() {
		$model = new JobSkillForm() ;
		//TODO 具体情况接收参数
		$model->attributes = $this->request()->post() ;
		$model->id = $this->request()->post('id') ;
		$model->jobId = $this->request()->post('jobId') ;
		$model->basisId = $this->request()->post('basisId') ;
		$model->creator = $this->request()->post('creator') ;
		$model->createTime = $this->request()->post('createTime') ;
		$model->updater = $this->request()->post('updater') ;
		$model->updateTime = $this->request()->post('updateTime') ;
		$model->isValid = $this->request()->post('isValid') ;
		$ret = $model->update() ;
		return $this->returnApi($ret['code'], $ret['msg']) ;
	}
}