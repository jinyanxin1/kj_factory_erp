<?php
/**
 * @Author: jinyanxin
 * @Date: 2020/2/5
 * @Time: 10:22
 * 进出库管理详情
 */


namespace frontend\actions\purchase\store;


use frontend\actions\WxAction;
use frontend\models\purchase\stock\StockRecordForm;
use common\library\helper\Code;

class StoreManageDetailAction extends WxAction
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