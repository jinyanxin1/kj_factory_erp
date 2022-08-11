<?php
/**
 *
 * author: jinyanxin
 * Date: 2020/9/4
 * Time: 10:36
 * PHP version 7
 */

namespace backend\actions\purchase\manage;


use backend\actions\BaseAction;
use backend\models\purchaseOrder\PurchaseOrderDetailForm;
use backend\models\purchaseOrder\PurchaseOrderForm;
use common\library\helper\Code;

class OrderInfoAction extends BaseAction
{

    public function run()
    {
        $id = intval($this->request()->post('id'));
        if($id <= 0){
            return $this->returnApi(Code::PARAM_ERR,'请选择详情');
        }
        $purchaseOrder = PurchaseOrderForm::find()->where(['id'=>$id,'isValid'=>PurchaseOrderForm::IS_VALID_OK])->asArray()->one();
        if(empty($purchaseOrder)){
            return $this->returnApi(Code::PARAM_ERR,'订单不存在');
        }
        $detailList = [];
        $orderDetail = PurchaseOrderDetailForm::find()->where(['orderId'=>$id,'isValid'=>PurchaseOrderDetailForm::IS_VALID_OK])->asArray()->all();
        if(count($orderDetail) > 0){
            foreach ($orderDetail as &$detail){
                $detail['price'] = PurchaseOrderDetailForm::amountToYuan(intval($detail['price']));
                $detail['totalPrice'] = PurchaseOrderDetailForm::amountToYuan(intval($detail['totalPrice']));
            }
            $detailList = $orderDetail;
        }
        $purchaseOrder['detailList'] = $detailList;
        $purchaseOrder['price'] = PurchaseOrderForm::amountToYuan(intval($purchaseOrder['price']));

        return $this->returnApi(Code::SUCCESS,'ok',['info'=>$purchaseOrder]);
    }


}