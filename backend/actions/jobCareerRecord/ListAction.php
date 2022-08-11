<?php

namespace backend\actions\jobCareerRecord;

/**
* Created by cqj
* User: cqj
* Date: 2020-07-07
* Time: 14:23
* 列表
*/
use common\models\jobCareerRecord\JobCareerRecordForm;
use common\library\helper\Code;
use backend\actions\BaseAction;

class ListAction extends BaseAction
{
	public function run() {
		$model = new JobCareerRecordForm() ;
		$list = [] ;
		//TODO 具体情况接收条件参数
		$model->attributes = $this->request()->post() ;
		$model->page = intval(\Yii::$app->request->post('page', 1)) ;
        $model->pageSize = intval(\Yii::$app->request->post('pageSize', 10)) ;
        $model->clientId = intval(\Yii::$app->request->post('clientId')) ;
        $model->status = intval(\Yii::$app->request->post('status')) ;
        $where = [] ;
        $where[] = ['clientId' => $model->clientId] ;
        $where[] = ['status' => $model->status] ;
		$ret = $model->getPage($where) ;
		$data = isset($ret['list']) ? $ret['list'] : [] ;
		$count = isset($ret['count']) ? $ret['count'] : 0 ;
		if (!empty($data)) {
			$list = $model->formatJobPage() ;
		}
		$pageInfo = $this->getPageInfo($count, $model->pageSize, $model->page) ;
		return $this->returnApi(Code::SUCCESS, 'ok', [ 'list' => $list , 'pageInfo' => $pageInfo ]) ;
	}
}