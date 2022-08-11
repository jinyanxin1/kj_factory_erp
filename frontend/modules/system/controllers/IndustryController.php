<?php
/**
 * User: cqj
 * Date: 2020/7/17
 * Time: 2:58 下午
 */

namespace frontend\modules\system\controllers;


use frontend\controllers\BaseController;

class IndustryController extends BaseController
{
    public function actions()
    {
        return [
            'select' => 'frontend\actions\industry\SelectAction',
            'add' => 'frontend\actions\industry\AddAction',
            'save' => 'frontend\actions\industry\SaveAction',
            'del' => 'frontend\actions\industry\DeleteAction',
        ];
    }
}