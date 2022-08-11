<?php

namespace backend\actions\staffPosition;

/**
* Created by cqj
* User: cqj
* Date: 2020-07-02
* Time: 09:28
* 列表接口
*/

use common\models\staffPosition\StaffPositionForm;
use common\library\helper\Code;
use backend\actions\BaseAction;

class SelectAction extends BaseAction
{
	public function run() {
		$model = new StaffPositionForm() ;
        $ret = $model->getSelect() ;
        return $this->returnApi(Code::SUCCESS, 'ok', [ 'list' => $ret ]) ;
	}
}