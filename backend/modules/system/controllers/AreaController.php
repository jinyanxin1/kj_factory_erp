<?php
/**
 * User: cqj
 * Date: 2020/7/17
 * Time: 10:03 上午
 */

namespace backend\modules\system\controllers;


use backend\controllers\BaseController;

class AreaController extends BaseController
{
    public function actions()
    {
        return [
            'select' => 'backend\actions\dgtxPlaces\SelectAction',
            'add' => 'backend\actions\dgtxPlaces\AddAction',
            'save' => 'backend\actions\dgtxPlaces\SaveAction',
            'del' => 'backend\actions\dgtxPlaces\DeleteAction',
            'list' => 'backend\actions\dgtxPlaces\ListAction',

        ];
    }
}