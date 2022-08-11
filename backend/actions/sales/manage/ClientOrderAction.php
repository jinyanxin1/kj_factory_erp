<?php
/**
 *
 * author: jinyanxin
 * Date: 2020/11/21
 * Time: 10:03
 * PHP version 7
 */

namespace backend\actions\sales\manage;


use backend\actions\BaseAction;
use common\library\helper\Code;
use common\models\salesOrder\SalesOrderForm;

class ClientOrderAction extends BaseAction
{

    public function run()
    {
        $clientId = intval($this->request()->post('clientId'));

        $order = new SalesOrderForm();
        $order->clientId = $clientId;
        $result = $order->getClientOrder();

        return $this->returnApi(Code::SUCCESS,'ok',['list'=>$result]);
    }

}