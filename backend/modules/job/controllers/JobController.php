<?php
namespace backend\modules\job\controllers;

use backend\controllers\BaseController;

/**
 * User: cqj
 * Date: 2020/7/7
 * Time: 3:15 下午
 */

class JobController extends BaseController
{
    public function actions()
    {
        return [
            //新建人才
            'job_add'=>[
                'class'=>'backend\actions\job\AddAction']
            ,
            //修改人才
            'job_save'=>[
                'class'=>'backend\actions\job\SaveAction']
            ,
            //共享人才
            'job_public'=>[
                'class'=>'backend\actions\job\PublicAction']
            ,
            //人才筛选
            'job_list'=>[
                'class'=>'backend\actions\job\ListAction']
            ,
            //续约
            'job_contract_add'=>[
                'class'=>'backend\actions\jobContract\AddAction']
            ,
            //人才合同列表
            'job_contract_list'=>[
                'class'=>'backend\actions\jobContract\ListAction']
            ,
            //入职
            'job_entry'=>[
                'class'=>'backend\actions\job\EntryAction']
            ,
            //离职
            'job_leave'=>[
                'class'=>'backend\actions\job\LeaveAction']
            ,
            //人才-基本信息
            'job_info'=>[
                'class'=>'backend\actions\job\InfoAction']
            ,
            //人才-入职列表
            'job_entry_list'=>[
                'class'=>'backend\actions\job\EntryListAction']
            ,
            //人才-离职列表
            'job_leave_list'=>[
                'class'=>'backend\actions\job\LeaveListAction']
            ,
            //人才-离职入职详情
            'job_career_info'=>[
                'class'=> 'backend\actions\jobCareerRecord\InfoAction']
            ,
            //导入
            'import' =>[
                'class'=> 'backend\actions\job\ImportAction'],
            //导出
            'export' =>[
                'class'=> 'backend\actions\job\ExportAction'],
            //模版
            'template' =>[
                'class'=> 'backend\actions\job\TemplateAction'],
            //转移
            'job_shift'=>[
                'class'=>'backend\actions\job\ShiftAction']
            ,
        ];
    }
}