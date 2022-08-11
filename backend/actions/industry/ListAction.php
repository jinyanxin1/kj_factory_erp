<?php

namespace backend\actions\industry;

/**
* Created by cqj
* User: cqj
* Date: 2020-07-17
* Time: 10:31
* 列表
*/
use common\models\industry\IndustryForm;
use common\library\helper\Code;
use backend\actions\BaseAction;

class ListAction extends BaseAction
{
	public function run() {
		$model = new IndustryForm() ;
		$list = [] ;
		//TODO 具体情况接收条件参数
		$model->attributes = $this->request()->post() ;
		$model->page = intval(\Yii::$app->request->post('page', 1)) ;
		$model->pageSize = intval(\Yii::$app->request->post('pageSize', 10)) ;
		$ret = $model->getPage() ;
		$data = isset($ret['list']) ? $ret['list'] : [] ;
		$count = isset($ret['count']) ? $ret['count'] : 0 ;
		if (!empty($data)) {
			$list = $model->formatPage() ;
		}
		$pageInfo = $this->getPageInfo($count, $model->pageSize, $model->page) ;
		return $this->returnApi(Code::SUCCESS, 'ok', [ 'list' => $list , 'pageInfo' => $pageInfo ]) ;
	}
}