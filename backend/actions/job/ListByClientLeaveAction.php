<?php
/**
 * Created by cqj
 * User: cqj
 * Date: 2021/11/11
 * Time: 上午10:17
 * Function:
 */

namespace backend\actions\job;


use backend\actions\BaseAction;
use common\library\helper\Code;
use common\models\jobCareerRecord\JobCareerRecordForm;
use common\models\jobInfo\JobInfoForm;
use yii\helpers\Json;

class ListByClientLeaveAction extends BaseAction
{
    public function run() {
        $model = new JobCareerRecordForm() ;
        $list = [] ;
        //TODO 具体情况接收条件参数
        $model->attributes = $this->request()->post() ;
        $model->page = intval(\Yii::$app->request->post('page', 1)) ;
        $model->pageSize = intval(\Yii::$app->request->post('pageSize', 10)) ;
        $model->loginUserId = $this->loginUserId ;
        $model->clientId = intval(\Yii::$app->request->post('clientId',0)) ;
        $model->skillId = \Yii::$app->request->post('skillId') ;
        $model->phone = \Yii::$app->request->post('phone');
        $model->name = \Yii::$app->request->post('name');
        $model->idCard = $this->request()->post('idCard');

        \Yii::info('数据:'.Json::encode(\Yii::$app->request->post()));
        $ret = $model->getLeaveByClient() ;
        $data = isset($ret['list']) ? $ret['list'] : [] ;
        $count = isset($ret['count']) ? $ret['count'] : 0 ;
        if (!empty($data)) {
            $model2 = new JobInfoForm() ;
            $model2->list = $data;
            $list = $model2->formatPage() ;
        }
        $pageInfo = $this->getPageInfo($count, $model->pageSize, $model->page) ;
        return $this->returnApi(Code::SUCCESS, 'ok', [ 'list' => $list , 'pageInfo' => $pageInfo ]) ;
    }
}