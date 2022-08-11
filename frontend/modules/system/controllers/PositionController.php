<?php
/**
 * User: cqj
 * Date: 2020/7/17
 * Time: 2:58 下午
 */

namespace frontend\modules\system\controllers;


use frontend\controllers\BaseController;

class PositionController extends BaseController
{
    public function actions()
    {
        return [
            'select' => 'frontend\actions\staffPosition\SelectAction',
            'add' => 'frontend\actions\staffPosition\AddAction',
            'save' => 'frontend\actions\staffPosition\SaveAction',
            'del' => 'frontend\actions\staffPosition\DeleteAction',
        ];
    }
}