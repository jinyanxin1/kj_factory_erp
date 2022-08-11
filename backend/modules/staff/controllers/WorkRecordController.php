<?php
/**
 *
 * author: jinyanxin
 * Date: 2021/7/27
 * Time: 16:00
 * PHP version 7
 */

namespace backend\modules\staff\controllers;


use backend\controllers\BaseController;

class WorkRecordController extends BaseController
{

    /*
     * 工单统计
     * */

    public function actions()
    {
        return [
            //职工关联产品列表
            'goods-list' => [
                'class' => 'backend\actions\workRecord\GoodsListAction',
            ],
            //保存工单记录
            'save' => [
                'class' => 'backend\actions\workRecord\SaveAction'
            ],
            //工单统计列表
            'list' => [
                'class' => 'backend\actions\workRecord\ListAction'
            ],
            //详情
            'detail' => [
                'class' => 'backend\actions\workRecord\DetailAction'
            ],
            //删除
            'del' => [
                'class' => 'backend\actions\workRecord\DelAction'
            ],
            //导出
            'export' => [
                'class' => 'backend\actions\workRecord\ExportAction'
            ],
        ];
    }



}