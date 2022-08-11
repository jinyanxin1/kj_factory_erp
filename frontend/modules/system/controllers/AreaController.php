<?php
/**
 * User: cqj
 * Date: 2020/7/17
 * Time: 10:03 上午
 */

namespace frontend\modules\system\controllers;


use frontend\controllers\BaseController;

class AreaController extends BaseController
{
    public function actions()
    {
        return [
            'select' => 'frontend\actions\dgtxPlaces\SelectAction',
            'add' => 'frontend\actions\dgtxPlaces\AddAction',
            'save' => 'frontend\actions\dgtxPlaces\SaveAction',
            'del' => 'frontend\actions\dgtxPlaces\DeleteAction',
            'list' => 'frontend\actions\dgtxPlaces\ListAction',

        ];
    }
}