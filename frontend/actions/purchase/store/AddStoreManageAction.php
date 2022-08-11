<?php
/**
 * @Author: jinyanxin
 * @Date: 2020/2/5
 * @Time: 10:40
 */


namespace frontend\actions\purchase\store;


use frontend\actions\WxAction;
use frontend\models\purchase\stock\StockRecordForm;


class AddStoreManageAction extends WxAction
{

    public function run()
    {
        $addList = $this->request()->post('list');
        $type = intval($this->request()->post('type'));
        $houseId = $this->request()->post('houseId');
        $remark = $this->request()->post('remark');
        $date = $this->request()->post('date');
        $userName = $this->request()->post('userName');
        $supplier = $this->request()->post('supplier');
        $purchaseId = intval($this->request()->post('id'));

        $outHouseId = intval($this->request()->post('outHouseId'));
        $inHouseId = intval($this->request()->post('inHouseId'));

        $borrowName = $this->request()->post('borrowName');//领用人

        $stockRecord = new StockRecordForm();
        $stockRecord->list = $addList;
        $stockRecord->type = $type;
        $stockRecord->houseId = $houseId;
        $stockRecord->remark = $remark;
        $stockRecord->recordUserName = $userName;
        $stockRecord->supplier = $supplier;
        $stockRecord->date = $date;
        $stockRecord->primaryId = $purchaseId;

        $stockRecord->outHouseId = $outHouseId;
        $stockRecord->inHouseId = $inHouseId;

        $stockRecord->borrowName = $borrowName;

        $saveData = $stockRecord->save();

        return $this->returnApi($saveData['code'],$saveData['msg']);

    }

}