<?php
/**
 * User: pyj
 * Date: 2020/8/12
 * Time: 17:10
 */

namespace backend\actions\recruitment;


use backend\actions\BaseAction;
use common\library\helper\Code;
use common\models\jobRegistra\JobRegistraModel;

class InviteAction extends BaseAction
{
    public function run(){
        //接收参数
        $registraId = $this->request()->post('registraId');

        //批量修改邀约结果
        JobRegistraModel::updateAll(['invite' => 1],['registraId' => $registraId]);

        //返回结果
        return $this->returnApi(Code::SUCCESS,'ok');
    }
}