<?php

namespace frontend\actions\supplierInfo;

/**
* Created by cqj
* User: cqj
* Date: 2020-07-16
* Time: 10:22
* 新增
*/
use common\models\supplierInfo\SupplierInfoForm;
use common\library\helper\Code;
use frontend\actions\WxAction;

class AddAction extends WxAction
{
	public function run() {
		$model = new SupplierInfoForm() ;
		//TODO 具体情况接收参数
		$model->attributes = $this->request()->post() ;
//		$model->provinceId = $this->request()->post('provinceId') ;
//		$model->cityId = $this->request()->post('cityId') ;
        $model->area = $this->request()->post('area') ;
		$model->industryId = $this->request()->post('industryId') ;
		$model->staffId = $this->request()->post('staffId') ;
		$model->type = $this->request()->post('type') ;
		$model->tell = $this->request()->post('tell') ;
		$model->address = $this->request()->post('address') ;
		$model->settlement = $this->request()->post('settlement') ;
		$model->cycle = $this->request()->post('cycle') ;
		$model->startTime = $this->request()->post('startTime') ;
		$model->endTime = $this->request()->post('endTime') ;
		$model->name = $this->request()->post('name') ;
		$model->account = $this->request()->post('account') ;
		$model->accountBank = $this->request()->post('accountBank') ;
		$model->remark = $this->request()->post('remark') ;
        $model->supplierType = $this->request()->post('supplierType') ;
        $model->userName = $this->request()->post('userName') ;
		$ret = $model->add() ;
		return $this->returnApi($ret['code'], $ret['msg']) ;
	}
}