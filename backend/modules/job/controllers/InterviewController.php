<?php
namespace backend\modules\job\controllers;

use backend\controllers\BaseController;

/**
 * User: cqj
 * Date: 2020/7/7
 * Time: 5:08 下午
 */

class InterviewController extends BaseController
{
    public function actions()
    {
        return [
            //邀约面试
            'add'=>[
                'class'=>'backend\actions\jobInterviewRecord\AddAction']
            ,
            'save'=>[
                'class'=>'backend\actions\jobInterviewRecord\SaveAction']
            ,
            //邀约面试
            'adds'=>[
                'class'=>'backend\actions\jobInterviewRecord\AddsAction']
            ,
            //邀约动态
            'job_page'=>[
                'class'=>'backend\actions\jobInterviewRecord\JobPageAction']
            ,
            //我的邀约
            'my_job_page'=>[
                'class'=>'backend\actions\jobInterviewRecord\MyJobPageAction']
            ,//我的邀约删除
            'my_job_del'=>[
                'class'=>'backend\actions\jobInterviewRecord\DeleteAction']
            ,
            //邀约详情
            'info'=>[
                'class'=>'backend\actions\jobInterviewRecord\InfoAction']
            ,
            //面试结果
            'result'=>[
                'class'=>'backend\actions\jobInterviewRecord\ResultAction']
            ,
            'export' =>[
                'class'=> 'backend\actions\jobInterviewRecord\ExportAction'],
        ];
    }
}