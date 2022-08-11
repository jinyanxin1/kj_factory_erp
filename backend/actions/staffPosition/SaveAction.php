<?php

namespace backend\actions\staffPosition;

/**
* Created by cqj
* User: cqj
* Date: 2020-07-07
* Time: 14:22
* 修改
*/
use common\models\staffPosition\StaffPositionForm;
use common\library\helper\Code;
use backend\actions\BaseAction;

class SaveAction extends BaseAction
{
	public function run() {
		$model = new StaffPositionForm() ;
		//TODO 具体情况接收参数
		$model->attributes = $this->request()->post() ;
		$model->positionId = $this->request()->post('positionId') ;
        $model->parentId = $this->request()->post('parentId') ;
        $model->name = $this->request()->post('name') ;
		$ret = $model->update() ;
		return $this->returnApi($ret['code'], $ret['msg']) ;
	}
}