<?php
/**
 * @Author: jinyanxin
 * @Date: 2020/2/5
 * @Time: 10:40
 */


namespace backend\actions\purchase\store;


use backend\actions\BaseAction;
use common\library\helper\Code;
use common\models\BaseModel;
use common\models\purchase\StockRecordForm;


class AddStoreManageAction extends BaseAction
{

    public function run()
    {
        $addList = $this->request()->post('list');
        $type = intval($this->request()->post('type'));
        $remark = $this->request()->post('remark');
        $date = $this->request()->post('date');
        $userName = $this->request()->post('userName');
        $supplier = $this->request()->post('supplierId');
        $purchaseId = intval($this->request()->post('id'));

        $clientId = intval($this->request()->post('clientId'));

        $outHouseId = intval($this->request()->post('outHouseId'));
        $inHouseId = intval($this->request()->post('inHouseId'));

        $borrowName = $this->request()->post('borrowName');//领用人

        $goodsType = intval($this->request()->post('goodsType'));
        if(empty($goodsType)){
            return $this->returnApi(Code::PARAM_ERR,'参数错误goodsType为空');
        }

        $houseId = BaseModel::HOUSE_ID;
        $stockRecord = new StockRecordForm();
        $stockRecord->clientId = $clientId;
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

        $stockRecord->goodsType = intval($goodsType);
        $saveData = $stockRecord->save();

        return $this->returnApi($saveData['code'],$saveData['msg']);

    }

}