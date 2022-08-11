<?php
/**
 *
 * author: jinyanxin
 * Date: 2020/12/9
 * Time: 11:02
 * PHP version 7
 */

namespace backend\actions\sales\manage;


use backend\actions\BaseAction;
use common\library\helper\Code;
use common\models\salesOrder\SalesOrderForm;

class OrderExportAction extends BaseAction
{

    public function run()
    {
        $postData = $this->request()->post();

        $salesOrder = new SalesOrderForm();
        $salesOrder->attributes = $postData;
        $result = $salesOrder->getData();
        $data = $result['data'];

        $export = $salesOrder->formatExport($data);

        $fileName = iconv('utf-8','gbk','订单');
        $this->exportData($export,$fileName,['订单号','客户名','产品/数量','金额','日期']);
        exit();
    }

}