<?php
/**
 * User: pyj
 * Date: 2020/8/6
 * Time: 15:43
 * 删除招聘
 */

namespace frontend\actions\recruitment;


use common\library\helper\Code;
use common\models\recruitment\RecruitmentModel;
use frontend\actions\WxAction;

class DeleteAction extends WxAction
{
    public function run(){
        //接收参数
        $recruitmentId = $this->request()->post('recruitmentId');

        //判断传参
        if(empty($recruitmentId)){
            return $this->returnApi(Code::PARAM_ERR,'招聘编号不能为空');
        }

        //查询模型
        $model = RecruitmentModel::find()
            ->where(['recruitmentId' => $recruitmentId,'isValid' =>RecruitmentModel::IS_VALID_OK])
            ->limit(1)
            ->one();

        if(empty($model)){
            return $this->returnApi(Code::PARAM_ERR,'查询结果为空');
        }
        //修改模型
        $model->isValid = RecruitmentModel::IS_VALID_NO;
        $bool = $model->save();
        //返回结果
        if(!$bool) {
            return $this->returnApi(Code::PARAM_ERR, '删除失败');
        }
        return $this->returnApi(Code::SUCCESS, '删除成功');
    }
}