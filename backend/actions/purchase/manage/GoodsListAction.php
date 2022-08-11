<?php
/**
 *
 * author: jinyanxin
 * Date: 2020/9/4
 * Time: 10:25
 * PHP version 7
 */

namespace backend\actions\purchase\manage;


use backend\actions\BaseAction;
use backend\models\purchaseOrder\PurchaseOrderDetailForm;
use common\library\helper\Code;

class GoodsListAction extends BaseAction
{

    public function run()
    {
        $postData = $this->request()->post();

        $purchaseOrderDetail = new PurchaseOrderDetailForm();
        $purchaseOrderDetail->attributes = $postData;

        $result = $purchaseOrderDetail->getData();

        return $this->returnApi(Code::SUCCESS,'ok',[
            'list'=>$purchaseOrderDetail->formatData($result['data'])
        ]);
    }

}