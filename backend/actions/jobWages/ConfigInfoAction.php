<?php
/**
 *
 * author: jinyanxin
 * Date: 2020/10/21
 * Time: 11:29
 * PHP version 7
 */

namespace backend\actions\jobWages;


use backend\actions\BaseAction;
use common\library\helper\Code;
use common\models\jobWages\JobWagesConfigForm;

class ConfigInfoAction extends BaseAction
{

    public function run()
    {
        $jobId = intval($this->request()->post('jobId'));
        $clientId = intval($this->request()->post('clientId'));

        $config = new JobWagesConfigForm();
        $config->jobId = $jobId;
        $config->clientId = $clientId;
        $info = $config->getInfo();

        return $this->returnApi(Code::SUCCESS,'ok',[
            'info'=>$info
        ]);
    }

}