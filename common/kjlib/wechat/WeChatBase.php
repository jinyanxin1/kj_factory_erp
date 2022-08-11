<?php
/**
 * Created by PhpStorm.
 * User: zhouk
 * Date: 2019/11/25
 * Time: 21:21
 */

namespace common\kjlib\wechat;


use common\library\helper\Curl;
use yii\base\Exception;
use yii\helpers\Json;

class WeChatBase
{
    protected $appId;
    protected $appSecret;
    protected $mchId;
    protected $mchSecret;

    const OPEN_ID_COOKIE_NAME = 'JXT_open_id';
    const CUSTOMER_ID_COOKIE_NAME = 'JXT_cem_customer';
    const WEIXIN_COOKIE_KEY = 'JXT!@#XinWei2016';

    protected  $uri = "https://api.weixin.qq.com/sns/oauth2/";
    const AUTH_URL = 'https://open.weixin.qq.com/connect/oauth2/authorize?appid=%s&redirect_uri=%s&response_type=%s&scope=%s&state=%s#wechat_redirect' ;
    const USER_INFO_URL = 'https://api.weixin.qq.com/sns/userinfo?access_token=%s&openid=%s&lang=zh_CN' ;


    public function __construct($appId, $appSecret, $mchId = '', $mchSecret = '')
    {
        $this->appId = $appId;
        $this->appSecret = $appSecret;
        $this->mchId = $mchId;
        $this->mchSecret = $mchSecret;
    }


    public function isLogin() {
        $openIdCookieName = self::OPEN_ID_COOKIE_NAME ;
        if(isset($_COOKIE[$openIdCookieName])&&!empty($_COOKIE[$openIdCookieName])) {
            return TRUE ;
        }  else {
            return false ;
        }

    }

    /**
     * 先执行的方法
     * @param $backUrl
     * @return bool
     * @throws Exception
     */
    public function WeixinInit($backUrl)
    {
        $redirectUrl = \Yii::$app->request->getHostInfo() . '/wap/wxauth/auth?appid='.$this->appId.'&back_url='.urlencode($backUrl) ;
        // 跳转到微信授权页面
        $this->jumpToWXAuthPage($redirectUrl) ;
    }


    /**
     * 跳转到微信授权页面获取openId
     */
    protected function jumpToWXAuthPage ($redirectUrl)
    {
        $_request = \Yii::$app->getResponse() ;
        if( false===stripos($redirectUrl, 'http://') ) {
            $redirectUrl ='http://'.$redirectUrl ;
        }
        if ( !$this->appId ) {
            throw new Exception('缺少appId') ;
        }
        $oauthUrl = self::authUrl($this->appId,$redirectUrl) ;
        \Yii::info('oauthUrl:'.$oauthUrl);
        $_request->redirect($oauthUrl) ;
        exit;
    }

    /*
  * 授权地址
  * */
    public static function authUrl($appId,$redirctUrl,$responseType='code',$scope='snsapi_userinfo',$state='0') {
        $url = sprintf(self::AUTH_URL,$appId,urlencode($redirctUrl),$responseType,$scope,$state) ;
        return $url ;
    }


    /*
    * 取用户信息
    * return object
   */
    public function getUserInfo($token,$openId) {

        $userInfoUrl = sprintf(self::USER_INFO_URL,$token,$openId) ;
        $userInfo = array('name'=>'','pic'=>'','sex'=>0);
        $arr = self::execute($userInfoUrl,array(),'GET');
        if(!empty($userInfo)){
            if(isset($arr->openid)){
                $userInfo['name'] = $arr->nickname;
                $userInfo['pic'] = $arr->headimgurl;
            }
        }
        $userInfo['sex'] = $arr->sex;
        $userInfo['location'] = $arr->country . $arr->province . $arr->city;
        $userInfo['api_name'] = "weixin_".$openId;
        $userInfo['api_id'] = $openId;
        return $userInfo;
    }


    /**
     * Notes: 通过code获取网页授权accesstoken和openId
     * @param $code 用户授权code
     * @param string $grant_type
     * @return array
     * @throws Exception
     */
    public function getAccessToken($code,$grant_type='authorization_code'){
        $url = $this->uri . "access_token?appid={$this->appId}&secret={$this->appSecret}&code={$code}&grant_type={$grant_type}";

        $curl = new Curl();
        $result = $curl->get($url,array());

        \Yii::info(__FUNCTION__.':'.$result);
        if(empty($result)){
            return false;
        }

        $resultArr = Json::decode($result,true);
        \Yii::info("获取得到openId：". Json::encode($resultArr), 'pay');

        if(!isset($resultArr['access_token'])){
            \Yii::info(__FUNCTION__.': not access_token data filed');
            throw new Exception('not access_token data filed');
        }
        if(!isset($resultArr['openid'])){
            throw new Exception('missing code');
        }
        $accessToken = $resultArr['access_token'];
        $openId = $resultArr['openid'];
        $unionId = $resultArr['unionid'] ? $resultArr['unionid'] : '';
        return array('token'=>$accessToken , 'openid'=>$openId, 'unionid' => $unionId);
    }


