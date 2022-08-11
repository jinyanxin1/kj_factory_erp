<?php
/**
 * User: cqj
 * Date: 2020/7/23
 * Time: 9:16 上午
 */

namespace frontend\modules\system\controllers;


use frontend\controllers\BaseController;

class UpcomingController extends BaseController
{
    public function actions()
    {
        return [
            'list'=>[
                'class'=>'frontend\actions\upcoming\ListAction']
            ,

        ];
    }
}