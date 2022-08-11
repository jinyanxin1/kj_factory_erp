<?php
/**
 * @Author: jinyanxin
 * @Date: 2020/2/6
 * @Time: 9:15
 * 进出库管理
 */


namespace backend\modules\purchase\controllers;


use backend\controllers\BaseController;

class StockManageController extends BaseController
{

    /*
     * 进出库管理
     * */

    public function actions()
    {
        return [
            //进出库管理
            'list'=>['class'=>'backend\actions\purchase\store\StoreManageAction'],
            //进出库详情
            'detail'=>['class'=>'backend\actions\purchase\store\StoreManageDetailAction'],
            //新增进出库
            'add'=>['class'=>'backend\actions\purchase\store\AddStoreManageAction'],
            //删除进出库记录
            'del'=>['class'=>'backend\actions\purchase\store\DelStoreManageAction'],
            //进出库查询
            'list-query' => ['class'=>'backend\actions\purchase\store\ListQueryAction'],
            //库存变动
            'stock-statistics' => ['class'=>'backend\actions\purchase\store\StockStatisticsAction']
        ];
    }

}