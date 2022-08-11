<?php
/**
 *
 * author: jinyanxin
 * Date: 2020/11/26
 * Time: 14:38
 * PHP version 7
 */

namespace frontend\actions\sales\manage;


use common\library\helper\Code;
use common\models\salesOrder\SalesOrderForm;
use common\models\salesOrder\SalesOrderModel;
use frontend\actions\BaseAction;

class ListAction extends BaseAction
{

    public function run()
    {
        $postData = $this->request()->post();

        $sales = new SalesOrderForm();
        $sales->attributes = $postData;
        $result = $sales->getData();

        return $this->returnApi(Code::SUCCESS,'ok',[
            'list'=>$sales->formatData($result['data']),
            'pageInfo'=>$this->getPageInfo($result['count'],$sales->pageSize,$sales->page),
            'taxProportion'=>SalesOrderModel::TAX_PROPORTION
        ]);
    }
}