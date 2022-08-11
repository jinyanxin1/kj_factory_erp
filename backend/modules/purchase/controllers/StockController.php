<?php
/**
 *
 * author: jinyanxin
 * Date: 2020/11/16
 * Time: 11:51
 * PHP version 7
 */

namespace backend\modules\purchase\controllers;


use backend\controllers\BaseController;

class StockController extends BaseController
{
    /*
     * 库存管理
     * */

    public function actions()
    {
        return [
            //得到所有仓库和商品类别
            'get-config' => ['class'=>'backend\actions\purchase\stock\GetConfigAction'],
            //库存查询列表
            'goods-list'=>['class'=>'backend\actions\purchase\stock\GoodsListAction'],
            //商品库存详情
            'stock-goods-detail' => ['class'=>'backend\actions\purchase\stock\StockGoodsDetailAction'],
        ];
    }


}