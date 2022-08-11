<?php
/**
 *
 * author: jinyanxin
 * Date: 2020/9/2
 * Time: 9:42
 * PHP version 7
 */

namespace backend\modules\project\controllers;


use backend\controllers\BaseController;

class ManageController extends BaseController
{
    /*
     * 项目管理
     * */
    public function actions()
    {
        return [
            //保存项目信息
            'save' => ['class' => 'backend\actions\project\manage\SaveAction'],
            //项目列表
            'list' => ['class' => 'backend\actions\project\manage\ListAction'],
            //详情
            'info' => ['class' => 'backend\actions\project\manage\InfoAction'],
            //删除
            'del' => ['class' => 'backend\actions\project\manage\DelAction'],
            //获取项目报备人用户
            'get-report-user' => ['class' => 'backend\actions\project\manage\GetReportUserAction']
        ];
    }
}