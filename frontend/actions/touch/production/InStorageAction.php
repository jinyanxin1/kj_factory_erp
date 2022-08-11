<?php
/**
 *
 * author: jinyanxin
 * Date: 2020/11/18
 * Time: 10:44
 * PHP version 7
 */

namespace frontend\actions\touch\production;


use common\library\helper\Code;
use common\models\BaseModel;
use common\models\staffInfo\StaffInfoModel;
use common\models\workRecord\WorkRecordForm;
use common\models\workRecord\WorkRecordModel;
use frontend\actions\BaseAction;

class InStorageAction extends BaseAction
{

    public function run()
    {
        $staffId = intval($this->request()->post('staffId'));
        $staff = StaffInfoModel::find()->select('staffId,name')->where(['staffId'=>$staffId,'isValid'=>StaffInfoModel::IS_VALID_OK])->asArray()->one();
        if(empty($staff)){
            return $this->returnApi(Code::PARAM_ERR,'职工不存在');
        }
        $date = $this->request()->post('date');//日期
        $goodsData = $this->request()->post('goodsData');
        $type = intval($this->request()->post('type'));
        $amount = $this->request()->post('amount');
        $remark = $this->request()->post('remark');
        $goodsId = intval($this->request()->post('goodsId'));
        $date = empty($date) ? date('Y-m-d') : $date;
        $endDate = $this->request()->post('endDate');
        if(empty($date)){
            $date = date("Y-m-d");
        }

        $work = new WorkRecordForm();
        $work->loginUserName = $this->loginUserName;
        $work->date = $date;
        $work->staffId = $staffId;
        $work->loginUserName = $this->loginUserName;
        $work->goodsData = $goodsData;
        $work->goodsId = $goodsId;
        $work->type = $type;
        $work->amount = $amount;
        $work->remark = $remark;
        $work->endDate = $endDate;
        $work->id = 0;
        $work->personData = [
            $staffId
        ];
        if($type === WorkRecordModel::TYPE_TIME){
            $staff = StaffInfoModel::find()->where(['staffId'=>$staffId,'isValid'=>StaffInfoModel::IS_VALID_OK])->asArray()->one();
            if(empty($staff)){
                return $this->returnApi(Code::PARAM_ERR,'职工不存在');
            }
            $work->price = BaseModel::amountToYuan($staff['wages']);
        }
        $result = $work->saveInStorage();

        return $this->returnApi($result['code'],$result['msg']);

    }

}