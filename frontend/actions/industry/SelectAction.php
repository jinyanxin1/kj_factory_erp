<?php

namespace frontend\actions\industry;

/**
* Created by cqj
* User: cqj
* Date: 2020-07-02
* Time: 09:28
* 列表接口
*/

use common\models\industry\IndustryForm;
use common\library\helper\Code;
use frontend\actions\WxAction;

class SelectAction extends WxAction
{
	public function run() {
		$model = new IndustryForm() ;
        $ret = $model->getSelect() ;
        return $this->returnApi(Code::SUCCESS, 'ok', [ 'list' => $ret ]) ;
	}
}