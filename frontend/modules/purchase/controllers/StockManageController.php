<?php
/**
 * @Author: jinyanxin
 * @Date: 2020/2/6
 * @Time: 9:15
 * 进出库管理
 */


namespace frontend\modules\purchase\controllers;


use frontend\controllers\BaseController;

class StockManageController extends BaseController
{

    public function actions()
    {
        return [
            //进出库管理
            'list'=>['class'=>'frontend\actions\purchase\store\StoreManageAction'],
            //进出库详情
            'detail'=>['class'=>'frontend\actions\purchase\store\StoreManageDetailAction'],
            //新增进出库
            'add'=>['class'=>'frontend\actions\purchase\store\AddStoreManageAction'],
            //删除进出库记录
            'del'=>['class'=>'frontend\actions\purchase\store\DelStoreManageAction'],
            //进出库查询
            'list-query' => ['class'=>'frontend\actions\purchase\store\ListQueryAction'],
            //库存变动
            'stock-statistics' => ['class'=>'frontend\actions\purchase\store\StockStatisticsAction']
        ];
    }

}