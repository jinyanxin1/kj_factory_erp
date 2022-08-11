<?php
/**
 * @Author: jinyanxin
 * @Date: 2020/1/7
 * @Time: 9:43
 * 仓库设置
 */


namespace frontend\modules\purchase\controllers;


use frontend\controllers\BaseController;

class WareHouseController extends BaseController
{
    public function actions()
    {
        return[
            //新增
            'add'=>['class'=>'frontend\actions\purchase\wareHouse\AddAction'],
            //列表
            'list'=>['class'=>'frontend\actions\purchase\wareHouse\ListAction'],
            //删除
            'del'=>['class'=>'frontend\actions\purchase\wareHouse\DelAction']
        ];
    }
}