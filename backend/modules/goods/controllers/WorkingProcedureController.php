<?php
/**
 *
 * author: jinyanxin
 * Date: 2021/7/27
 * Time: 11:39
 * PHP version 7
 */

namespace backend\modules\goods\controllers;


use backend\controllers\BaseController;

class WorkingProcedureController extends BaseController
{

    /*
     * 工序管理
     * */

    public function actions()
    {
        return [
            //保存工序信息
            'save' => [
                'class' => 'backend\actions\goods\working\SaveAction'
            ],
            //工序列表
            'list' => [
                'class' => 'backend\actions\goods\working\ListAction'
            ],
            //工序详情
            'detail' => [
                'class' => 'backend\actions\goods\working\DetailAction'
            ],
            //删除工序
            'del' => [
                'class' => 'backend\actions\goods\working\DelAction'
            ],
            //删除工序中某个半产品消耗关联
            'del-consume' => [
                'class' => 'backend\actions\goods\working\DelConsumeAction'
            ],
            //关联物料，产品列表
            'relation-list' => [
                'class' => 'backend\actions\goods\working\RelationListAction'
            ],
            //同一产品下的工序
            'all-list' => [
                'class' => 'backend\actions\goods\working\AllListAction'
            ]
        ];
    }

}