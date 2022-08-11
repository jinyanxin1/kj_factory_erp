<?php
/**
 *
 * author: jinyanxin
 * Date: 2020/9/7
 * Time: 8:59
 * PHP version 7
 */

namespace backend\modules\goods\controllers;


use backend\controllers\BaseController;

class ManageController extends BaseController
{

    /*
     * 物料管理
     * */
    public function actions()
    {
        return [
            //物品信息保存
            'save' => ['class' => 'backend\actions\goods\manage\SaveAction'],
            //物品列表
            'list' => ['class' => 'backend\actions\goods\manage\ListAction'],
            //库存状况
            'stock-info' => ['class' => 'backend\actions\goods\manage\StockInfoAction'],
            //物品详情
            'info' => ['class' => 'backend\actions\goods\manage\InfoAction'],
            //删除
            'del'=>['class'=>'backend\actions\goods\manage\DelAction'],
            //岗位关联产品
            'station-goods'=>['class'=>'backend\actions\goods\manage\StationGoodsAction'],
            //岗位关联产品详情
            'station-goods-info'=>['class'=>'backend\actions\goods\manage\StationGoodsInfoAction'],
            //得到产品基本信息表
            'get-goods-info' => ['class'=>'backend\actions\goods\manage\GetGoodsInfoAction'],
            //得到产品基本信息列表
            'get-goods-list' => ['class' => 'backend\actions\goods\manage\GetGoodsListAction']
        ];
    }

}