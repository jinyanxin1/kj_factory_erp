<?php
/**
 *
 * author: jinyanxin
 * Date: 2020/9/15
 * Time: 10:50
 * PHP version 7
 */

namespace backend\modules\finance\controllers;


use backend\controllers\BaseController;

class AccountController extends BaseController
{
    /*
     *  账户管理
     * */
    public function actions()
    {
        return [
            //账户信息保存
            'save' => ['class' => 'backend\actions\finance\account\SaveAction'],
            //账户列表
            'list' => ['class' => 'backend\actions\finance\account\ListAction'],
            //账户详情
            'info' => ['class' => 'backend\actions\finance\account\InfoAction']
        ];
    }

}