<?php
/**
 *
 * author: jinyanxin
 * Date: 2020/9/3
 * Time: 14:53
 * PHP version 7
 */

namespace backend\actions\purchase\manage;


use backend\actions\BaseAction;
use backend\models\purchaseOrder\PurchaseOrderForm;
use Yii;

class OrderSaveAction extends BaseAction
{

    /**
     * 采购单信息保存
     * */
    public function run()
    {
        $postData = $this->request()->post();
        Yii::info('save purchase order info：'.print_r($postData,true),'purchaseOrder');

        $purchaseOrder = new PurchaseOrderForm();
        $purchaseOrder->attributes = $postData;
        $result = $purchaseOrder->saveInfo();

        return $this->returnApi($result['code'],$result['msg']);
    }

}