<?php
/**
 * User: cqj
 * Date: 2020/7/7
 * Time: 5:21 下午
 */

namespace frontend\actions\jobInterviewRecord;


use frontend\actions\WxAction;
use common\library\helper\Code;
use common\models\jobInterviewRecord\JobInterviewRecordForm;

class ResultAction extends WxAction
{
    public function run() {
        $model = new JobInterviewRecordForm() ;
        $model->attributes = $this->request()->post() ;
        $model->interviewId = \Yii::$app->request->post('interviewId');
        $model->status = intval(\Yii::$app->request->post('status')) ;
        $model->time = \Yii::$app->request->post('time') ;
        $ret = $model->result() ;
        return $this->returnApi($ret['code'], $ret['msg']) ;
    }
}