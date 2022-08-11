<?php
/**
 * User: cqj
 * Date: 2020/7/15
 * Time: 9:18 上午
 */

namespace frontend\actions\clientInfo;


use frontend\actions\WxAction;
use common\models\clientInfo\ClientInfoForm;

class ShiftAction extends WxAction
{
    public function run() {
        $model = new ClientInfoForm() ;
        //TODO 具体情况接收参数
        $model->attributes = $this->request()->post() ;
        $model->clientId = $this->request()->post('clientId') ;
        $model->staffId = $this->request()->post('staffId') ;
        $ret = $model->shift() ;
        return $this->returnApi($ret['code'], $ret['msg']) ;
    }
}