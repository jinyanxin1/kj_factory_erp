<?php
namespace frontend\modules\notice\controllers;

use frontend\controllers\BaseController;

class NoticeController extends BaseController
{
    public function actions()
    {
        return[
            //公告新增
            'add'=>[
                'class'=>'frontend\actions\notice\AddAction'],
            //公告列表
            'list'=>[
                'class'=>'frontend\actions\notice\ListAction'],
            //公告详情
            'info'=>[
                'class'=>'frontend\actions\notice\InfoAction'],
            //公告删除
            'del'=>[
                'class'=>'frontend\actions\notice\DeleteAction'],
            //公告批量删除
            'dels'=>[
                'class'=>'frontend\actions\notice\DelsAction'],
        ];
    }
}