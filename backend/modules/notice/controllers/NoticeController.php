<?php
namespace backend\modules\notice\controllers;

use backend\controllers\BaseController;

class NoticeController extends BaseController
{
    public function actions()
    {
        return[
            //公告新增
            'add'=>[
                'class'=>'backend\actions\notice\AddAction'],
            //公告修改
            'save'=>[
                'class'=>'backend\actions\notice\SaveAction'],
            //公告列表
            'list'=>[
                'class'=>'backend\actions\notice\ListAction'],
            //公告详情
            'info'=>[
                'class'=>'backend\actions\notice\InfoAction'],
            //公告删除
            'del'=>[
                'class'=>'backend\actions\notice\DeleteAction'],
            //公告批量删除
            'dels'=>[
                'class'=>'backend\actions\notice\DelsAction'],
        ];
    }
}