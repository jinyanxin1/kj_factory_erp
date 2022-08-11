<?php

namespace frontend\actions\staffSection;

/**
* Created by cqj
* User: cqj
* Date: 2020-07-07
* Time: 14:22
* 修改
*/
use common\models\staffSection\StaffSectionForm;
use common\library\helper\Code;
use frontend\actions\WxAction;

class SaveAction extends WxAction
{
	public function run() {
		$model = new StaffSectionForm() ;
		//TODO 具体情况接收参数
		$model->attributes = $this->request()->post() ;
		$model->sectionId = $this->request()->post('sectionId') ;
		$model->parentId = $this->request()->post('parentId') ;
		$model->creator = $this->request()->post('creator') ;
		$model->createTime = $this->request()->post('createTime') ;
		$model->updater = $this->request()->post('updater') ;
		$model->updateTime = $this->request()->post('updateTime') ;
		$model->isValid = $this->request()->post('isValid') ;
		$model->name = $this->request()->post('name') ;
		$ret = $model->update() ;
		return $this->returnApi($ret['code'], $ret['msg']) ;
	}
}