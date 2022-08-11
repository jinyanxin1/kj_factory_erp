<?php
/**
 * User: cqj
 * Date: 2020/7/7
 * Time: 4:15 下午
 * 离职
 */

namespace frontend\actions\job;


use frontend\actions\WxAction;
use common\models\jobCareerRecord\JobCareerRecordForm;

class LeaveAction extends WxAction
{
    public function run() {
        $model = new JobCareerRecordForm() ;
        //TODO 具体情况接收参数
        $model->jobId = $this->request()->post('jobId') ;
        $model->time = $this->request()->post('time') ;
        $model->leaveReason = $this->request()->post('leaveReason') ;
        $model->leavePic = $this->request()->post('leavePic') ;
        $model->leaveType = $this->request()->post('leaveType') ;
        $model->attributes = $this->request()->post() ;
        $ret = $model->leave() ;
        return $this->returnApi($ret['code'], $ret['msg']) ;
    }
}