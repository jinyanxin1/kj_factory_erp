<?php
/**
 * User: cqj
 * Date: 2020/7/7
 * Time: 3:57 下午
 */

namespace backend\actions\job;


use backend\actions\BaseAction;
use common\library\helper\Code;
use common\models\jobInfo\JobInfoForm;

class PublicAction extends BaseAction
{
    public function run() {
        $model = new JobInfoForm() ;
        $list = [] ;
        //TODO 具体情况接收条件参数
        $model->attributes = $this->request()->post() ;
        $model->page = intval(\Yii::$app->request->post('page', 1)) ;
        $model->pageSize = intval(\Yii::$app->request->post('pageSize', 10)) ;
        $model->sex = intval(\Yii::$app->request->post('sex',-1)) ;
        $model->skillId = \Yii::$app->request->post('skillId'); ;
        $model->name = trim(\Yii::$app->request->post('name'));
        $model->phone = trim(\Yii::$app->request->post('phone'));
        $model->channelId = $this->request()->post('channelId');
        $model->idCard = $this->request()->post('idCard');
        $model->oldStaffId = intval($this->request()->post('staffId'));
        $model->startTime = $this->request()->post('startTime');//最后一次入职时间搜索
        $model->endTime = $this->request()->post('endTime');

        $ret = $model->getPublic() ;
        $data = isset($ret['list']) ? $ret['list'] : [] ;
        $count = isset($ret['count']) ? $ret['count'] : 0 ;
        if (!empty($data)) {
            $list = $model->formatPublicPage() ;
        }
        $pageInfo = $this->getPageInfo($count, $model->pageSize, $model->page) ;
        return $this->returnApi(Code::SUCCESS, 'ok', [ 'list' => $list , 'pageInfo' => $pageInfo ]) ;
    }
}