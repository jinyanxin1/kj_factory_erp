<?php
/**
 *
 * author: jinyanxin
 * Date: 2021/7/27
 * Time: 15:26
 * PHP version 7
 */

namespace backend\actions\goods\working;


use backend\actions\BaseAction;
use common\models\workingProcedure\GoodsWorkingProcedureForm;

class DelAction extends BaseAction
{

    public function run()
    {
        $id = intval($this->request()->post('id'));

        $working = new GoodsWorkingProcedureForm();
        $working->id = $id;
        $result = $working->del();

        return $this->returnApi($result['code'],$result['msg']);
    }

}