<?php
/**
 * User: pyj
 * Date: 2020/8/6
 * Time: 11:06
 * 新增招聘
 */
namespace backend\actions\recruitment;

use backend\actions\BaseAction;
use Codeception\Module\Yii2;
use common\library\helper\Code;
use common\models\recruitment\RecruitmentModel;

class AddAction extends BaseAction
{
    public function run(){
        //接收参数
        $staffId = $this->request()->post('staffId');
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
        //判断
        if(empty($clientId)){
            return $this->returnApi(Code::PARAM_ERR,'需要选择招聘公司');
        }
        elseif(empty($post)){
            return $this->returnApi(Code::PARAM_ERR,'职位不能为空');
        }
        if(mb_strlen($instructions,'utf8') > 500){
            return $this->returnApi(Code::PARAM_ERR,'招聘简介500字内');
        }
        //创建模型
        $model = new RecruitmentModel();

        //修改模型
        $model->staffId = $staffId;
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

        //返回结果
        if(!($bool)){
           return $this->returnApi(Code::PARAM_ERR,'新增失败');
        }
        return $this->returnApi(Code::SUCCESS,'新增成功',$model);
    }
}