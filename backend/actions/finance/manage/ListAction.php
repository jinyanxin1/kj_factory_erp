<?php
/**
 *
 * author: jinyanxin
 * Date: 2020/9/8
 * Time: 9:19
 * PHP version 7
 */

namespace backend\actions\finance\manage;


use backend\actions\BaseAction;
use backend\models\finance\PaymentsForm;
use common\library\helper\Code;

class ListAction extends BaseAction
{

    /*
     * 记录列表
     * */
    public function run()
    {
        $postData = $this->request()->post();

        $payments = new PaymentsForm();
        $payments->attributes = $postData;
        $result = $payments->getData();

        return $this->returnApi(Code::SUCCESS,'ok',[
            'list'=>$payments->formatData($result['data']),
            'pageInfo'=>$this->getPageInfo($result['count'],$payments->pageSize,$payments->page)
        ]);
    }

}