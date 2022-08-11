<?php
/**
 * Created by PhpStorm.
 * User: zhouk
 * Date: 2019/8/2
 * Time: 1:56
 */

namespace backend\modules\auth\controllers;


use backend\controllers\BaseController;

class AuthController extends BaseController
{

    public function actions()
    {
        return [
            'menu' => 'backend\actions\auth\AuthInfoAction',
            'save' => 'backend\actions\auth\AuthSaveAction',
            'login-info' => 'backend\actions\auth\CheckTokenAction',
        ];
    }

}