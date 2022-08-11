<?php
/**
 *
 * author: jinyanxin
 * Date: 2020/9/9
 * Time: 9:58
 * PHP version 7
 */

namespace backend\actions\finance\paymentsType;


use backend\actions\BaseAction;
use backend\models\finance\PaymentsTypeForm;

class SaveAction extends BaseAction
{

    /*
     * 保存信息
     * */
    public function run()
    {
        $postData = $this->request()->post();

        $paymentsType = new PaymentsTypeForm();
        $paymentsType->attributes = $postData;
        $result = $paymentsType->saveInfo();

        return $this->returnApi($result['code'],$result['msg']);
    }

}