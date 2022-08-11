<?php
/**
 * @Author: jinyanxin
 * @Date: 2020/2/6
 * @Time: 9:44
 */


namespace frontend\actions\purchase\store;


use frontend\actions\WxAction;
use frontend\models\purchase\stock\StockRecordForm;

class DelStoreManageAction extends WxAction
{

    public function run()
    {
        $id = intval($this->request()->post('id'));
        $type = intval($this->request()->post('type'));

        $stock = new StockRecordForm();
        $stock->primaryId = $id;
        $stock->type = $type;

        $return = $stock->del();

        return $this->returnApi($return['code'],$return['msg']);

    }

}