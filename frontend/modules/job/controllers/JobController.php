<?php
namespace frontend\modules\job\controllers;

use frontend\controllers\BaseController;

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
                'class'=>'frontend\actions\job\AddAction']
            ,
            //修改人才
            'job_save'=>[
                'class'=>'frontend\actions\job\SaveAction']
            ,
            //共享人才
            'job_public'=>[
                'class'=>'frontend\actions\job\PublicAction']
            ,
            //人才筛选
            'job_list'=>[
                'class'=>'frontend\actions\job\ListAction']
            ,
            //人才筛选
            'job_upcoming_list'=>[
                'class'=>'frontend\actions\job\UpcomingListAction']
            ,
            //续约
            'job_contract_add'=>[
                'class'=>'frontend\actions\jobContract\AddAction']
            ,
            //人才合同列表
            'job_contract_list'=>[
                'class'=>'frontend\actions\jobContract\ListAction']
            ,
            //入职
            'job_entry'=>[
                'class'=>'frontend\actions\job\EntryAction']
            ,
            //离职
            'job_leave'=>[
                'class'=>'frontend\actions\job\LeaveAction']
            ,
            //人才-基本信息
            'job_info'=>[
                'class'=>'frontend\actions\job\InfoAction']
            ,
            //人才-入职列表
            'job_entry_list'=>[
                'class'=>'frontend\actions\job\EntryListAction']
            ,
            //人才-离职列表
            'job_leave_list'=>[
                'class'=>'frontend\actions\job\LeaveListAction']
            ,
            //人才-离职入职详情
            'job_career_info'=>[
                'class'=> 'frontend\actions\jobCareerRecord\InfoAction']
            ,
            //导入
            'import' =>[
                'class'=> 'frontend\actions\job\ImportAction'],
            //模版
            'template' =>[
                'class'=> 'frontend\actions\job\TemplateAction']
        ];
    }
}