<?php
/**
 *
 * author: jinyanxin
 * Date: 2021/7/27
 * Time: 13:52
 * PHP version 7
 */

namespace backend\actions\goods\working;


use backend\actions\BaseAction;
use common\models\workingProcedure\GoodsWorkingProcedureForm;

class SaveAction extends BaseAction
{

    public function run()
    {
        $postData = $this->request()->post();

        $working = new GoodsWorkingProcedureForm();
        $working->attributes = $postData;
        $result = $working->saveInfo();

        return $this->returnApi($result['code'],$result['msg']);
    }

}