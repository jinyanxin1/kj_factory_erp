<?php
/**
 *
 * author: jinyanxin
 * Date: 2020/9/4
 * Time: 15:13
 * PHP version 7
 */

namespace backend\actions\sales\manage;


use backend\actions\BaseAction;
use common\library\helper\Code;
use common\models\salesOrder\SalesOrderDetailForm;

class GoodsListAction extends BaseAction
{

    public function run()
    {
        $orderId = intval($this->request()->post('id'));

        $salesOrderDetail = new SalesOrderDetailForm();
        $salesOrderDetail->orderId = $orderId;

        $data = $salesOrderDetail->getMaterial();

        return $this->returnApi($data['code'],$data['msg'],['list'=>$data['list']]);
    }

}