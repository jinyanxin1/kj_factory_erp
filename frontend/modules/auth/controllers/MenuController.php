<?php
/**
 * Created by PhpStorm.
 * User: zhouk
 * Date: 2019/8/1
 * Time: 15:01
 */

namespace frontend\modules\auth\controllers;


use frontend\controllers\BaseController;

class MenuController extends BaseController
{

    public function actions()
    {
        return [
            'list' => 'frontend\actions\auth\MenuListAction',
            'del' => 'frontend\actions\auth\MenuDelAction',
            'add' => 'frontend\actions\auth\MenuAddAction',
            'save' => 'frontend\actions\auth\MenuSaveAction',
            'order' => 'frontend\actions\auth\MenuOrderAction',
        ];
    }
}