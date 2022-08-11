<?php
/**
 *
 * author: jinyanxin
 * Date: 2020/9/3
 * Time: 14:50
 * PHP version 7
 */

namespace backend\modules\purchase\controllers;


use backend\controllers\BaseController;

class ManageController extends BaseController
{
    /*
     * 采购管理
     * */
    public function actions()
    {
        return [
            //采购单信息保存
            'save' => ['class' => 'backend\actions\purchase\manage\OrderSaveAction'],
            //采购单列表
            'list' => ['class' => 'backend\actions\purchase\manage\OrderListAction'],
            //采购详情
            'info' => ['class' => 'backend\actions\purchase\manage\OrderInfoAction'],
            //物料详情
            'goods-list' => ['class' => 'backend\actions\purchase\manage\GoodsListAction'],
            //todo 打印采购单

        ];
    }

}