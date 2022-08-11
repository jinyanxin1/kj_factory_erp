<?php
/**
 * User: cqj
 * Date: 2020/7/22
 * Time: 10:46 上午
 */

namespace backend\modules\system\controllers;


use backend\controllers\BaseController;

class ConfigController extends BaseController
{
    public function actions()
    {
        return [
            'info' => 'backend\actions\config\InfoAction',
            'save' => 'backend\actions\config\SaveAction',
        ];
    }
}