<?php
/**
 * @Author: jinyanxin
 * @Date: 2020/2/6
 * @Time: 9:44
 */


namespace backend\actions\purchase\store;


use backend\actions\BaseAction;
use common\models\purchase\StockRecordForm;

class DelStoreManageAction extends BaseAction
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