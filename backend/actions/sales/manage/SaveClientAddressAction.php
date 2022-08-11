<?php
/**
 *
 * author: jinyanxin
 * Date: 2020/12/28
 * Time: 9:30
 * PHP version 7
 */

namespace backend\actions\sales\manage;


use backend\actions\BaseAction;
use common\library\helper\Code;
use common\models\salesOrder\SalesOrderModel;

class SaveClientAddressAction extends BaseAction
{

    public function run()
    {
        $orderId = intval($this->request()->post('orderId'));
        $clientAddress = $this->request()->post('clientAddress');
        if($orderId <= 0){
            return $this->returnApi(Code::PARAM_ERR,'请选择订单');
        }
        if(mb_strlen($clientAddress,'utf8') > 200){
            return $this->returnApi(Code::PARAM_ERR,'地址过长');
        }
        $orderInfo = SalesOrderModel::find()->where(['id'=>$orderId,'isValid'=>SalesOrderModel::IS_VALID_OK])->one();
        if(empty($orderInfo)){
            return $this->returnApi(Code::PARAM_ERR,'打印订单不存在');
        }
        $orderInfo->clientAddress = $clientAddress;
        if(!$orderInfo->save()){
            return $this->returnApi(Code::PARAM_ERR,'保存失败');
        }
        return $this->returnApi(Code::SUCCESS,'保存成功');
    }

}