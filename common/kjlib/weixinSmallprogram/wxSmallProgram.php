<?php
/**
 * Created by PhpStorm.
 * User: 靳闫鑫
 * Date: 2018/3/15 0015
 * Time: 上午 11:27
 */

namespace common\kjlib\weixinSmallprogram;


use common\kjlib\weixin\wxPay\wxPayForJs;
use common\kjlib\weixin\wxPay\wxPayInit;
use common\kjlib\weixin\wxPay\wxRefundForJs;

//use common\models\stationConfig\StationConfigModel;


class wxSmallProgram extends wxPayInit
{
    public $appId;
    public $appSecret;
    public $mchId; //商户号（必须配置，开户邮件中可查看）
    public $appKey; //商户支付密钥，参考开户邮件设置（必须配置，登录商户平台自行设置）


    public static $instance = null;

    /**
     * Notes:初始化参数
     * User: huanghong
     */
    public function init(){
        parent::init();
        
//         $schoolId=\Yii::$app->user->getIsGuest() ? 0 : \Yii::$app->user->identity['schoolId'];
//         $stationInfo=StationConfigModel::schoolIdByschoolId($schoolId);
        
//         $this->appId=$stationInfo['smallAppId']; //绑定支付的APPID（必须配置，开户邮件中可查看）
        
//         $this->mchId=$stationInfo['mchId']; //商户号（必须配置，开户邮件中可查看）
//         $this->appKey=$stationInfo['mchSecret']; //商户支付密钥，参考开户邮件设置（必须配置，登录商户平台自行设置）
//         $this->appSecret=$stationInfo['smallAppSecret'];
//         //初始化参数
//         \WxPayConfig::$APPID = $this->appId;
//         \WxPayConfig::$MCHID = $this->mchId;
//         \WxPayConfig::$KEY = $this->appKey;
//         \WxPayConfig::$APPSECRET = $this->appSecret;
//         //退款需要使用的证书
//         \WxPayConfig::$SSLCERT_PATH = \Yii::$app->params['certPath'].'apiclient_cert.pem';
//         \WxPayConfig::$SSLKEY_PATH = \Yii::$app->params['certPath'].'apiclient_key.pem';
    }



    /*
     * 根据code获取openid和sessionKey
     * */
    public function getOpenIdByCode($code)
    {
        $url = sprintf(
            'https://api.weixin.qq.com/sns/jscode2session?appid=%s&secret=%s&js_code=%s&grant_type=authorization_code',
            $this->appId, $this->appSecret, $code);
        $result = file_get_contents($url);
        $data = json_decode($result);
        \Yii::info('getOpenIdByCode(调用微信接口根据code获取openid)-data'.json_encode($data));
        if( !empty($data->errmsg) ){
            \Yii::info('fail-getOpenIdByCode(调用微信接口根据code获取openid失败)-msg'.$data->errmsg);
            $openId = false;
            $sessionKey = false;
            $unionId = '';
        }else{
            $openId = $data->openid;
            $sessionKey = $data->session_key;
            if( property_exists($data,'unionid') ){
                $unionId = $data->unionid;
            }else{
                $unionId = '';
            }

        }
        return array(
            'openId'=>$openId,
            'sessionKey'=>$sessionKey,
            'unionId'=>$unionId,
        );
    }
    /**
     * Notes:得到微信支付实例
     * @return wxPayForJs
     */
    public function constructWxPay(){
                $schoolId=\Yii::$app->user->getIsGuest() ? 0 : \Yii::$app->user->identity['schoolId'];
                $stationInfo=StationConfigModel::schoolIdByschoolId($schoolId);
        
                //初始化参数
                \WxPayConfig::$APPID = $stationInfo['smallAppId'];
                \WxPayConfig::$MCHID = $stationInfo['mchId'];
                \WxPayConfig::$KEY =$stationInfo['mchSecret'];
                \WxPayConfig::$APPSECRET = $stationInfo['smallAppSecret'];
                //退款需要使用的证书
                \WxPayConfig::$SSLCERT_PATH = \Yii::$app->params['certPath'].'apiclient_cert.pem';
                \WxPayConfig::$SSLKEY_PATH = \Yii::$app->params['certPath'].'apiclient_key.pem';
        return new wxPayForJs();
    }


    /*
     *支付结果再通知回调
     * */
    public function payCallBack()
    {
        \Yii::warning('start-pay-success-call-back(调用回调方法)','pay');
        $notify = new wxSmallProgramPayCallBack();
        $notify->Handle(false);
    }

    public function constructWxRefund(){
        return new wxRefundForJs();
    }
}