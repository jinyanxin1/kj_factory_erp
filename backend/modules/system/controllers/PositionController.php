<?php
/**
 * User: cqj
 * Date: 2020/7/17
 * Time: 2:58 下午
 */

namespace backend\modules\system\controllers;


use backend\controllers\BaseController;

class PositionController extends BaseController
{
    public function actions()
    {
        return [
            'select' => 'backend\actions\staffPosition\SelectAction',
            'add' => 'backend\actions\staffPosition\AddAction',
            'save' => 'backend\actions\staffPosition\SaveAction',
            'del' => 'backend\actions\staffPosition\DeleteAction',
        ];
    }
}