<?php
/**
 *
 * author: jinyanxin
 * Date: 2020/9/8
 * Time: 9:09
 * PHP version 7
 */

namespace backend\actions\finance\manage;


use backend\actions\BaseAction;
use backend\models\finance\PaymentsForm;

class SaveAction extends BaseAction
{

    /*
     * 新增财务收支记录
     * */
    public function run()
    {
        $postData = $this->request()->post();
        $payments = new PaymentsForm();
        $payments->attributes = $postData;
        $result = $payments->saveInfo();

        return $this->returnApi($result['code'],$result['msg']);
    }

}