<?php
/**
 * User: cqj
 * Date: 2020/8/5
 * Time: 3:00 下午
 */

namespace backend\actions\job;


use backend\actions\BaseAction;
use common\models\jobInfo\JobInfoForm;

class ShiftAction extends BaseAction
{
    public function run () {
        $model = new JobInfoForm() ;
        //TODO 具体情况接收参数
        $model->attributes = $this->request()->post() ;
        $model->jobId = $this->request()->post('jobId') ;
        $model->staffId = $this->request()->post('staffId') ;
        $ret = $model->shift() ;
        return $this->returnApi($ret['code'], $ret['msg']) ;
    }
}