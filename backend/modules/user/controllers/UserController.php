<?php
/**
 * Created by lanww.
 * User: lanww
 * Date: 2019/7/30
 * Time: 15:06
 */

namespace backend\modules\user\controllers;

use backend\controllers\BaseController;


class UserController extends BaseController
{

    public function actions()
    {
        return [
            'list' => [
                'class' => 'backend\actions\user\ListAction'],//列表
            'update' => [
                'class' => 'backend\actions\user\UpdateAction'],//修改
            'insert' => [
                'class' => 'backend\actions\user\InsertAction'],//新增
            'reset' => [
                'class' => 'backend\actions\user\ResetAction'],//重置密码
            'check' => [
                'class' => 'backend\actions\user\CheckAction'],//分配角色
            'info' => [
                'class' => 'backend\actions\user\InfoAction'],//详情
            'user_type' => [
                'class' => 'backend\actions\user\UserTypeAction'],//角色类型
            'change-pwd'=>[
                'class'=>'backend\actions\user\ChangePwdAction'],//修改密码
        ];
    }
}
