<?php
/**
 *
 * author: jinyanxin
 * Date: 2020/9/4
 * Time: 14:46
 * PHP version 7
 */

namespace backend\actions\sales\manage;


use backend\actions\BaseAction;
use common\library\helper\Code;
use common\models\salesOrder\SalesOrderForm;
use common\models\salesOrder\SalesOrderModel;

class OrderListAction extends BaseAction
{

    public function run()
    {
        $postData = $this->request()->post();

        $salesOrder = new SalesOrderForm();
        $salesOrder->attributes = $postData;
        $result = $salesOrder->getData();

        return $this->returnApi(Code::SUCCESS,'ok',[
            'list'=>$salesOrder->formatData($result['data']),
            'pageInfo'=>$this->getPageInfo($result['count'],$salesOrder->pageSize,$salesOrder->page),
            'taxProportion'=>SalesOrderModel::TAX_PROPORTION
        ]);
    }

}