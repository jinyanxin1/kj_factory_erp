<?php
/**
 * User: cqj
 * Date: 2020/8/5
 * Time: 2:35 下午
 */

namespace backend\actions\staffInfo;


use backend\actions\BaseAction;
use common\models\staffInfo\StaffInfoForm;

class EntryAction extends BaseAction
{
    public function run() {
        $model = new StaffInfoForm() ;
        //TODO 具体情况接收参数
        $model->attributes = $this->request()->post() ;
        $model->staffId = $this->request()->post('staffId') ;
        $ret = $model->entry() ;
        return $this->returnApi($ret['code'], $ret['msg']) ;
    }
}