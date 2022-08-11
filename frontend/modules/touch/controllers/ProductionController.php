<?php
/**
 *
 * author: jinyanxin
 * Date: 2020/11/18
 * Time: 10:38
 * PHP version 7
 */

namespace frontend\modules\touch\controllers;


use frontend\controllers\BaseController;

class ProductionController extends BaseController
{

    /*
     * 生产管理
     * */

    public function actions()
    {
        return [
            //工人列表展示
            'staff-list'=>['class'=>'frontend\actions\touch\production\StaffListAction'],
            //关联产品
            'goods-list'=>['class'=>'frontend\actions\touch\production\GoodsListAction'],
            //产品工序列表
            'working-list' => ['class' => 'frontend\actions\touch\production\WorkingListAction'],
            //入库
            'in-storage'=>['class'=>'frontend\actions\touch\production\InStorageAction']
        ];
    }

}