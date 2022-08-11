<?php
/**
 *
 * author: jinyanxin
 * Date: 2020/11/19
 * Time: 16:59
 * PHP version 7
 */

namespace backend\actions\sales\manage;


use backend\actions\BaseAction;
use common\models\salesOrder\SalesOrderForm;

class ProCompleteAction extends BaseAction
{

    public function run()
    {
        $id = intval($this->request()->post('id'));

        $sales = new SalesOrderForm();
        $sales->id = $id;
        $result = $sales->proComplete();

        return $this->returnApi($result['code'],$result['msg']);
    }

}