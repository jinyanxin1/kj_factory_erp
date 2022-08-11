<?php
/**
 * Created by PhpStorm.
 * User: zhouk
 * Date: 2019/8/1
 * Time: 21:29
 */

namespace backend\modules\auth\controllers;


use backend\controllers\BaseController;

class GroupController extends BaseController
{

    public function actions()
    {
        return [
            //todo  这是平台的
            'list' => 'backend\actions\group\ListAction',
            'info' => 'backend\actions\group\InfoAction',
            'save' => 'backend\actions\group\SaveAction',
            'add' => 'backend\actions\group\AddAction',
            'del' => 'backend\actions\group\DeleteAction',
            'all' => 'backend\actions\group\AllAction',
            'select' => 'backend\actions\group\SelectAction',
        ];
    }

}