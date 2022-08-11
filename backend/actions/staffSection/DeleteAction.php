<?php

namespace backend\actions\staffSection;

/**
* Created by cqj
* User: cqj
* Date: 2020-07-07
* Time: 14:22
* 删除
*/
use common\models\staffSection\StaffSectionForm;
use common\library\helper\Code;
use backend\actions\BaseAction;

class DeleteAction extends BaseAction
{
	public function run() {
		$model = new StaffSectionForm() ;
		$model->attributes = $this->request()->post() ;
		$model->sectionId = intval(\Yii::$app->request->post('sectionId')) ;
		$ret = is_array($model->sectionId) ? $model->delBatch() : $model->del() ;
		return $this->returnApi($ret['code'], $ret['msg']) ;
	}
}