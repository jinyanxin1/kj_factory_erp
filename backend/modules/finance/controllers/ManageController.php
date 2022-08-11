<?php
/**
 *
 * author: jinyanxin
 * Date: 2020/9/7
 * Time: 10:49
 * PHP version 7
 */

namespace backend\modules\finance\controllers;


use backend\controllers\BaseController;

class ManageController extends BaseController
{
    /*
     * 收支管理
     * */
    public function actions()
    {
        return [
            //新增财务收支记录
            'save' => ['class' => 'backend\actions\finance\manage\SaveAction'],
            //记录列表
            'list' => ['class' => 'backend\actions\finance\manage\ListAction'],
            //获取配置
            'get-config' => ['class' => 'backend\actions\finance\manage\GetConfigAction']
        ];
    }

}