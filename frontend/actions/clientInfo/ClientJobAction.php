<?php
/**
 * User: cqj
 * Date: 2020/7/10
 * Time: 10:27 上午
 */

namespace frontend\actions\clientInfo;


use frontend\actions\WxAction;
use common\library\helper\Code;
use common\models\jobInfo\JobInfoForm;
use common\models\jobInfo\JobInfoModel;

class ClientJobAction extends WxAction
{
    public function run() {
        $model = new JobInfoForm() ;
        $list = [] ;
        //TODO 具体情况接收条件参数
        $model->attributes = $this->request()->post() ;
        $model->page = intval(\Yii::$app->request->post('page', 1)) ;
        $model->pageSize = intval(\Yii::$app->request->post('pageSize', 10)) ;
        $model->clientId = intval(\Yii::$app->request->post('clientId',0)) ;
        $model->sex = intval(\Yii::$app->request->post('sex',-1)) ;

        $select = ['*'] ;
        $where = [] ;
        $where[] = ['clientId' => $model->clientId] ;
        $where[] = ['status' => JobInfoModel::STATUS_ENTRY] ;
        if ($model->sex != -1) {
            $where[] = ['sex' => $model->sex] ;
        }
        $ret = $model->getPage($select,$where) ;
        $data = isset($ret['list']) ? $ret['list'] : [] ;
        $count = isset($ret['count']) ? $ret['count'] : 0 ;
        if (!empty($data)) {
            $list = $model->formatClientJobPage() ;
        }
        $jobCount = JobInfoModel::find()
            ->Where([ 'isValid' => JobInfoModel::IS_VALID_OK ])
            ->andWhere(['status' => JobInfoModel::STATUS_ENTRY])
            ->andWhere(['clientId' => $model->clientId])
            ->count();

        $pageInfo = $this->getPageInfo($count, $model->pageSize, $model->page) ;
        return $this->returnApi(Code::SUCCESS, 'ok', [ 'list' => $list ,'count' => $jobCount, 'pageInfo' => $pageInfo ]) ;
    }
}