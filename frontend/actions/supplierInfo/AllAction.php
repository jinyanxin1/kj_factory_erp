<?php

namespace frontend\actions\supplierInfo;

/**
* Created by cqj
* User: cqj
* Date: 2020-07-16
* Time: 10:22
* 所有列表
*/
use common\models\supplierInfo\SupplierInfoForm;
use common\library\helper\Code;
use frontend\actions\WxAction;

class AllAction extends WxAction
{
	public function run() {
		$model = new SupplierInfoForm() ;
		$list = [] ;
		//TODO 具体情况接收条件参数
		$model->attributes = $this->request()->post() ;
		$ret = $model->getAll() ;
		$data = isset($ret['list']) ? $ret['list'] : [] ;
		if (!empty($data)) {
			$list = $model->formatAll() ;
		}
		return $this->returnApi(Code::SUCCESS, 'ok', [ 'list' => $list ]) ;
	}
}