<?php

namespace frontend\actions\job;

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

class PublicDeleteAction extends BaseAction
{
	public function run() {
		$model = new JobInfoForm() ;
		$id = $this->request()->post('jobId');
		$model->jobId = $id;
        $ret = is_array($model->jobId) ? $model->delBatch() : $model->del() ;
		return $this->returnApi($ret['code'], $ret['msg']) ;
	}
}