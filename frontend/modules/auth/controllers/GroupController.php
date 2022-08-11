<?php
/**
 * Created by PhpStorm.
 * User: zhouk
 * Date: 2019/8/1
 * Time: 21:29
 */

namespace frontend\modules\auth\controllers;


use frontend\controllers\BaseController;

class GroupController extends BaseController
{

    public function actions()
    {
        return [
            //todo  这是平台的
            'list' => 'frontend\actions\group\ListAction',
            'info' => 'frontend\actions\group\InfoAction',
            'save' => 'frontend\actions\group\SaveAction',
            'add' => 'frontend\actions\group\AddAction',
            'del' => 'frontend\actions\group\DeleteAction',
            'all' => 'frontend\actions\group\AllAction',
        ];
    }

}