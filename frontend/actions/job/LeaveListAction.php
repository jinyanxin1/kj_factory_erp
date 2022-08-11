<?php
/**
 * User: cqj
 * Date: 2020/7/7
 * Time: 4:49 下午
 */

namespace frontend\actions\job;


use frontend\actions\WxAction;
use common\library\helper\Code;
use common\models\jobCareerRecord\JobCareerRecordForm;

class LeaveListAction extends WxAction
{
    public function run() {
        $model = new JobCareerRecordForm() ;
        $list = [] ;
        //TODO 具体情况接收条件参数
        $model->attributes = $this->request()->post() ;
        $model->page = intval(\Yii::$app->request->post('page', 1)) ;
        $model->pageSize = intval(\Yii::$app->request->post('pageSize', 10)) ;
        $model->jobId = intval(\Yii::$app->request->post('jobId')) ;
        $ret = $model->getLeaveList() ;
        $data = isset($ret['list']) ? $ret['list'] : [] ;
        $count = isset($ret['count']) ? $ret['count'] : 0 ;
        if (!empty($data)) {
            $list = $model->formatLeavePage() ;
        }
        $pageInfo = $this->getPageInfo($count, $model->pageSize, $model->page) ;
        return $this->returnApi(Code::SUCCESS, 'ok', [ 'list' => $list , 'pageInfo' => $pageInfo ]) ;
    }
}