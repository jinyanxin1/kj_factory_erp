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

class SaveAction extends BaseAction
{
    /*
     * 账户信息保存
     * */
    public function run()
    {
        $postData = $this->request()->post();

        $account = new PaymentsAccountForm();
        $account->attributes = $postData;
        $result = $account->saveInfo();

        return $this->returnApi($result['code'],$result['msg']);
    }

}