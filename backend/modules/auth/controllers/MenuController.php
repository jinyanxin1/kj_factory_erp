<?php
/**
 * Created by PhpStorm.
 * User: zhouk
 * Date: 2019/8/1
 * Time: 15:01
 */

namespace backend\modules\auth\controllers;


use backend\controllers\BaseController;

class MenuController extends BaseController
{

    public function actions()
    {
        return [
            'list' => 'backend\actions\auth\MenuListAction',
            'del' => 'backend\actions\auth\MenuDelAction',
            'add' => 'backend\actions\auth\MenuAddAction',
            'save' => 'backend\actions\auth\MenuSaveAction',
            'order' => 'backend\actions\auth\MenuOrderAction',
        ];
    }
}