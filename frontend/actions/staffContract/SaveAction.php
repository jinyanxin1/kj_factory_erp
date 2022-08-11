<?php

namespace frontend\actions\staffContract;

/**
* Created by cqj
* User: cqj
* Date: 2020-07-07
* Time: 14:22
* 修改
*/
use common\models\staffContract\StaffContractForm;
use common\library\helper\Code;
use frontend\actions\WxAction;

class SaveAction extends WxAction
{
	public function run() {
		$model = new StaffContractForm() ;
		//TODO 具体情况接收参数
		$model->attributes = $this->request()->post() ;
		$model->contractId = $this->request()->post('contractId') ;
		$model->staffId = $this->request()->post('staffId') ;
		$model->creator = $this->request()->post('creator') ;
		$model->createTime = $this->request()->post('createTime') ;
		$model->updater = $this->request()->post('updater') ;
		$model->updateTime = $this->request()->post('updateTime') ;
		$model->isValid = $this->request()->post('isValid') ;
		$model->title = $this->request()->post('title') ;
		$model->startTime = $this->request()->post('startTime') ;
		$model->endTime = $this->request()->post('endTime') ;
		$model->laborContractPic = $this->request()->post('laborContractPic') ;
		$model->competitionAgreementPic = $this->request()->post('competitionAgreementPic') ;
		$model->confidentialityContract = $this->request()->post('confidentialityContract') ;
		$ret = $model->update() ;
		return $this->returnApi($ret['code'], $ret['msg']) ;
	}
}