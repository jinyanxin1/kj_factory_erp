<?php
/**
 * Created by PhpStorm.
 * User: huanghong
 * Date: 2018/2/8
 * Time: 10:20
 */
namespace common\kjlib\weixin\wxPay;

use Yii;
use yii\helpers\Json;

require_once "lib/WxPay.Config.php";
require_once "lib/WxPay.Api.php";
require_once "lib/WxPay.Data.php";
require_once "lib/WxPay.Exception.php";
require_once "lib/WxPay.Notify.php";
require_once "JsApiPay.php";

class wxRefundForJs{

    /**
     * Notes:退款
     * User: huanghong
     * @param null $transactionId
     * @param null $outTradeNo
     * @param $totalFee
     * @param $refundFee
     * @return 成功时返回
     * @throws WxPayException
     */
    public function refundParameterConstruct($refundFee , $totalFee , $transactionId = null , $outTradeNo = null){
        Yii::info('start-return-pay开始生成退款');
        if(empty($transactionId) && empty($outTradeNo)){
            Yii::info('退款接口必要参数缺少,交易Id,商户交易Id');
            return false;
        }
        if(!is_numeric($totalFee) || !is_numeric($refundFee)){
            Yii::info('退款金额参数异常');
            return false;
        }
        $refundInput = new \WxPayRefund();
        if(!empty($transactionId)){
            $refundInput->SetTransaction_id($transactionId);
            $refundInput->SetTotal_fee($totalFee);
            $refundInput->SetRefund_fee($refundFee);
            $refundInput->SetOut_refund_no(\WxPayConfig::$MCHID.date('YmdHis'));
        }else{
            if(!empty($outTradeNo)){
                $refundInput->SetOut_trade_no($outTradeNo);
                $refundInput->SetTotal_fee($totalFee);
                $refundInput->SetRefund_fee($refundFee);
                $refundInput->SetOut_refund_no(\WxPayConfig::$MCHID.date('YmdHis'));
            }
        }
        Yii::info('return-val(退款时，请求接口的参数)'. Json::encode($refundInput,true));
        try {
            $result = \WxPayApi::refund($refundInput);
            Yii::info('return-moeny(申请退款调用接口后返回参数)'.print_r($result,true));
        }catch (\yii\base\Exception $e){
            Yii::info($e->getMessage());
            return false;
        }
        Yii::info('申请退款完成');
        return $result;
    }
} 