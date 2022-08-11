<?php
/**
 * Created by cqj
 * User: cqj
 * Date: 2019/10/24
 * Time: 11:23
 * 部门设置
 */

namespace backend\modules\system\controllers;


use backend\controllers\BaseController;

class SectionController extends BaseController
{
    public function actions()
    {
        return [
            'list'=>[
                'class'=>'backend\actions\section\ListAction']
            ,
            'add'=>[
                'class'=>'backend\actions\section\InsertAction']
            ,
            'delete'=>[
                'class'=>'backend\actions\section\DelAction']
            ,
            'save'=>[
                'class'=>'backend\actions\section\UpdateAction']
            ,
            'info'=>[
                'class'=>'backend\actions\section\InfoAction']
            ,
//            'campusList'=>[
//                'class'=>'backend\actions\section\CampusListAction']//ljx 校区接口
        ];
    }
}
