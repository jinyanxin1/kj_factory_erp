<?php

namespace backend\actions\config;

/**
* Created by cqj
* User: cqj
* Date: 2020-07-23
* Time: 08:44
* 详情
*/
use common\models\config\ConfigForm;
use common\library\helper\Code;
use backend\actions\BaseAction;

class InfoAction extends BaseAction
{
	public function run() {
		$model = new ConfigForm() ;
		$info = [] ;
		$model->attributes = $this->request()->post() ;
		$data = $model->getInfo() ;
        $info = $model->formatInfo() ;
        return $this->returnApi(Code::SUCCESS, 'ok', [ 'info' => $info ]) ;
	}
}