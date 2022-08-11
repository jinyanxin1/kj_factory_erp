<?php
/**
 *
 * author: jinyanxin
 * Date: 2020/12/9
 * Time: 15:15
 * PHP version 7
 */

namespace frontend\actions\sales\manage;


use common\models\salesOrder\SalesOrderForm;
use frontend\actions\BaseAction;
use Yii;

class SaveAction extends BaseAction
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