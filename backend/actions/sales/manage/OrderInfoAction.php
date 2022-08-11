<?php
/**
 *
 * author: jinyanxin
 * Date: 2020/9/4
 * Time: 15:08
 * PHP version 7
 */

namespace backend\actions\sales\manage;


use backend\actions\BaseAction;
use common\library\helper\Code;
use common\models\goods\GoodsModel;
use common\models\salesOrder\SalesOrderDetailModel;
use common\models\salesOrder\SalesOrderForm;
use common\models\salesOrder\SalesOrderModel;

class OrderInfoAction extends BaseAction
{

    public function run()
    {
        $id = intval($this->request()->post('id'));
        if($id <= 0){
            return $this->returnApi(Code::PARAM_ERR,'请选择详情');
        }

        $salesOrder = new SalesOrderForm();
        $salesOrder->id = $id;
        $result = $salesOrder->getInfo();

        return $this->returnApi($result['code'],$result['msg'],['info'=>$result['info']]);
    }

}