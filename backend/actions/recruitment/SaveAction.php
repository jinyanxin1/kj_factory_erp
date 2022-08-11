<?php
/**
 * User: pyj
 * Date: 2020/8/6
 * Time: 11:07
 * 修改招聘
 */

namespace backend\actions\recruitment;


use backend\actions\BaseAction;
use common\library\helper\Code;
use common\models\recruitment\RecruitmentModel;

class SaveAction extends BaseAction
{
    public function run(){
        //接收参数
        $recruitmentId = $this->request()->post('recruitmentId');
        $clientId = $this->request()->post('clientId');
        $sex = $this->request()->post('sex');
        $minSalary = $this->request()->post('minSalary');
        $maxSalary = $this->request()->post('maxSalary');
        $minAge = $this->request()->post('minAge');
        $maxAge = $this->request()->post('maxAge');
        $education = $this->request()->post('education');
        $provinceId = $this->request()->post('provinceId');
        $cityId = $this->request()->post('cityId');
        $areaId = $this->request()->post('areaId');
        $advantage = $this->request()->post('advantage');
        $post = $this->request()->post('post');
        $instructions  = $this->request()->post('instructions');
        //判断传参
        if(empty($clientId)){
            return $this->returnApi(Code::PARAM_ERR,'需要选择招聘公司');
        }
        elseif(empty($post)){
            return $this->returnApi(Code::PARAM_ERR,'职位不能为空');
        }
        if(mb_strlen($instructions,'utf8') > 500){
            return $this->returnApi(Code::PARAM_ERR,'招聘简介500字内');
        }

        //查询模型
        $model = RecruitmentModel::find()
            ->where(['isValid' => RecruitmentModel::IS_VALID_OK])
            ->andwhere(['recruitmentId' => $recruitmentId])
            ->limit(1)
            ->one();

        //判断查询结果
        if(empty($model)){
            return $this->returnApi(Code::PARAM_ERR,'查询结果为空');
        }
        //修改模型
        $model->clientId = $clientId;
        $model->sex = $sex;
        $model->minSalary = $this->amountToCent($minSalary);
        $model->maxSalary = $this->amountToCent($maxSalary);
        $model->minAge = $minAge;
        $model->maxAge = $maxAge;
        $model->education = $education;
        $model->provinceId = $provinceId;
        $model->cityId = $cityId;
        $model->areaId = $areaId;
        $model->advantage = $advantage;
        $model->post = $post;
        $model->instructions = $instructions;
        $bool = $model->save();

        //判断结果
        if(!($bool)){
            return $this->returnApi(Code::PARAM_ERR,'修改失败');
        }
        return $this->returnApi(Code::SUCCESS,'修改成功',$model);
    }
}