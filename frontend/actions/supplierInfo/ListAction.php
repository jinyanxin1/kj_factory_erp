<?php

namespace frontend\actions\supplierInfo;

/**
* Created by cqj
* User: cqj
* Date: 2020-07-16
* Time: 10:22
* 列表
*/
use common\models\supplierInfo\SupplierInfoForm;
use common\library\helper\Code;
use frontend\actions\WxAction;

class ListAction extends WxAction
{
	public function run() {
		$model = new SupplierInfoForm() ;
		$list = [] ;
		//TODO 具体情况接收条件参数
		$model->attributes = $this->request()->post() ;
		$model->page = intval(\Yii::$app->request->post('page', 1)) ;
        $model->pageSize = intval(\Yii::$app->request->post('pageSize', 10)) ;
        $model->supplierId = \Yii::$app->request->post('supplierId') ;
        $model->staffId = \Yii::$app->request->post('staffId') ;
        $model->industryId = intval(\Yii::$app->request->post('industryId')) ;
        $model->provinceId = intval(\Yii::$app->request->post('provinceId')) ;
        $model->cityId = intval(\Yii::$app->request->post('cityId')) ;
        $model->areaId = intval(\Yii::$app->request->post('areaId')) ;
        $model->type = intval(\Yii::$app->request->post('type')) ;
        $model->name = trim(\Yii::$app->request->post('name'));

        $where = [];
        if (!empty($model->name)) {
            $where[] = ['like','name' , $model->name];
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
        if (!empty($model->supplierId)) {
            $where[] = ['supplierId' => $model->supplierId];
        }
        if (!empty($model->staffId)) {
            $where[] = ['staffId' => $model->staffId];
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