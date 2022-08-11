<?php
/**
 * Created by cqj
 * User: cqj
 * Date: 2019/10/25
 * Time: 10:00
 */

namespace backend\modules\system\controllers;


use backend\controllers\BaseController;

class BasicsController extends BaseController
{
    public function actions()
    {
        return [
            'list'=>[
                'class'=>'backend\actions\basics\ListAction']
            ,
            'add'=>[
                'class'=>'backend\actions\basics\InsertAction']
            ,
            'delete'=>[
                'class'=>'backend\actions\basics\DelAction']
            ,
            'save'=>[
                'class'=>'backend\actions\basics\UpdateAction']
            ,
//            'info'=>[
//                'class'=>'backend\actions\basics\InfoAction']
//            ,
            'type-list'=>[
                'class'=>'backend\actions\basics\TypeListAction']
            ,
        ];
    }
}