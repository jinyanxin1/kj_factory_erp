<?php
/**
 * User: cqj
 * Date: 2020/7/23
 * Time: 9:16 上午
 */

namespace backend\modules\system\controllers;


use backend\controllers\BaseController;

class UpcomingController extends BaseController
{
    public function actions()
    {
        return [
            //代办事项
            'list'=>[
                'class'=>'backend\actions\upcoming\ListAction']
            ,

        ];
    }
}