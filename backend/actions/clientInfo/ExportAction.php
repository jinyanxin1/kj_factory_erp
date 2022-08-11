<?php
/**
 *
 * author: jinyanxin
 * Date: 2020/10/27
 * Time: 15:20
 * PHP version 7
 */

namespace backend\actions\clientInfo;


use backend\actions\BaseAction;
use common\models\clientInfo\ClientInfoForm;

class ExportAction extends BaseAction
{

    public function run()
    {
        $model = new ClientInfoForm() ;
        $list = [] ;
        //TODO 具体情况接收条件参数
        $model->attributes = $this->request()->get() ;
        $model->industryId = intval(\Yii::$app->request->get('industryId')) ;
        $model->provinceId = intval(\Yii::$app->request->get('provinceId')) ;
        $model->cityId = intval(\Yii::$app->request->get('cityId')) ;
        $model->areaId = intval(\Yii::$app->request->get('areaId')) ;
        $model->type = intval(\Yii::$app->request->get('type')) ;
        $model->range = $this->request()->get('range') ;
        $model->clientId = \Yii::$app->request->get('clientId');
        $model->staffId = \Yii::$app->request->get('staffId');
        $model->name = \Yii::$app->request->get('name');
        $startTime = \Yii::$app->request->get('startTime');
        $endTime = \Yii::$app->request->get('endTime');
        $model->isWork = \Yii::$app->request->get('isWork',-1);

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
        if (!empty($model->name) && ($model->name !== 'undefined')) {
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
        if (!empty($model->type) && ($model->type !== 'undefined')) {
            $where[] = ['type' => $model->type];
        }
        if (!empty($model->range)) {
            $where[] = ['range' => $model->range];
        }
        $ret = $model->getPage($where) ;
        $data = isset($ret['list']) ? $ret['list'] : [] ;
        if(!empty($data)){
            $list = $model->formatExport();
        }
        //导出
        $fileName =  iconv('utf-8', 'gbk', '客户');
        $this->exportData($list,$fileName,[
            '客户名称','客户类型','合作模式','人才数量','行业类型','电话','地区','详细地址','客户简介','联系人','联系人电话',
            '状态','负责人'
        ]);
        exit();
    }

}