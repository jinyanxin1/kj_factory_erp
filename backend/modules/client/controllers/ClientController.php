<?php
namespace backend\modules\client\controllers;

use backend\controllers\BaseController;

/**
 * User: cqj
 * Date: 2020/7/7
 * Time: 3:15 下午
 */

class ClientController extends BaseController
{
    public function actions()
    {
        return [
            //新增客户
            'client_add'=>[
                'class'=>'backend\actions\clientInfo\AddAction']
            ,
            //修改客户
            'client_save'=>[
                'class'=>'backend\actions\clientInfo\SaveAction']
            ,
            //删除客户
            'client_del'=>[
                'class'=>'backend\actions\clientInfo\DeleteAction']
            ,
            //客户列表
            'client_list'=>[
                'class'=>'backend\actions\clientInfo\ListAction']
            ,
            'list'=>[
                'class'=>'backend\actions\clientInfo\AllAction']
            ,


            //新建联系人
            'client_person_add'=>[
                'class'=>'backend\actions\clientPerson\AddAction']
            ,
            //修改联系人
            'client_person_save'=>[
                'class'=>'backend\actions\clientPerson\SaveAction']
            ,
            //详情联系人
            'client_person_info'=>[
                'class'=>'backend\actions\clientPerson\InfoAction']
            ,
            //删除联系人
            'client_person_del'=>[
                'class'=>'backend\actions\clientPerson\DeleteAction']
            ,
            //客户详情-联系人
            'client_person_list'=>[
                'class'=>'backend\actions\clientPerson\ListAction']
            ,
            'person-list'=>[
                'class'=>'backend\actions\clientPerson\PersonListAction']
            ,
            //客户详情-基础信息
            'client_info'=>[
                'class'=>'backend\actions\clientInfo\InfoAction']
            ,
            //客户详情-跟进动态
            'client_interview_list'=>[
                'class'=>'backend\actions\clientInterviewRecord\ListAction']
            ,
            //客户详情-跟进详情
            'client_interview_info'=>[
                'class'=>'backend\actions\clientInterviewRecord\InfoAction']
            ,
            //新增合同
            'client_contract_add'=>[
                'class'=>'backend\actions\clientContract\AddAction']
            ,
            //客户详情-合同详情
            'client_contract_info'=>[
                'class'=>'backend\actions\clientContract\InfoAction']
            ,
            //客户详情-合同信息列表
            'client_contract_list'=>[
                'class'=>'backend\actions\clientContract\ListAction']
            ,
            //转移
            'client_shift'=>[
                'class'=>'backend\actions\clientInfo\ShiftAction']
            ,
            //下拉列表
            'select'=>[
                'class'=>'backend\actions\clientInfo\SelectAction']
            ,
            //下拉列表
            'person_select'=>[
                'class'=>'backend\actions\clientPerson\AllAction']
            ,
        ];
    }
}