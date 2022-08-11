<?php
/**
 * Created by PhpStorm.
 * User: 靳闫鑫
 * Date: 2018/3/15 0015
 * Time: 上午 11:27
 */

namespace common\kjlib\weixinEnterprisePayment;


use common\kjlib\weixin\wxPay\wxPayForJs;
use common\kjlib\weixin\wxPay\wxPayInit;
use common\kjlib\weixin\wxPay\wxRefundForJs;
use Yii;


class wxEnterprisePayment extends wxPayInit
{
    public $appId;
    public $appSecret;
    public $mchId; //商户号（必须配置，开户邮件中可查看）
    public $appKey; //商户支付密钥，参考开户邮件设置（必须配置，登录商户平台自行设置）
    public $ip='';


    public static $instance = null;

    /**
     * Notes:初始化参数
     * User: huanghong
     */
    public function init(){
        parent::init();
        //初始化参数
        \WxPayConfig::$APPID = $this->appId;
        \WxPayConfig::$MCHID = $this->mchId;
        \WxPayConfig::$KEY = $this->appKey;
        \WxPayConfig::$APPSECRET = $this->appSecret;
        //退款需要使用的证书
        \WxPayConfig::$SSLCERT_PATH = \Yii::$app->params['epcertPath'].'apiclient_cert.pem';
        
        \WxPayConfig::$SSLKEY_PATH = \Yii::$app->params['epcertPath'].'apiclient_key.pem';
    }
    
    
    
    /**
     * [sendMoney 企业付款到零钱]
     * @param  integer $amount     [发送的金额（分）目前发送金额不能少于1元]
     * @param  string $re_openid  [发送人的 openid]
     * @param  string $desc       [企业付款描述信息 (必填)]
     * @param  string $check_name [收款用户姓名 (选填)]
     * @return string             [description]
     */
    function sendMoney($amount,$re_openid,$desc='测试',$check_name=''){
        $total_amount = (100) * $amount;
        Yii::info('实际打款*100:'.$total_amount);
       
        $data=array(
            'mch_appid'=>$this->appId,//商户账号appid
            'mchid'=>$this->mchId,//商户号
            'nonce_str'=>$this->createNoncestr(),//随机字符串
            'partner_trade_no'=> date('YmdHis').rand(1000, 9999),//商户订单号
            'openid'=> $re_openid,//用户openid
            'check_name'=>'NO_CHECK',//校验用户姓名选项,
            're_user_name'=> $check_name,//收款用户姓名
            'amount'=>$total_amount,//金额
            'desc'=> $desc,//企业付款描述信息
            'spbill_create_ip'=> \Yii::$app->request->userIP,//Ip地址
        );
        Yii::info('打款信息:'.json_encode($data,true));

        //生成签名算法
        $secrect_key=$this->appKey;///这个就是个API密码。MD5 32位。
        $data=array_filter($data);
        ksort($data);
        $str='';
        foreach($data as $k=>$v) {
            $str.=$k.'='.$v.'&';
        }
        $str.='key='.$secrect_key;
        $data['sign']=md5($str);
        //生成签名算法
        
        
        $xml=$this->arraytoxml($data);
        
        $url='https://api.mch.weixin.qq.com/mmpaymkttransfers/promotion/transfers'; //调用接口
        $res=$this->curl_post_ssl($url,$xml);
        $return=$this->xmltoarray($res);
        return  $return;
        
        //print_r($return);
        //返回来的结果是xml，最后转换成数组
        /*
         array(9) {
         ["return_code"]=>
         string(7) "SUCCESS"
         ["return_msg"]=>
         array(0) {
         }
         ["mch_appid"]=>
         string(18) "wx57676786465544b2a5"
         ["mchid"]=>
         string(10) "143345612"
         ["nonce_str"]=>
         string(32) "iw6TtHdOySMAfS81qcnqXojwUMn8l8mY"
         ["result_code"]=>
         string(7) "SUCCESS"
         ["partner_trade_no"]=>
         string(18) "201807011410504098"
         ["payment_no"]=>
         string(28) "1000018301201807019357038738"
         ["payment_time"]=>
         string(19) "2018-07-01 14:56:35"
         }
         */
        
        
        //         $responseObj = simplexml_load_string($res, 'SimpleXMLElement', LIBXML_NOCDATA);
        //         echo $res= $responseObj->return_code;  //SUCCESS  如果返回来SUCCESS,则发生成功，处理自己的逻辑
        //         return $res;
    }
    
    
    /**
     * [xmltoarray xml格式转换为数组]
     * @param  string $xml [xml]
     * @return array      [xml 转化为array]
     */
    function xmltoarray($xml) {
        //禁止引用外部xml实体
        libxml_disable_entity_loader(true);
        $xmlstring = simplexml_load_string($xml, 'SimpleXMLElement', LIBXML_NOCDATA);
        $val = json_decode(json_encode($xmlstring),true);
        return $val;
    }
    
