<?php
/**
 *
 * author: jinyanxin
 * Date: 2020/12/9
 * Time: 14:51
 * PHP version 7
 */

namespace backend\actions\finance\order;


use backend\actions\BaseAction;
use common\library\helper\Code;
use common\models\salesOrder\SalesOrderForm;

class ListAction extends BaseAction
{

    public function run()
    {
        $post = $this->request()->post();
        $status = intval($this->request()->post('status'));
        $salesOrder = new SalesOrderForm();
        $salesOrder->attributes = $post;
        $salesOrder->collectionStatus = $status;
        $salesOrder->status = 0;
        $result = $salesOrder->getData();

        return $this->returnApi(Code::SUCCESS,'ok',[
            'list'=>$salesOrder->formatData($result['data']),
            'pageInfo'=>$this->getPageInfo($result['count'],$salesOrder->pageSize,$salesOrder->page)
        ]);
    }


}