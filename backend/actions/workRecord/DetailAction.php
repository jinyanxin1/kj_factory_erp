<?php
/**
 *
 * author: jinyanxin
 * Date: 2021/7/27
 * Time: 17:07
 * PHP version 7
 */

namespace backend\actions\workRecord;


use backend\actions\BaseAction;
use common\library\helper\Code;
use common\models\workRecord\WorkRecordForm;

class DetailAction extends BaseAction
{

    public function run()
    {
        $id = intval($this->request()->post('id'));

        $work = new WorkRecordForm();
        $work->id = $id;
        $info = $work->getInfo();

        return $this->returnApi(Code::SUCCESS,'ok',['info'=>$info]);
    }

}