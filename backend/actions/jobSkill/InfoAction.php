<?php

namespace backend\actions\jobSkill;

/**
* Created by cqj
* User: cqj
* Date: 2020-07-07
* Time: 14:23
* 详情
*/
use common\models\jobSkill\JobSkillForm;
use common\library\helper\Code;
use backend\actions\BaseAction;

class InfoAction extends BaseAction
{
	public function run() {
		$model = new JobSkillForm() ;
		$info = [] ;
		$model->attributes = $this->request()->post() ;
		$model->id = intval(\Yii::$app->request->post('id')) ;
		$data = $model->getInfo() ;
		if (!empty($data)) {
			$info = $model->formatInfo() ;
		}
		return $this->returnApi(Code::SUCCESS, 'ok', [ 'info' => $info ]) ;
	}
}