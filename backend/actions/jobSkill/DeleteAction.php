<?php

namespace backend\actions\jobSkill;

/**
* Created by cqj
* User: cqj
* Date: 2020-07-07
* Time: 14:23
* 删除
*/
use common\models\jobSkill\JobSkillForm;
use common\library\helper\Code;
use backend\actions\BaseAction;

class DeleteAction extends BaseAction
{
	public function run() {
		$model = new JobSkillForm() ;
		$model->attributes = $this->request()->post() ;
		$model->id = intval(\Yii::$app->request->post('id')) ;
		$ret = is_array($model->id) ? $model->delBatch() : $model->del() ;
		return $this->returnApi($ret['code'], $ret['msg']) ;
	}
}