<?php
/**
 *
 * author: jinyanxin
 * Date: 2020/12/14
 * Time: 14:57
 * PHP version 7
 */

namespace backend\actions\job;


use backend\actions\BaseAction;
use common\models\jobInfo\JobInfoForm;

class JobShiftBatchAction extends BaseAction
{

    public function run()
    {
        $model = new JobInfoForm();
        $model->jobId = $this->request()->post('jobId');
        $model->staffId = intval($this->request()->post('staffId'));
        $shift = $model->shiftBatch();
        return $this->returnApi($shift['code'],$shift['msg']);
    }

}