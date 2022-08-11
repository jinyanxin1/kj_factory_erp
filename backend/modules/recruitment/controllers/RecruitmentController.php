<?php
/**
 * User: pyj
 * Date: 2020/8/6
 * Time: 11:15
 */

namespace backend\modules\recruitment\controllers;


use backend\controllers\BaseController;

class RecruitmentController extends BaseController
{
    public function actions()
    {
        return [
            //新增招聘
            'add'=>'backend\actions\recruitment\AddAction',
            //修改招聘
            'save'=>'backend\actions\recruitment\SaveAction',
            //招聘列表
            'list' => 'backend\actions\recruitment\ListAction',
            //删除招聘
            'del' => 'backend\actions\recruitment\DeleteAction',
            //删除详情
            'info' => 'backend\actions\recruitment\InfoAction',
            //报名列表
            'sig' => 'backend\actions\recruitment\SignupListAction',
            //标为邀约
            'invite' => 'backend\actions\recruitment\InviteAction',
            //下架招聘
            'cancel' => 'backend\actions\recruitment\CancelAction',
            //上架招聘
            'shelves' => 'backend\actions\recruitment\ShelvesAction',
        ];
    }

}