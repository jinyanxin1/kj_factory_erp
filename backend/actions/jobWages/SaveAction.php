<?php
/**
 *
 * author: jinyanxin
 * Date: 2020/10/21
 * Time: 11:30
 * PHP version 7
 */

namespace backend\actions\jobWages;


use backend\actions\BaseAction;
use common\models\jobWages\JobWagesConfigForm;

class SaveAction extends BaseAction
{

    public function run()
    {
        $postData = $this->request()->post();

        $config = new JobWagesConfigForm();
        $config->attributes = $postData;
        $result = $config->saveInfo();

        return $this->returnApi($result['code'],$result['msg']);
    }

}