<?php
/**
 * User: cqj
 * Date: 2020/7/27
 * Time: 11:27 上午
 */

namespace frontend\actions\supplierInfo;


use frontend\actions\WxAction;
use common\library\helper\Code;
use common\models\jobInfo\JobInfoForm;
use common\models\jobInfo\JobInfoModel;

class JobListAction extends WxAction
{
    public function run() {
        $model = new JobInfoForm() ;
        $list = [] ;
        //TODO 具体情况接收条件参数
        $model->attributes = $this->request()->post() ;
        $model->page = intval(\Yii::$app->request->post('page', 1)) ;
        $model->pageSize = intval(\Yii::$app->request->post('pageSize', 10)) ;
        $model->supplierId = intval(\Yii::$app->request->post('supplierId',0)) ;
        $model->sex = intval(\Yii::$app->request->post('sex',-1)) ;

        $select = ['*'] ;
        $where = [] ;
        $where[] = ['supplierId' => $model->supplierId] ;
        if ($model->sex != -1) {
            $where[] = ['sex' => $model->sex] ;
        }
        $ret = $model->getPage($select,$where) ;
        $data = isset($ret['list']) ? $ret['list'] : [] ;
        $count = isset($ret['count']) ? $ret['count'] : 0 ;
        if (!empty($data)) {
            $list = $model->formatClientJobPage() ;
        }
        $supplierCount = JobInfoModel::find()
            ->Where([ 'isValid' => JobInfoModel::IS_VALID_OK ])
            ->andWhere(['supplierId' => $model->supplierId])
            ->count();

        $pageInfo = $this->getPageInfo($count, $model->pageSize, $model->page) ;
        return $this->returnApi(Code::SUCCESS, 'ok', [ 'list' => $list ,'count' => $supplierCount, 'pageInfo' => $pageInfo ]) ;
    }
}