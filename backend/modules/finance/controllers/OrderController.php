<?php
/**
 *
 * author: jinyanxin
 * Date: 2020/12/9
 * Time: 14:50
 * PHP version 7
 */

namespace backend\modules\finance\controllers;


use backend\controllers\BaseController;

class OrderController extends BaseController
{

    public function actions()
    {
        return [
            //列表
            'list'=>['class'=>'backend\actions\finance\order\ListAction']
        ];
    }

}