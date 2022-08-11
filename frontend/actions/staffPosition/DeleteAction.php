<?php

namespace frontend\actions\staffPosition;

/**
* Created by cqj
* User: cqj
* Date: 2020-07-07
* Time: 14:22
* 删除
*/
use common\models\staffPosition\StaffPositionForm;
use common\library\helper\Code;
use frontend\actions\WxAction;

class DeleteAction extends WxAction
{
	public function run() {
		$model = new StaffPositionForm() ;
		$model->attributes = $this->request()->post() ;
		$model->positionId = intval(\Yii::$app->request->post('positionId')) ;
		$ret = is_array($model->positionId) ? $model->delBatch() : $model->del() ;
		return $this->returnApi($ret['code'], $ret['msg']) ;
	}
}