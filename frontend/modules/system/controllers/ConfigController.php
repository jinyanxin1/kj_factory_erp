<?php
/**
 * User: cqj
 * Date: 2020/7/22
 * Time: 10:46 上午
 */

namespace frontend\modules\system\controllers;


use frontend\controllers\BaseController;

class ConfigController extends BaseController
{
    public function actions()
    {
        return [
            'info' => 'frontend\actions\config\InfoAction',
            'save' => 'frontend\actions\config\SaveAction',
        ];
    }
}