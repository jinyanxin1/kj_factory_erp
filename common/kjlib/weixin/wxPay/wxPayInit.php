<?php
/**
 * Created by PhpStorm.
 * User: huanghong
 * Date: 2018/2/8
 * Time: 14:09
 */
namespace common\kjlib\weixin\wxPay;
use yii\base\Component;

use common\library\helper\wxPay\lib\WxPayApi ;
use common\library\helper\wxPay\lib\WxPayConfig ;
use common\library\helper\wxPay\lib\WxPayException ;
use common\library\helper\wxPay\lib\WxPayData ;
use common\library\helper\wxPay\lib\WxPayNotify ;
use common\models\stationConfig\StationConfigModel;

require_once "lib/WxPay.Config.php";
require_once "lib/WxPay.Api.php";
require_once "lib/WxPay.Data.php";
require_once "lib/WxPay.Exception.php";
require_once "lib/WxPay.Notify.php";

class wxPayInit extends Component{

    public $appId; //绑定支付的APPID（必须配置，开户邮件中可查看）
    public $mchId; //商户号（必须配置，开户邮件中可查看）
    public $appKey; //商户支付密钥，参考开户邮件设置（必须配置，登录商户平台自行设置）
    public $appSecret; //公众帐号secert（仅JSAPI支付的时候需要配置， 登录公众平台，进入开发者中心可设置），

    public static $instance = null;
    
    /**
     * Notes:初始化参数
     * User: huanghong
     */
    public function init(){
        parent::init();
        //初始化参数
//         \WxPayConfig::$APPID = $this->appId;
//         \WxPayConfig::$MCHID = $this->mchId;
//         \WxPayConfig::$KEY = $this->appKey;
//         \WxPayConfig::$APPSECRET = $this->appSecret;
//         \WxPayConfig::$SSLCERT_PATH = \Yii::$app->params['certPath'].'apiclient_cert.pem';
//         \WxPayConfig::$SSLKEY_PATH = \Yii::$app->params['certPath'].'apiclient_key.pem';
        
    }

    /**
     * Notes:得到微信支付实例
     * User: huanghong
     * @return wxPayForJs
     */
    public function constructWxPay(){
        return new wxPayForJs();
    }

    /**
     * Notes:得到微信退款实例
     * User: huanghong
     * @return wxRefundForJs
     */
    public function constructWxRefund(){
        return new wxRefundForJs();
    }

    /**
     * Notes:得到微信退款查询实例
     * User: huanghong
     * @return wxRefundNotifyForJs
     */
    public function constructWxRefundQuery(){
        return new wxRefundNotifyForJs();
    }



} 