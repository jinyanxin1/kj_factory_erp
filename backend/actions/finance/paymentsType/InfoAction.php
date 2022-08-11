<?php
/**
 *
 * author: jinyanxin
 * Date: 2020/9/9
 * Time: 10:11
 * PHP version 7
 */

namespace backend\actions\finance\paymentsType;


use backend\actions\BaseAction;
use backend\models\finance\PaymentsTypeForm;
use common\library\helper\Code;

class InfoAction extends BaseAction
{

    /*
     * 详情
     * */
    public function run()
    {
        $id = intval($this->request()->post('id',1));
        if($id <= 0){
            return $this->returnApi(Code::PARAM_ERR,'请选择数据');
        }
        $info = PaymentsTypeForm::getById($id,true);
        if(empty($info)){
            return $this->returnApi(Code::PARAM_ERR,'详情不存在');
        }
        return $this->returnApi(Code::SUCCESS,'ok',['info'=>$info]);
    }

}