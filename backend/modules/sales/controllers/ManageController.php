<?php
/**
 *
 * author: jinyanxin
 * Date: 2020/9/4
 * Time: 10:48
 * PHP version 7
 */

namespace backend\modules\sales\controllers;


use backend\controllers\BaseController;

class ManageController extends BaseController
{
    /*
     * 销售订单管理
     * */
    public function actions()
    {
        return [
            //销售订单保存
            'save' => ['class' => 'backend\actions\sales\manage\OrderSaveAction'],
            //销售订单列表
            'list' => ['class' => 'backend\actions\sales\manage\OrderListAction'],
            //销售单详情
            'info' => ['class' => 'backend\actions\sales\manage\OrderInfoAction'],
            //物料详情
            'goods-list' => ['class' => 'backend\actions\sales\manage\GoodsListAction'],
            //发货
            'send'=>['class'=>'backend\actions\sales\manage\SendAction'],
            //生产完成
            'pro-complete'=>['class'=>'backend\actions\sales\manage\ProCompleteAction'],
            //客户订单
            'client-order'=>['class'=>'backend\actions\sales\manage\ClientOrderAction'],
            //打印
            'print-data'=>['class'=>'backend\actions\sales\manage\PrintDataAction'],
            //保存发货单客户地址
            'save-client-address'=>['class'=>'backend\actions\sales\manage\SaveClientAddressAction'],
            //订单导出
            'order-export'=>['class'=>'backend\actions\sales\manage\OrderExportAction']
        ];
    }

}