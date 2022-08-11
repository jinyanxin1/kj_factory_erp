<?php
namespace frontend\modules\staff\controllers;

use frontend\controllers\BaseController;

/**
 * User: cqj
 * Date: 2020/7/7
 * Time: 3:15 下午
 */

class StaffController extends BaseController
{
    public function actions()
    {
        return [
            //新增职工
            'staff_add'=>[
                'class'=>'frontend\actions\staffInfo\AddAction']
            ,
            //修改职工
            'staff_save'=>[
                'class'=>'frontend\actions\staffInfo\SaveAction']
            ,
            //职工离职
//            'staff_leave'=>[
//                'class'=>'frontend\actions\staffLeave\AddAction']
//            ,
            //职工筛选列表
            'staff_list'=>[
                'class'=>'frontend\actions\staffInfo\ListAction']
            ,
            //合同管理-列表
            'staff_contract_list'=>[
                'class'=>'frontend\actions\staffContract\ListAction']
            ,
            //离职信息
            'staff_leave_info'=>[
                'class'=>'frontend\actions\staffLeave\InfoAction']
            ,
            //合同详情
            'staff_contract_info'=>[
                'class'=>'frontend\actions\staffContract\InfoAction']
            ,
            //新增合同
            'staff_contract_add'=>[
                'class'=>'frontend\actions\staffContract\AddAction']
            ,
            //通讯录
            'staff_address_book'=>[
                'class'=>'frontend\actions\staffInfo\BookAction']
            ,
            //职工详情
            'staff_info'=>[
                'class'=>'frontend\actions\staffInfo\InfoAction']
            ,
            //离职列表
            'staff_leave_list'=>[
                'class'=>'frontend\actions\staffLeave\ListAction']
            ,
            //下拉列表
            'select'=>[
                'class'=>'frontend\actions\staffInfo\SelectAction']
            ,
        ];
    }
}