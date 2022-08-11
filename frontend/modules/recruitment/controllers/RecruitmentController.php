<?php
/**
 * User: pyj
 * Date: 2020/8/6
 * Time: 15:46
 */

namespace frontend\modules\recruitment\controllers;


use frontend\controllers\BaseController;

class RecruitmentController extends BaseController
{
    public function actions()
    {
        return[

            //新增招聘
            'recruitment_add'=>'frontend\actions\recruitment\AddAction',
            //修改招聘
            'recruitment_save'=>'frontend\actions\recruitment\SaveAction',
            //人才招聘列表
            'recruitment_list' => 'frontend\actions\recruitment\ListAction',
            //删除招聘
            'recruitment_del' => 'frontend\actions\recruitment\DeleteAction',
            //详情招聘
            'recruitment_info' => 'frontend\actions\recruitment\InfoAction',
            //人才报名
            'reg' => 'frontend\actions\recruitment\RegistrationAction',
            //员工招聘详情
            'emp' => 'frontend\actions\recruitment\EmployeeRecruitmentAction',
            ];
    }
}