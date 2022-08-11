<?php
/**
 *
 * author: jinyanxin
 * Date: 2020/10/26
 * Time: 13:57
 * PHP version 7
 */

namespace frontend\actions\attendance\manage;


use common\library\helper\Code;
use common\models\attendance\JobAttendanceLogForm;
use common\models\jobInfo\JobInfoModel;
use frontend\actions\WxAction;

class SaveAction extends WxAction
{

    public function run()
    {
        $jobId = $this->jobId;
        $jobInfo = JobInfoModel::getById($jobId,['*'],true);
        if(empty($jobInfo)){
            return ['code'=>Code::PARAM_ERR,'msg'=>'人才不存在'];
        }
        $attLat = $this->request()->post('attLat');//维度
        $attLon = $this->request()->post('attLon');//经度
        $clientId = intval($jobInfo['clientId']);
        $attendance = new JobAttendanceLogForm();
        $attendance->attributes = $this->request()->post();
        $attendance->jobId = $jobId;
        $attendance->clientId = $clientId;
        $attendance->attLat = $attLat;
        $attendance->attLon = $attLon;
        $result = $attendance->saveInfo();

        return $this->returnApi($result['code'],$result['msg']);

    }

}