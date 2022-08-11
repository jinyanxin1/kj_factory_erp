<?php

namespace backend\actions\clientPerson;

/**
* Created by cqj
* User: cqj
* Date: 2020-07-10
* Time: 09:48
* 列表
*/
use common\models\clientPerson\ClientPersonForm;
use common\library\helper\Code;
use backend\actions\BaseAction;

class ListAction extends BaseAction
{
	public function run() {
		$model = new ClientPersonForm() ;
		$list = [] ;
		//TODO 具体情况接收条件参数
		$model->page = intval(\Yii::$app->request->post('page', 1)) ;
        $model->pageSize = intval(\Yii::$app->request->post('pageSize', 10)) ;
        $model->clientId = intval(\Yii::$app->request->post('clientId')) ;
        $model->name = \Yii::$app->request->post('name') ;
        $model->phone = $this->request()->post('phone');

        $where = [];
        if (!empty($model->clientId)) {
            $where[] = ['clientId' => $model->clientId];
        }
        if (!empty($model->name)) {
            $where[] = ['like','name',$model->name];
        }
        if(!empty($model->phone)){
            $where[] = ['phone'=>$model->phone];
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