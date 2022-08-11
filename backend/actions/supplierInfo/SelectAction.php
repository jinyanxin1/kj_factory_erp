<?php

namespace backend\actions\supplierInfo;

/**
* Created by cqj
* User: cqj
* Date: 2020-07-07
* Time: 14:22
* 列表
*/

use common\models\clientInfo\ClientInfoForm;
use common\library\helper\Code;
use backend\actions\BaseAction;
use common\models\supplierInfo\SupplierInfoForm;

class SelectAction extends BaseAction
{
	public function run() {
		$model = new SupplierInfoForm() ;
        $model->staffId = $this->request()->post('staffId') ;

        $list = [] ;
		//TODO 具体情况接收条件参数
		$ret = $model->getAll() ;
		if (!empty($ret)) {
			$list = $model->formatAll() ;
		}
		return $this->returnApi(Code::SUCCESS, 'ok', [ 'select' => $list ]) ;
	}
}