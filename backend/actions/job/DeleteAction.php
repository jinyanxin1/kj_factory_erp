<?php

namespace backend\actions\job;

/**
* Created by cqj
* User: cqj
* Date: 2020-07-07
* Time: 14:23
* 删除
*/
use common\models\jobInfo\JobInfoForm;
use common\library\helper\Code;
use backend\actions\BaseAction;

class DeleteAction extends BaseAction
{
	public function run() {
		$model = new JobInfoForm() ;
		$id = $this->request()->post('jobId');
		$model->jobId = $id;
        $ret = $model->setPublicJob();

		return $this->returnApi($ret['code'], $ret['msg']) ;
	}
}