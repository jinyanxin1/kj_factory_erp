<?php
/**
 *
 * author: jinyanxin
 * Date: 2020/11/26
 * Time: 14:35
 * PHP version 7
 */

namespace frontend\modules\sales\controllers;


use frontend\controllers\BaseController;

class ManageController extends BaseController
{
    /*
     * 订单管理
     * */
    public function actions()
    {
        return [
            //新增订单
            'save'=>['class'=>'frontend\actions\sales\manage\SaveAction'],
            //列表
            'list'=>['class'=>'frontend\actions\sales\manage\ListAction'],
            //详情
            'info'=>['class'=>'frontend\actions\sales\manage\InfoAction']
        ];
    }

}