    /**
     * 获取accessToken
     * @param string $grant_type
     * @return bool
     */
    public function getToken($grant_type='client_credential'){

        $url = "https://api.weixin.qq.com/cgi-bin/token?grant_type={$grant_type}&appid={$this->appId}&secret={$this->appSecret}";

        $curl = new Curl();
        $result = $curl->get($url,array());


        \Yii::info(__FUNCTION__.':'.$result);
        if(empty($result)){
            return false;
        }

        $resultArr = Json::decode($result,true);

        if(!isset($resultArr['access_token'])){
            \Yii::info(__FUNCTION__.': not access_token data filed');
            return false;
        }

        $accessToken = $resultArr['access_token'];

        return $accessToken;
    }


    /**
     * 获取jsapi_ticket
     * @param $accessToken
     * @return bool
     */
    public function getTicket($accessToken){
        $url = "https://api.weixin.qq.com/cgi-bin/ticket/getticket?access_token={$accessToken}&type=jsapi";

        $curl = new Curl();
        $result = $curl->get($url,array());

        \Yii::info(__FUNCTION__.':'.$result);
        if(empty($result)){
            return false;
        }

        $resultArr = Json::decode($result,true);

        if(!isset($resultArr['ticket'])){
            \Yii::info(__FUNCTION__.': not ticket data filed');
            return false;
        }

        $ticket = $resultArr['ticket'];

        return $ticket;
    }

    /**
     * 
     * @param $arr_field
     * @return string
     */
    public function signSha1($arr_field){
        ksort($arr_field);
        $arr_x = array();
        foreach ($arr_field as $item => $key) {
            if (empty($key))
                continue;
            $arr_x[] = $item . "=" . $key;
        }

        $str = implode("&", $arr_x) ;
        $str = strtoupper(sha1($str));
        return $str;
    }


    /**
     * @param $arr_field
     * @param string $mchSecret
     * @return string
     */
    public function sign_pay($arr_field, $mchSecret = ''){
        ksort($arr_field);
        $arr_x = array();
        foreach ($arr_field as $item => $key) {
            if (empty($key))
                continue;
            $arr_x[] = $item . "=" . $key;
        }

        $str = implode("&", $arr_x) . "&key=" . str_replace(' ','', $mchSecret);
        $str = strtoupper(md5($str));
        return $str;
    }



    /**
     * 执行
     * @param string $url
     * @param array $fields
     * @param string $method
     * @return mixed
     * @throws Exception
     */
    public static function execute ($url, $fields = array(), $method = 'POST', $decodeResult = true)
    {
        try {
            $header = array();
            $header[] = "Content-Type: application/json; charset=utf-8";
            $ch = curl_init(); //初始化curl
            curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1); //设置是否返回信息
            curl_setopt($ch, CURLOPT_HTTPHEADER, $header); //设置HTTP头
            if(strtoupper($method) == 'GET'){
                if(!empty($fields)){
                    $arr = array();
                    foreach ($fields as $key => $value) {
                        $arr[] = $key.'='.$value;
                    }
                    $fields = implode('&',$arr);
                    $url = $url.'?'.$fields;
                }
                curl_setopt($ch, CURLOPT_URL, $url); // 要访问的地址
                curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, 0); // 对认证证书来源的检查
//                curl_setopt($ch, CURLOPT_USERAGENT, $_SERVER['HTTP_USER_AGENT']); // 模拟用户使用的浏览器
                curl_setopt($ch, CURLOPT_FOLLOWLOCATION, 1); // 使用自动跳转
                curl_setopt($ch, CURLOPT_AUTOREFERER, 1); // 自动设置Referer
                curl_setopt($ch, CURLOPT_TIMEOUT, 30); // 设置超时限制防止死循环
                curl_setopt($ch, CURLOPT_HEADER, 0); // 显示返回的Header区域内容

            }else{
//                curl_setopt($ch, CURLOPT_URL, $url); //设置链接
                curl_setopt($ch, CURLOPT_TIMEOUT,10);   //设置等待时间
                curl_setopt($ch, CURLOPT_URL, $url); //设置链接
                curl_setopt($ch, CURLOPT_POST, 1); //设置为POST方式
                curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($fields)); //POST数据
                curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, FALSE);
            }
            $result = curl_exec($ch); //接收返回信息

            // 添加日志

            \Yii::info('share:'.$url." and result:".$result);


            // 不对 result 做 decode
            if (false === $decodeResult) {
                return $result ;
            }

            // 验证返回数据
            $resultData = Json::decode($result) ;

            if (is_null($resultData) || false === $resultData) {
                throw new Exception(12006) ;
            }

            // 添加日志
            \Yii::info('share:'.$url." and result:".$result);

            return $resultData;
        } catch (Exception $e) {
            \Yii::info('share:'.$url." and result:".$result);

            throw new Exception($e->getMessage(), $e->getCode()) ;
        }
    }
}