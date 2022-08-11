<?php
/**
 *
 * author: jinyanxin
 * Date: 2020/11/17
 * Time: 14:03
 * PHP version 7
 */

namespace backend\actions\sales\manage;


use backend\actions\BaseAction;
use common\models\salesOrder\SalesOrderForm;

class SendAction extends BaseAction
{

    public function run()
    {
        $sendDate = $this->request()->post('sendDate');
        $sendWay = $this->request()->post('sendWay');
        $orderId = intval($this->request()->post('id'));
        $clientPersonId = intval($this->request()->post('clientPersonId'));
        $clientAddress = $this->request()->post('clientAddress');
        $salesOrder = new SalesOrderForm();
        $salesOrder->sendDate = $sendDate;
        $salesOrder->sendWay = $sendWay;
        $salesOrder->id = $orderId;
        $salesOrder->clientPersonId = $clientPersonId;
        $salesOrder->clientAddress = $clientAddress;
        $result = $salesOrder->send();

        return $this->returnApi($result['code'],$result['msg']);
    }

}