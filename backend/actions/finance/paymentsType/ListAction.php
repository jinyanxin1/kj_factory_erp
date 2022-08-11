<?php
/**
 *
 * author: jinyanxin
 * Date: 2020/9/9
 * Time: 10:08
 * PHP version 7
 */

namespace backend\actions\finance\paymentsType;


use backend\actions\BaseAction;
use backend\models\finance\PaymentsTypeForm;
use common\library\helper\Code;

class ListAction extends BaseAction
{

    /*
     * 列表
     * */
    public function run()
    {
        $postData = $this->request()->post();

        $paymentsType = new PaymentsTypeForm();
        $paymentsType->attributes = $postData;
        $result = $paymentsType->getData();

        return $this->returnApi(Code::SUCCESS,'ok',[
            'list'=>$paymentsType->formatData($result['data']),
            'pageInfo'=>$this->getPageInfo($result['count'],$paymentsType->pageSize,$paymentsType->page)
        ]);
    }

}