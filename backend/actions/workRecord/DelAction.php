<?php
/**
 *
 * author: jinyanxin
 * Date: 2021/7/27
 * Time: 17:08
 * PHP version 7
 */

namespace backend\actions\workRecord;


use backend\actions\BaseAction;
use common\models\workRecord\WorkRecordForm;

class DelAction extends BaseAction
{

    public function run()
    {
        $id = intval($this->request()->post('id'));

        $work = new WorkRecordForm();
        $work->id = $id;
        $result = $work->del();

        return $this->returnApi($result['code'],$result['msg']);
    }

}