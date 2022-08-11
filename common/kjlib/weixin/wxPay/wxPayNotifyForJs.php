<?php
namespace common\kjlib\weixin\wxPay;
/**
 * Created by PhpStorm.
 * User: huanghong
 * Date: 2018/2/3
 * Time: 9:04
 */
use common\library\helper\wxPay\lib\WxPayApi;
use common\library\helper\wxPay\lib\WxPayOrderQuery;

require_once "lib/WxPay.Config.php";
require_once "lib/WxPay.Api.php";
require_once "lib/WxPay.Data.php";
require_once "lib/WxPay.Exception.php";
require_once "lib/WxPay.Notify.php";


class wxPayNotifyForJs extends \WxPayNotify{

    //查询订单
    public function Queryorder($transaction_id)
    {
        $input = new WxPayOrderQuery();
        $input->SetTransaction_id($transaction_id);
        $result = WxPayApi::orderQuery($input);
        \Yii::trace("query:" . json_encode($result));
        if(array_key_exists("return_code", $result)
            && array_key_exists("result_code", $result)
            && $result["return_code"] == "SUCCESS"
            && $result["result_code"] == "SUCCESS")
        {
            return true;
        }
        return false;
    }

    //重写回调处理函数
    public function NotifyProcess($data, &$msg)
    {
        \Yii::trace("开始处理回调");
        \Yii::trace("call back:" . json_encode($data));

        if(!array_key_exists("transaction_id", $data)){
            $msg = "输入参数不正确";
            return false;
        }
        //查询订单，判断订单真实性
        if(!$this->Queryorder($data["transaction_id"])){
            $msg = "订单查询失败";
            return false;
        }
        if(array_key_exists("out_trade_no",$data)){
            $outTradeNo = $data['out_trade_no'];//得到商户订单号
            $transactionId = $data['transaction_id'];//得到微信订单号
            $payInfo = Consul::findOne(array('payNumBackend'=>$outTradeNo,'disabled'=>ConsultPay::DEL_NO));
            if(empty($payInfo)){
                Yii::info($outTradeNo.'支付信息未找到');
                return false;
            }
            //得到支付金额
            $totalFee = intval($data['total_fee']);
            //得到支付信息中的金额
            $payInfoFee = $payInfo->payAmount + $payInfo->extralFee;
            if($totalFee !== $payInfoFee){
                Yii::info($outTradeNo.'实际支付金额与记录金额有差异');
                return false;
            }
            //更细订单信息
            $payInfo->payNumInterface = $transactionId;
            $payInfo->isDone = ConsultPay::PAY_DONE;
            $payInfo->updateTime = date('Y-m-d H:i:s');
            try{
                $payInfo->save();
            }catch (\yii\db\Exception $e){
                Yii::info($outTradeNo.'支付信息更新失败');
                return false;
            }
        }
        Yii::trace("回调处理结束");
        return true;
    }

}
