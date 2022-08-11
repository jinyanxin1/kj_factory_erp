<?php
/**
 *
 * author: jinyanxin
 * Date: 2021/7/27
 * Time: 16:59
 * PHP version 7
 */

namespace backend\actions\workRecord;


use backend\actions\BaseAction;
use common\models\workRecord\WorkRecordForm;

class SaveAction extends BaseAction
{

    public function run()
    {
        $id = intval($this->request()->post('id'));
        $type = intval($this->request()->post('type'));
        $staffId = intval($this->request()->post('staffId'));
        $goodsId = intval($this->request()->post('goodsId'));
        $workingId = intval($this->request()->post('workingId'));
        $amount = $this->request()->post('amount');
        $price = $this->request()->post('price');
        $remark = $this->request()->post('remark');
        $date = $this->request()->post('date');
        $endDate = $this->request()->post('endDate');
        $personData = $this->request()->post('personData');
        $work = new WorkRecordForm();
        $work->id = $id;
        $work->goodsData = [
            [
                'id'=>$id,
                'goodsId'=>$goodsId,
                'workingId'=>$workingId,
                'remark'=>$remark,
                'price'=>$price,
                'amount'=>$amount,
            ]
        ];
        $work->goodsId = $goodsId;
        $work->type = $type;
        $work->staffId = $staffId;
        $work->date = $date;
        $work->endDate = $endDate;
        $work->amount = $amount;
        $work->remark = $remark;
        $work->price = $price;
        $work->personData = $personData;
        $work->loginUserName = $this->loginUserName;
        $result = $work->saveInStorage();

        return $this->returnApi($result['code'],$result['msg']);
    }

}