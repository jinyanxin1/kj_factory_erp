<?php

namespace backend\actions\staffInfo;

/**
* Created by cqj
* User: cqj
* Date: 2020-07-07
* Time: 14:22
* 列表
*/
use common\models\staffInfo\StaffInfoForm;
use common\library\helper\Code;
use backend\actions\BaseAction;

class ListAction extends BaseAction
{
	public function run() {
		$model = new StaffInfoForm() ;
		$list = [] ;
		//TODO 具体情况接收条件参数
		$model->attributes = $this->request()->post() ;
		$model->page = intval(\Yii::$app->request->post('page', 1)) ;
        $model->pageSize = intval(\Yii::$app->request->post('pageSize', 10)) ;
        $model->status = intval(\Yii::$app->request->post('status',-1)) ;
        $model->sex = intval(\Yii::$app->request->post('sex',-1)) ;
        $model->sectionId = intval(\Yii::$app->request->post('sectionId')) ;
        $model->positionId = intval(\Yii::$app->request->post('positionId')) ;
        $model->staffId = \Yii::$app->request->post('staffId') ;
        $model->name = \Yii::$app->request->post('name') ;
        $model->phone = $this->request()->post('phone');
        $where = [];

        if ($model->status != -1) {
            $where[] = ['status' => $model->status];
        }

        if ($model->sex != -1) {
            $where[] = ['sex' => $model->sex];
        }

        if (!empty($model->staffId)) {
            $where[] = ['staffId' => $model->staffId];
        }

        if (!empty($model->sectionId)) {
            $where[] = ['sectionId' => $model->sectionId];
        }
        if (!empty($model->positionId)) {
            $where[] = ['positionId' => $model->positionId];
        }
        if (!empty($model->name)) {
            $where[] = ['like' ,'name',$model->name];
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