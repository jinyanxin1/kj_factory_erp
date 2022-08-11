<?php
namespace frontend\modules\client\controllers;

use frontend\controllers\BaseController;

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
                'class'=>'frontend\actions\clientInfo\AddAction']
            ,
            //修改客户
            'client_save'=>[
                'class'=>'frontend\actions\clientInfo\SaveAction']
            ,
            //删除客户
            'client_del'=>[
                'class'=>'frontend\actions\clientInfo\DeleteAction']
            ,
            //客户列表
            'client_list'=>[
                'class'=>'frontend\actions\clientInfo\ListAction']
            ,
            //客户人才列表
            'client_job'=>[
                'class'=>'frontend\actions\clientInfo\ClientJobAction']
            ,
            //人才动态
            'client_job_info'=>[
                'class'=>'frontend\actions\clientInfo\ClientJobInfoAction']
            ,
            //新建跟进
            'client_interview_add'=>[
                'class'=>'frontend\actions\clientInterviewRecord\AddAction']
            ,
            //新建联系人
            'client_person_add'=>[
                'class'=>'frontend\actions\clientPerson\AddAction']
            ,
            //修改联系人
            'client_person_save'=>[
                'class'=>'frontend\actions\clientPerson\SaveAction']
            ,
            //详情联系人
            'client_person_info'=>[
                'class'=>'frontend\actions\clientPerson\InfoAction']
            ,
            //删除联系人
            'client_person_del'=>[
                'class'=>'frontend\actions\clientPerson\DeleteAction']
            ,
            //客户详情-联系人
            'client_person_list'=>[
                'class'=>'frontend\actions\clientPerson\ListAction']
            ,
            //客户详情-基础信息
            'client_info'=>[
                'class'=>'frontend\actions\clientInfo\InfoAction']
            ,
            //客户详情-跟进动态
            'client_interview_list'=>[
                'class'=>'frontend\actions\clientInterviewRecord\ListAction']
            ,
            //客户详情-跟进详情
            'client_interview_info'=>[
                'class'=>'frontend\actions\clientInterviewRecord\InfoAction']
            ,
            //新增合同
            'client_contract_add'=>[
                'class'=>'frontend\actions\clientContract\AddAction']
            ,
            //客户详情-合同详情
            'client_contract_info'=>[
                'class'=>'frontend\actions\clientContract\InfoAction']
            ,
            //客户详情-合同信息列表
            'client_contract_list'=>[
                'class'=>'frontend\actions\clientContract\ListAction']
            ,
            //转移
            'client_shift'=>[
                'class'=>'frontend\actions\clientInfo\ShiftAction']
            ,
            //下拉列表
            'select'=>[
                'class'=>'frontend\actions\clientInfo\SelectAction']
            ,
            //下拉列表
            'person_select'=>[
                'class'=>'frontend\actions\clientPerson\AllAction']
            ,
        ];
    }
}