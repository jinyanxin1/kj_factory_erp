<?php
/**
 * User: cqj
 * Date: 2020/8/5
 * Time: 2:54 下午
 */

namespace backend\actions\supplierInfo;


use backend\actions\BaseAction;
use common\models\supplierInfo\SupplierInfoForm;

class ShiftAction extends BaseAction
{
    public function run() {
        $model = new SupplierInfoForm() ;
        //TODO 具体情况接收参数
        $model->attributes = $this->request()->post() ;
        $model->supplierId = $this->request()->post('supplierId') ;
        $model->staffId = $this->request()->post('staffId') ;
        $ret = $model->shift() ;
        return $this->returnApi($ret['code'], $ret['msg']) ;
    }
}