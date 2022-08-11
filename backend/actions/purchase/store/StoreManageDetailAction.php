<?php
/**
 * @Author: jinyanxin
 * @Date: 2020/2/5
 * @Time: 10:22
 * 进出库管理详情
 */


namespace backend\actions\purchase\store;


use backend\actions\BaseAction;
use common\models\purchase\StockRecordForm;

class StoreManageDetailAction extends BaseAction
{

    public function run()
    {
        $type = intval($this->request()->post('type'));
        $id = intval($this->request()->post('id'));

        $stockRecord = new StockRecordForm();
        $stockRecord->primaryId = $id;
        $stockRecord->type = $type;

        $data = $stockRecord->getDetail();

        return $this->returnApi($data['code'],$data['msg'],$data['data']);

    }

}