<?php
/**
 * User: cqj
 * Date: 2020/7/17
 * Time: 2:58 下午
 */

namespace backend\modules\system\controllers;


use backend\controllers\BaseController;

class IndustryController extends BaseController
{
    public function actions()
    {
        return [
            'select' => 'backend\actions\industry\SelectAction',
            'add' => 'backend\actions\industry\AddAction',
            'save' => 'backend\actions\industry\SaveAction',
            'del' => 'backend\actions\industry\DeleteAction',
        ];
    }
}