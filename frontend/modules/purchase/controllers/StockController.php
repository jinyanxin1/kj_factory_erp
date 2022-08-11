<?php
/**
 * @Author: jinyanxin
 * @Date: 2020/2/3
 * @Time: 15:06
 * 库存查询
 */


namespace frontend\modules\purchase\controllers;


use frontend\controllers\BaseController;

class StockController extends BaseController
{

    public function actions()
    {
        return [
            //库存列表
            'goods-list' => ['class'=>'frontend\actions\purchase\stock\GoodsListAction'],
            //导出
            'export-list'=> ['class'=>'frontend\actions\purchase\stock\ExportListAction'],
            //商品库存详情
            'stock-goods-detail' => ['class'=>'frontend\actions\purchase\stock\StockGoodsDetailAction'],
            //得到所有仓库和商品类别
            'get-config' => ['class'=>'frontend\actions\purchase\stock\GetConfigAction']


        ];
    }


}