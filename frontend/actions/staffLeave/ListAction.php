<?php

namespace frontend\actions\staffLeave;

/**
* Created by cqj
* User: cqj
* Date: 2020-07-07
* Time: 14:22
* 列表
*/
use common\models\staffLeave\StaffLeaveForm;
use common\library\helper\Code;
use frontend\actions\WxAction;

class ListAction extends WxAction
{
	public function run() {
		$model = new StaffLeaveForm() ;
		$list = [] ;
		//TODO 具体情况接收条件参数
		$model->attributes = $this->request()->post() ;
		$model->page = intval(\Yii::$app->request->post('page', 1)) ;
        $model->pageSize = intval(\Yii::$app->request->post('pageSize', 10)) ;
        $model->staffId = intval(\Yii::$app->request->post('staffId')) ;
        $where = [] ;
        $where[] = [
            'staffId' => $model->staffId
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