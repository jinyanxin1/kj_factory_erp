<?php
namespace backend\modules\staff\controllers;

use backend\controllers\BaseController;

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
                'class'=>'backend\actions\staffInfo\AddAction']
            ,
            //修改职工
            'staff_save'=>[
                'class'=>'backend\actions\staffInfo\SaveAction']
            ,
            //职工复职
            'staff_entry'=>[
                'class'=>'backend\actions\staffInfo\EntryAction']
            ,
            //职工离职
            'staff_leave'=>[
                'class'=>'backend\actions\staffLeave\AddAction']
            ,
            //职工删除
            'staff_del'=>[
                'class'=>'backend\actions\staffInfo\DeleteAction']
            ,
            //职工筛选列表
            'staff_list'=>[
                'class'=>'backend\actions\staffInfo\ListAction']
            ,
            //合同管理-列表
            'staff_contract_list'=>[
                'class'=>'backend\actions\staffContract\ListAction']
            ,
            //离职信息
            'staff_leave_info'=>[
                'class'=>'backend\actions\staffLeave\InfoAction']
            ,
            //合同详情
            'staff_contract_info'=>[
                'class'=>'backend\actions\staffContract\InfoAction']
            ,
            //新增合同
            'staff_contract_add'=>[
                'class'=>'backend\actions\staffContract\AddAction']
            ,
            //通讯录
            'staff_address_book'=>[
                'class'=>'backend\actions\staffInfo\BookAction']
            ,
            //职工详情
            'staff_info'=>[
                'class'=>'backend\actions\staffInfo\InfoAction']
            ,
            //离职列表
            'staff_leave_list'=>[
                'class'=>'backend\actions\staffLeave\ListAction']
            ,
            //下拉列表
            'select'=>[
                'class'=>'backend\actions\staffInfo\SelectAction']
            ,
            //下拉列表格式化
            'select-info' => [
                'class' => 'backend\actions\staffInfo\SelectInfoAction'
            ],
            //职工导出
            'staff_export'=>[
                'class'=>'backend\actions\staffInfo\ExportAction']
            ,
        ];
    }
}