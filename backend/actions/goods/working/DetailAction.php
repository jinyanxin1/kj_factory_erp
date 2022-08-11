<?php
/**
 *
 * author: jinyanxin
 * Date: 2021/7/27
 * Time: 15:24
 * PHP version 7
 */

namespace backend\actions\goods\working;


use backend\actions\BaseAction;
use common\library\helper\Code;
use common\models\workingProcedure\GoodsWorkingProcedureForm;

class DetailAction extends BaseAction
{

    public function run()
    {
        $id = intval($this->request()->post('id'));

        $working = new GoodsWorkingProcedureForm();
        $working->id = $id;
        $info = $working->getInfo();

        return $this->returnApi(Code::SUCCESS,'ok',['info'=>$info]);
    }

}