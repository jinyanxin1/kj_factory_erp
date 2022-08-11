<?php
/**
 * User: pyj
 * Date: 2020/8/6
 * Time: 11:07
 * 招聘上架
 */

namespace backend\actions\recruitment;


use backend\actions\BaseAction;
use common\library\helper\Code;
use common\models\recruitment\RecruitmentModel;

class ShelvesAction extends BaseAction
{
    public function run()
    {
        //接收参数
        $recruitmentId = $this->request()->post('recruitmentId');

        //修改招聘状态为上架
        RecruitmentModel::updateAll(['status' => 1],['recruitmentId' => $recruitmentId]);

        //返回结果
        return $this->returnApi(Code::SUCCESS,'上架成功');
    }

}