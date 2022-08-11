<?php

namespace backend\actions\clientInfo;

/**
* Created by cqj
* User: cqj
* Date: 2020-07-10
* Time: 09:48
* 列表
*/
use common\models\clientInfo\ClientInfoForm;
use common\library\helper\Code;
use backend\actions\BaseAction;

class ListAction extends BaseAction
{
	public function run() {
		$model = new ClientInfoForm() ;
		$list = [] ;
		//TODO 具体情况接收条件参数
		$model->attributes = $this->request()->post() ;
		$model->page = intval(\Yii::$app->request->post('page', 1)) ;
        $model->pageSize = intval(\Yii::$app->request->post('pageSize', 10)) ;
        $model->industryId = intval(\Yii::$app->request->post('industryId')) ;
        $model->provinceId = intval(\Yii::$app->request->post('provinceId')) ;
        $model->cityId = intval(\Yii::$app->request->post('cityId')) ;
        $model->areaId = intval(\Yii::$app->request->post('areaId')) ;
        $model->type = intval(\Yii::$app->request->post('type')) ;
        $model->range = $this->request()->post('range') ;
        $model->clientId = \Yii::$app->request->post('clientId');
        $model->staffId = \Yii::$app->request->post('staffId');
        $model->name = \Yii::$app->request->post('name');
        $startTime = \Yii::$app->request->post('startTime');
        $endTime = \Yii::$app->request->post('endTime');
        $model->isWork = \Yii::$app->request->post('isWork',-1);
        $model->tell = $this->request()->post('tell');

        $where = [] ;
        if (!empty($startTime)) {
            $where[] = ['>=','createTime',$startTime.' 00:00:00'];
        }
        if (!empty($endTime)) {
            $where[] = ['<=','createTime',$endTime.' 23:59:59'];
        }

        if ($model->isWork != -1) {
            $where[] = ['isWork' => $model->isWork];
        }
        if (!empty($model->name)) {
            $where[] = ['like','name' , $model->name];
        }
        if (!empty($model->staffId)) {
            $where[] = ['staffId' => $model->staffId];
        }
        if (!empty($model->clientId)) {
            $where[] = ['clientId' => $model->clientId];
        }
        if (!empty($model->industryId)) {
            $where[] = ['industryId' => $model->industryId];
        }
        if (!empty($model->provinceId)) {
            $where[] = ['provinceId' => $model->provinceId];
        }
        if (!empty($model->cityId)) {
            $where[] = ['cityId' => $model->cityId];
        }
        if (!empty($model->areaId)) {
            $where[] = ['areaId' => $model->areaId];
        }
        if (!empty($model->type)) {
            $where[] = ['type' => $model->type];
        }
        if (!empty($model->range)) {
            $where[] = ['range' => $model->range];
        }
        if(!empty($model->tell)){
            $where[] = ['tell'=>$model->tell];
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