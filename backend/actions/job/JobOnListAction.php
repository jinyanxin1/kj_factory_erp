<?php
/**
 * User: cqj
 * Date: 2020/7/7
 * Time: 3:57 下午
 */

namespace backend\actions\job;


use common\models\jobInfo\JobInfoForm;
use common\library\helper\Code;
use backend\actions\BaseAction;
use yii\helpers\Json;

class JobOnListAction extends BaseAction
{
    public function run() {
        $model = new JobInfoForm() ;
        $list = [] ;
        //TODO 具体情况接收条件参数
        $model->attributes = $this->request()->post() ;
        $model->page = intval(\Yii::$app->request->post('page', 1)) ;
        $model->pageSize = intval(\Yii::$app->request->post('pageSize', 10)) ;
        $model->loginUserId = $this->loginUserId ;
        $model->sex = intval(\Yii::$app->request->post('sex',-1)) ;
        $model->clientId = intval(\Yii::$app->request->post('clientId',0)) ;
        $model->startTime = \Yii::$app->request->post('startTime') ;
        $model->endTime = \Yii::$app->request->post('endTime') ;
        $model->skillId = \Yii::$app->request->post('skillId') ;
        $model->jobId = \Yii::$app->request->post('jobId') ;
        $model->name = \Yii::$app->request->post('name');
        $model->phone = \Yii::$app->request->post('phone');
        $model->staffId = \Yii::$app->request->post('staffId');
        $model->supplierId = intval($this->request()->post('supplierId'));
        $model->createStartTime = $this->request()->post('createStartTime');
        $model->createEndTime = $this->request()->post('createEndTime');
        $model->channelId = $this->request()->post('channelId');
        $model->idCard = $this->request()->post('idCard');
        $model->staffId = $this->staffId;
        \Yii::info('数据:'.Json::encode(\Yii::$app->request->post()));
        $ret = $model->getMyEntryJob() ;
        $data = isset($ret['list']) ? $ret['list'] : [] ;
        $count = isset($ret['count']) ? $ret['count'] : 0 ;
        if (!empty($data)) {
            $list = $model->formatPage() ;
        }
        $pageInfo = $this->getPageInfo($count, $model->pageSize, $model->page) ;
        return $this->returnApi(Code::SUCCESS, 'ok', [ 'list' => $list , 'pageInfo' => $pageInfo ]) ;
    }
}