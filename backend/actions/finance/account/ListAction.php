<?php
/**
 *
 * author: jinyanxin
 * Date: 2020/9/15
 * Time: 10:53
 * PHP version 7
 */

namespace backend\actions\finance\account;


use backend\actions\BaseAction;
use backend\models\finance\PaymentsAccountForm;
use common\library\helper\Code;

class ListAction extends BaseAction
{
    /*
     * 账户列表
     * */
    public function run()
    {
        $postData = $this->request()->post();

        $account = new PaymentsAccountForm();
        $account->attributes = $postData;
        $result = $account->getData();

        return $this->returnApi(Code::SUCCESS,'ok',[
            'list'=>$account->formatData($result['data']),
            'pageInfo'=>$this->getPageInfo($result['count'],$account->pageSize,$account->page)
        ]);
    }

}