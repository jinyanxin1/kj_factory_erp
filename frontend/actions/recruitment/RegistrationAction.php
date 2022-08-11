<?php
/**
 * User: pyj
 * Date: 2020/8/11
 * Time: 18:30
 */

namespace frontend\actions\recruitment;


use common\library\helper\Code;
use common\models\jobRegistra\JobRegistraModel;
use frontend\actions\WxAction;

class RegistrationAction extends WxAction
{
    public function run(){
        //接收参数
        $jobId = $this->jobId;
        $recruitmentId = $this->request()->post('recruitmentId');
        $clientId = $this->request()->post('clientId');

        //判读传参
        if(empty($jobId) || empty($recruitmentId)){
            return $this->returnApi(Code::PARAM_ERR,'人才id和招聘id不能为空');
        }
        //TODO 判断人才是否完善信息 info == 0 为已完善

        //查询是否报名
        $reg = JobRegistraModel::find()
            ->where(['jobId' =>$jobId,'recruitmentId' => $recruitmentId,'isValid' =>JobRegistraModel::IS_VALID_OK])
            ->limit(1)
            ->one();

        if(!empty($reg)){
            return $this->returnApi(Code::PARAM_ERR,'您已报名该活动');
        }

        //创建模型
        $model = new JobRegistraModel();

        //修改模型
        $model->jobId = $jobId;
        $model->recruitmentId = $recruitmentId;
        $model->clientId = $clientId;
        $model->creator = $this->staffId;
        $bool = $model->save();

        //返回结果
        if(!$bool){
            return $this->returnApi(Code::PARAM_ERR,'新增失败');
        }
        return $this->returnApi(Code::SUCCESS,'新增成功');
    }
}