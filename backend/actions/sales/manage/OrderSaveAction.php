<?php
/**
 *
 * author: jinyanxin
 * Date: 2020/9/4
 * Time: 10:55
 * PHP version 7
 */

namespace backend\actions\sales\manage;


use backend\actions\BaseAction;
use common\models\salesOrder\SalesOrderForm;
use Yii;

class OrderSaveAction extends BaseAction
{

    public function run()
    {
        $postData = $this->request()->post();
        Yii::info('save sales order post data：'.print_r($postData,true),'salesOrder');
        $salesOrder = new SalesOrderForm();
        $salesOrder->attributes = $postData;
        $result = $salesOrder->saveInfo();

        return $this->returnApi($result['code'],$result['msg']);

    }

}