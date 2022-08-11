<?php
/**
 * User: cqj
 * Date: 2020/7/10
 * Time: 8:55 上午
 */

namespace backend\actions\staffInfo;


use backend\actions\BaseAction;
use common\library\helper\Code;
use common\models\staffInfo\StaffInfoForm;

class BookAction extends BaseAction
{
    public function run() {
        $model = new StaffInfoForm() ;
        return $this->returnApi(Code::SUCCESS, 'ok',['list' => $model->getList()]) ;
    }
}
