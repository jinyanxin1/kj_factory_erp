<?php
/**
 *
 * author: jinyanxin
 * Date: 2020/11/26
 * Time: 14:38
 * PHP version 7
 */

namespace frontend\actions\sales\manage;


use common\library\helper\Code;
use common\models\salesOrder\SalesOrderForm;
use frontend\actions\BaseAction;

class InfoAction extends BaseAction
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