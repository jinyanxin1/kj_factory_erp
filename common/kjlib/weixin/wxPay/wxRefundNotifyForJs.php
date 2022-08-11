<?php
/**
 * Created by PhpStorm.
 * User: huanghong
 * Date: 2018/2/8
 * Time: 10:21
 */
namespace common\kjlib\weixin\wxPay;

use Yii;
require_once "lib/WxPay.Config.php";
require_once "lib/WxPay.Api.php";
require_once "lib/WxPay.Data.php";
require_once "lib/WxPay.Exception.php";
require_once "lib/WxPay.Notify.php";
require_once "JsApiPay.php";

class wxRefundNotifyForJs{

    public function refundQuery($transactionId = null , $outTradeNo = null , $outRefundNo = null , $refundId = null){
        Yii::info('查询退款订单开始');
        if(empty($transactionId) && empty($outTradeNo) && empty($outRefundNo) && empty($refundId)){
            Yii::info('查询退款订单必要参数不存在');
            return false;
        }
        $refundQueryInput = new \WxPayRefundQuery();
        if(!empty($transactionId)){//根据交易Id查询
            $refundQueryInput->SetTransaction_id($transactionId);
        }
        if(!empty($outTradeNo)){//根据商户订单号查询
            $refundQueryInput->SetOut_trade_no($outTradeNo);
        }
        if(!empty($outRefundNo)){//根据商户退款单号
            $refundQueryInput->SetOut_refund_no($outRefundNo);
        }
        if(!empty($refundId)){//根据微信退款单号
            $refundQueryInput->SetRefund_id($refundId);
        }
        try{
            $result = \WxPayApi::refundQuery($refundQueryInput);
        }catch (\yii\base\Exception $e){
            Yii::info($e->getMessage());
            return false;
        }
        Yii::info('查询退款订单完成');
        return $result;
    }

} 