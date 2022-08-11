<?php
namespace frontend\modules\job\controllers;

use frontend\controllers\BaseController;

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
                'class'=>'frontend\actions\jobInterviewRecord\AddAction']
            ,
            //邀约面试
            'adds'=>[
                'class'=>'frontend\actions\jobInterviewRecord\AddsAction']
            ,
            //邀约动态
            'job_page'=>[
                'class'=>'frontend\actions\jobInterviewRecord\JobPageAction']
            ,
            //邀约详情
            'info'=>[
                'class'=>'frontend\actions\jobInterviewRecord\InfoAction']
            ,
            //面试结果
            'result'=>[
                'class'=>'frontend\actions\jobInterviewRecord\ResultAction']
            ,
        ];
    }
}