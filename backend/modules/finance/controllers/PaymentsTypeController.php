<?php
/**
 *
 * author: jinyanxin
 * Date: 2020/9/9
 * Time: 9:54
 * PHP version 7
 */

namespace backend\modules\finance\controllers;


use backend\controllers\BaseController;

class PaymentsTypeController extends BaseController
{
    /*
     *  收支类型管理
     * */
    public function actions()
    {
        return [
            //保存信息
            'save' => ['class' => 'backend\actions\finance\paymentsType\SaveAction'],
            //列表
            'list' => ['class' => 'backend\actions\finance\paymentsType\ListAction'],
            //详情
            'info' => ['class' => 'backend\actions\finance\paymentsType\InfoAction']
        ];
    }

}