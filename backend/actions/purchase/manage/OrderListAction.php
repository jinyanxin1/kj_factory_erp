<?php
/**
 *
 * author: jinyanxin
 * Date: 2020/9/4
 * Time: 9:53
 * PHP version 7
 */

namespace backend\actions\purchase\manage;


use backend\actions\BaseAction;
use backend\models\purchaseOrder\PurchaseOrderForm;
use common\library\helper\Code;

class OrderListAction extends BaseAction
{

    public function run()
    {
        $postData = $this->request()->post();

        $purchaseOrder = new PurchaseOrderForm();
        $purchaseOrder->attributes = $postData;

        $result = $purchaseOrder->getData();

        return $this->returnApi(Code::SUCCESS,'ok',[
            'list'=>$purchaseOrder->formatData($result['data']),
            'pageInfo'=>$this->getPageInfo($result['count'],$purchaseOrder->pageSize,$purchaseOrder->page)
        ]);

    }

}