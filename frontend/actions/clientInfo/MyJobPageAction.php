<?php

namespace frontend\actions\clientInfo;

/**
* Created by cqj
* User: cqj
* Date: 2020-07-07
* Time: 14:23
* 列表
*/

use common\models\jobInterviewRecord\JobInterviewRecordForm;
use common\library\helper\Code;
use common\models\jobInterviewRecord\JobInterviewRecordModel;
use frontend\actions\WxAction;

class MyJobPageAction extends WxAction
{
	public function run() {
		$model = new JobInterviewRecordForm() ;
		$list = [] ;
		//TODO 具体情况接收条件参数
		$model->attributes = $this->request()->post() ;
		$model->page = intval(\Yii::$app->request->post('page', 1)) ;
        $model->pageSize = intval(\Yii::$app->request->post('pageSize', 10)) ;
        $model->clientId = intval(\Yii::$app->request->post('clientId')) ;
        $model->status	 = intval(\Yii::$app->request->post('status',0)) ;
        $startTime	 = (\Yii::$app->request->post('startTime')) ;
        $endTime	 = (\Yii::$app->request->post('endTime')) ;
        $where = [];

        if (!empty($startTime)) {
            $where[] = ['>=','time',$startTime.' 00:00:00'];
        }

        if (!empty($endTime)) {
            $where[] = ['<=','time',$endTime.' 23:59:59'];
        }

        if (!in_array($model->status,[-1,0])) {
            $where[] = [
                'status' => $model->status
            ];
        }

        if (!empty($model->clientId)) {
            $where[] = [
                'clientId' => $model->clientId
            ];
        }
        $where[] = ['isOver'=>JobInterviewRecordModel::OVER_NO];
		$ret = $model->getJobPage($where) ;
		$data = isset($ret['list']) ? $ret['list'] : [] ;
		$count = isset($ret['count']) ? $ret['count'] : 0 ;
		if (!empty($data)) {
			$list = $model->formatPage() ;
		}
		$pageInfo = $this->getPageInfo($count, $model->pageSize, $model->page) ;
		return $this->returnApi(Code::SUCCESS, 'ok', [ 'list' => $list , 'pageInfo' => $pageInfo ]) ;
	}
}