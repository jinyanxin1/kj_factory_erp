<?php
/**
 * Created by cqj
 * User: cqj
 * Date: 2019/10/24
 * Time: 11:23
 * 部门设置
 */

namespace frontend\modules\system\controllers;


use frontend\controllers\BaseController;

class SectionController extends BaseController
{
    public function actions()
    {
        return [
            'list'=>[
                'class'=>'frontend\actions\section\ListAction']
            ,
            'add'=>[
                'class'=>'frontend\actions\section\InsertAction']
            ,
            'delete'=>[
                'class'=>'frontend\actions\section\DelAction']
            ,
            'save'=>[
                'class'=>'frontend\actions\section\UpdateAction']
            ,
            'info'=>[
                'class'=>'frontend\actions\section\InfoAction']
            ,
//            'campusList'=>[
//                'class'=>'frontend\actions\section\CampusListAction']//ljx 校区接口
        ];
    }
}
