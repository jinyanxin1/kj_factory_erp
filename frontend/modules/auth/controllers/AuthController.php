<?php
/**
 * Created by PhpStorm.
 * User: zhouk
 * Date: 2019/8/2
 * Time: 1:56
 */

namespace frontend\modules\auth\controllers;


use frontend\controllers\BaseController;

class AuthController extends BaseController
{

    public function actions()
    {
        return [
            'menu' => 'frontend\actions\auth\AuthInfoAction',
            'save' => 'frontend\actions\auth\AuthSaveAction',
            'login-info' => 'frontend\actions\auth\CheckTokenAction',
        ];
    }

}