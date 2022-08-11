<?php

namespace frontend\actions\jobContract;

/**
* Created by cqj
* User: cqj
* Date: 2020-09-10
* Time: 15:52
* 列表
*/
use common\models\jobContract\JobContractForm;
use common\library\helper\Code;
use backend\actions\BaseAction;
use frontend\actions\WxAction;

class ListAction extends WxAction
{
	public function run() {
		$model = new JobContractForm() ;
		$list = [] ;
		//TODO 具体情况接收条件参数
		$model->attributes = $this->request()->post() ;
		$model->page = intval(\Yii::$app->request->post('page', 1)) ;
		$model->pageSize = intval(\Yii::$app->request->post('pageSize', 10)) ;
        $model->jobId = intval(\Yii::$app->request->post('jobId')) ;
        $where = [] ;
        $where[] = [
            'jobId' => $model->jobId
        ];
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