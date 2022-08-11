<?php
/**
 * User: pyj
 * Date: 2020/8/6
 * Time: 11:07
 * 招聘下架
 */

namespace backend\actions\recruitment;


use backend\actions\BaseAction;
use common\library\helper\Code;
use common\models\recruitment\RecruitmentModel;

class CancelAction extends BaseAction
{
    public function run()
    {
        //接收参数
        $recruitmentId = $this->request()->post('recruitmentId');

        //修改招聘状态为下架
        RecruitmentModel::updateAll(['status' => 2,'updateTime'=>date('Y-m-d H:i:s')],['recruitmentId' => $recruitmentId]);

        //返回结果
        return $this->returnApi(Code::SUCCESS,'下架成功');
    }
}