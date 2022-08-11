<?php
/**
 *
 * author: jinyanxin
 * Date: 2020/9/15
 * Time: 10:54
 * PHP version 7
 */

namespace backend\actions\finance\account;


use backend\actions\BaseAction;
use backend\models\finance\PaymentsAccountForm;
use common\library\helper\Code;

class InfoAction extends BaseAction
{
    /*
     * 账户详情
     * */
    public function run()
    {
        $id = intval($this->request()->post('id',1));
        if($id <= 0){
            return $this->returnApi(Code::PARAM_ERR,'请选择数据');
        }
        $info = PaymentsAccountForm::getById($id,true);
        if(empty($info)){
            return $this->returnApi(Code::PARAM_ERR,'详情不存在');
        }
        $info['incomeAmount'] = PaymentsAccountForm::amountToYuan(intval($info['incomeAmount']));
        $info['expenditureAmount'] = PaymentsAccountForm::amountToYuan(intval($info['expenditureAmount']));
        return $this->returnApi(Code::SUCCESS,'ok',['info'=>$info]);
    }

}