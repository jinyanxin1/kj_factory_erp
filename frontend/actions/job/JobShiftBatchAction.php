<?php
/**
 *
 * author: jinyanxin
 * Date: 2020/12/14
 * Time: 15:22
 * PHP version 7
 */

namespace frontend\actions\job;

use common\library\helper\Code;
use common\models\jobInfo\JobInfoForm;
use frontend\actions\WxAction;

class JobShiftBatchAction extends WxAction
{

    public function run()
    {
        $model = new JobInfoForm();
        $model->jobId = $this->request()->post('jobId');
        $model->staffId = intval($this->request()->post('staffId'));
        $result = $model->shiftBatch();
        return $this->returnApi($result['code'],$result['msg']);
    }


}