<?php
/**
 * Created by PhpStorm.
 * User: huanghong
 * Date: 2018/1/31
 * Time: 9:13
 */
namespace common\kjlib\weixin\wxPay;

use dosamigos\qrcode\formats\vCard;
use yii\base\Exception;
use yii\helpers\Json;

require_once "lib/WxPay.Config.php";
require_once "lib/WxPay.Api.php";
require_once "lib/WxPay.Data.php";
require_once "lib/WxPay.Exception.php";
require_once "lib/WxPay.Notify.php";
require_once "JsApiPay.php";


class wxPayForJs{

    /**
     * Notes:生成订单信息
     * User: huanghong
     * @param string $openId
     * @param string $body
     * @param string $attach
     * @param string $outTradeNo
     * @param $totalFee
     * @param string $goodsTag
     * @param string $notifyUrl
     * @return array
     * @throws WxPayException
     */
    public function payParameterConstruct($openId,$outTradeNo,$totalFee,$body,$notifyUrl,$attach = '',$goodsTag= ''){
        
        \Yii::warning('开始生成订单','pay');

        $tools = new \JsApiPay();
        if(empty($openId)){
            \Yii::warning('openId获取失败','pay');
            return array('code'=>-1,'msg'=>'openId获取失败');
        }
        //设置下单参数
        $orderInput = new \WxPayUnifiedOrder();
        if(!empty($body)){//获取商品或支付单简要描述的值
            $orderInput->SetBody($body);
        }
        if(!empty($attach)){//设置附加数据，在查询API和支付通知中原样返回，该字段主要用于商户携带订单的自定义数据
            $orderInput->SetAttach($attach);
        }
        if(!empty($goodsTag)){//获取商品标记，代金券或立减优惠功能的参数，说明详见代金券或立减优惠的值
            $orderInput->SetGoods_tag($goodsTag);
        }
        if(!empty($notifyUrl)){//设置接收微信支付异步通知回调地址
            \Yii::warning('设置接收微信支付异步通知回调地址:'.$notifyUrl,'pay');
            $orderInput->SetNotify_url($notifyUrl);
        }
        $orderInput->SetOpenid($openId);//用户在商户appid下的唯一标识
        if(empty($outTradeNo)){
            
            \Yii::warning('商户系统内部订单号生成失败','pay');
            return array('code'=>-1,'msg'=>'商户系统内部订单号生成失败');
        }
//        $outTradeNo = \WxPayConfig::$MCHID.$outTradeNo;
        $orderInput->SetOut_trade_no($outTradeNo);//设置商户系统内部的订单号
        if(empty($totalFee)){//设置支付金额，单位为分
            \Yii::warning('支付金额未提供','pay');
            return array('code'=>-1,'msg'=>$outTradeNo.'支付金额未提供');
        }else{
            $orderInput->SetTotal_fee($totalFee);
        }
        $orderInput->SetTime_start(date("YmdHis"));//设置订单生成时间
        $orderInput->SetTime_expire(date("YmdHis", time() + 600));//设置订单过期时间
        $orderInput->SetTrade_type("JSAPI");//设置支付渠道为JSAPI

        $order = \WxPayApi::unifiedOrder($orderInput);//生成订单信息
        \Yii::warning('zhifu-get-order-info'.print_r(Json::encode($order),true),'pay');

        if( $order['code'] == 0 ){
            $orderParameters = $tools->GetJsApiParameters($order['params']);
            if( $orderParameters === false ){
                \Yii::warning('get-jsapipay-fail(调取接口错误)','pay');
                return false;
            }
            \Yii::warning('生成订单结束','pay');
            return array('code'=>0 ,'orderParameters'=>$orderParameters);
        }else{
            \Yii::warning('get-jsapipay-fail(调取接口错误)','pay');
            return false;
        }

    }

    /**
     * Notes:获取共享收货地址js函数需要的参数
     * User: huanghong
     * @return 获取共享收货地址js函数需要的参数
     */
    public function generateEditAddress(){

        $tools = new \JsApiPay();
        //获取共享收货地址js函数参数
        $editAddress = $tools->GetEditAddressParameters();
        return $editAddress;
    }

} 