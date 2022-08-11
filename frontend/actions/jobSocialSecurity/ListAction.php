<?php

namespace frontend\actions\jobSocialSecurity;

/**
* Created by cqj
* User: cqj
* Date: 2020-07-07
* Time: 14:23
* 列表
*/
use common\models\jobSocialSecurity\JobSocialSecurityForm;
use common\library\helper\Code;
use frontend\actions\WxAction;

class ListAction extends WxAction
{
	public function run() {
		$model = new JobSocialSecurityForm() ;
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