    /**
     * [arraytoxml 将数组转换成xml格式（简单方法）:]
     * @param  array $data [数组]
     * @return string [array 转 xml]
     */
    function arraytoxml($data){
        $str='<xml>';
        foreach($data as $k=>$v) {
            $str.='<'.$k.'>'.$v.'</'.$k.'>';
        }
        $str.='</xml>';
        return $str;
    }
    
    /**
     * [createNoncestr 生成随机字符串]
     * @param  integer $length [长度]
     * @return string  [字母大小写加数字]
     */
    function createNoncestr($length =32){
        $chars = "ABCDEFGHIJKLMNOPQRSTUVWXYabcdefghijklmnopqrstuvwxyz0123456789";
        $str ="";
        
        for($i=0;$i<$length;$i++){
            $str.= substr($chars, mt_rand(0, strlen($chars)-1), 1);
        }
        return $str;
    }
    
    /**
     * [curl_post_ssl 发送curl_post数据]
     * @param  string  $url     [发送地址]
     * @param  string  $xmldata [发送文件格式]
     * @param  integer  $second [设置执行最长秒数]
     * @param  string  $aHeader [设置头部]
     * @return string  [description]
     */
    function curl_post_ssl($url, $xmldata, $second = 30, $aHeader = array()){
        $isdir = \Yii::$app->params['epcertPath'].'/';//证书位置;绝对路径
        Yii::info('打款证书:'.$isdir);
        
        $ch = curl_init();//初始化curl
        
        curl_setopt($ch, CURLOPT_TIMEOUT, $second);//设置执行最长秒数
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);//要求结果为字符串且输出到屏幕上
        curl_setopt($ch, CURLOPT_URL, $url);//抓取指定网页
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);// 终止从服务端进行验证
        curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, false);//
        curl_setopt($ch, CURLOPT_SSLCERTTYPE, 'PEM');//证书类型
        curl_setopt($ch, CURLOPT_SSLCERT, $isdir . 'apiclient_cert.pem');//证书位置
        curl_setopt($ch, CURLOPT_SSLKEYTYPE, 'PEM');//CURLOPT_SSLKEY中规定的私钥的加密类型
        curl_setopt($ch, CURLOPT_SSLKEY, $isdir . 'apiclient_key.pem');//证书位置
        curl_setopt($ch, CURLOPT_CAINFO, 'PEM');
        curl_setopt($ch, CURLOPT_CAINFO, $isdir . 'rootca.pem');
        if (count($aHeader) >= 1) {
            curl_setopt($ch, CURLOPT_HTTPHEADER, $aHeader);//设置头部
        }
        curl_setopt($ch, CURLOPT_POST, 1);//post提交方式
        curl_setopt($ch, CURLOPT_POSTFIELDS, $xmldata);//全部数据使用HTTP协议中的"POST"操作来发送
        
        $data = curl_exec($ch);//执行回话
        if ($data) {
            curl_close($ch);
            return $data;
        } else {
            $error = curl_errno($ch);
            echo "call faild, errorCode:$error\n";
            curl_close($ch);
            return false;
        }
    }

    
}