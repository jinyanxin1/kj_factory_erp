<?php
/**
 * User: pyj
 * Date: 2020/8/6
 * Time: 11:08
 */

namespace backend\actions\recruitment;


use backend\actions\BaseAction;
use common\library\helper\Code;
use common\models\recruitment\RecruitmentModel;

class DeleteAction extends BaseAction
{
    public function run(){
        //接收传参
        $recruitmentId = $this->request()->post('recruitmentId');

        //判断传参
        if (empty($recruitmentId)){
            return $this->returnApi(Code::PARAM_ERR,'招聘编号不能为空');
        }

        //修改模型
        $model = RecruitmentModel::updateAll(['isValid' => RecruitmentModel::IS_VALID_NO],
            ['recruitmentId' => $recruitmentId]);

        //返回结果
        return $this->returnApi(Code::SUCCESS,'删除成功');
    }
}