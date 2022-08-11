<?php

namespace frontend\actions\clientInterviewRecord;

/**
* Created by cqj
* User: cqj
* Date: 2020-07-10
* Time: 09:48
* 列表
*/
use common\models\clientInterviewRecord\ClientInterviewRecordForm;
use common\library\helper\Code;
use frontend\actions\WxAction;

class ListAction extends WxAction
{
	public function run() {
		$model = new ClientInterviewRecordForm() ;
		$list = [] ;
		//TODO 具体情况接收条件参数
		$model->attributes = $this->request()->post() ;
		$model->page = intval(\Yii::$app->request->post('page', 1)) ;
		$model->pageSize = intval(\Yii::$app->request->post('pageSize', 10)) ;
		$model->clientId = intval(\Yii::$app->request->post('clientId')) ;
		$where = [];
		if (!empty($model->clientId)) {
            $where[] = [
                'clientId' => $model->clientId
            ] ;
        }
		$ret = $model->getPage($where) ;
		$data = isset($ret['list']) ? $ret['list'] : [] ;
		$count = isset($ret['count']) ? $ret['count'] : 0 ;
		if (!empty($data)) {
			$list = $model->formatPage() ;
		}
		$pageInfo = $this->getPageInfo($count, $model->pageSize, $model->page) ;
		return $this->returnApi(Code::SUCCESS, 'ok', [ 'list' => $list , 'pageInfo' => $pageInfo ]) ;
	}
}