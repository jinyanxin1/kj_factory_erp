<?php

namespace backend\actions\staffContract;

/**
* Created by cqj
* User: cqj
* Date: 2020-07-07
* Time: 14:22
* 新增
*/
use common\models\staffContract\StaffContractForm;
use common\library\helper\Code;
use backend\actions\BaseAction;

class AddAction extends BaseAction
{
	public function run() {
		$model = new StaffContractForm() ;
		//TODO 具体情况接收参数
		$model->attributes = $this->request()->post() ;
		$model->staffId = $this->request()->post('staffId') ;
		$model->title = $this->request()->post('title') ;
		$model->startTime = $this->request()->post('startTime') ;
		$model->endTime = $this->request()->post('endTime') ;
		$model->laborContractPic = $this->request()->post('laborContractPic') ;
		$model->competitionAgreementPic = $this->request()->post('competitionAgreementPic') ;
		$model->confidentialityContract = $this->request()->post('confidentialityContract') ;
		$model->attributes = $this->request()->post() ;
		$ret = $model->add() ;
		return $this->returnApi($ret['code'], $ret['msg']) ;
	}
}