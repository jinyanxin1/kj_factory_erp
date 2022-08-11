<?php
/**
 *
 * author: jinyanxin
 * Date: 2020/9/15
 * Time: 11:48
 * PHP version 7
 */

namespace backend\actions\finance\manage;


use backend\actions\BaseAction;
use backend\models\finance\PaymentsForm;
use common\library\helper\Code;

class GetConfigAction extends BaseAction
{

    /*
     * 获取配置
     * */
    public function run()
    {
        $payments = new PaymentsForm();
        $configData = $payments->getSaveConfig();
        return $this->returnApi(Code::SUCCESS,'ok',['configData'=>$configData]);
    }

}