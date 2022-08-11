<?php
/**
 * Created by cqj
 * User: cqj
 * Date: 2019/10/25
 * Time: 10:00
 */

namespace frontend\modules\system\controllers;


use frontend\controllers\BaseController;

class BasicsController extends BaseController
{
    public function actions()
    {
        return [
            'list'=>[
                'class'=>'frontend\actions\basics\ListAction']
            ,
            'add'=>[
                'class'=>'frontend\actions\basics\InsertAction']
            ,
            'delete'=>[
                'class'=>'frontend\actions\basics\DelAction']
            ,
            'save'=>[
                'class'=>'frontend\actions\basics\UpdateAction']
            ,
//            'info'=>[
//                'class'=>'frontend\actions\basics\InfoAction']
//            ,
            'type-list'=>[
                'class'=>'frontend\actions\basics\TypeListAction']
            ,
        ];
    }
}