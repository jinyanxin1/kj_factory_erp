<?php
/**
 * Created by PhpStorm.
 * User: zky
 * Date: 2016/12/18
 * Time: 23:19
 */

namespace common\kjlib\auth;

use common\library\helper\Curl;
use yii\base\Exception;
use yii\helpers\Json;

class WxBease {
    protected  $uri = "https://api.weixin.qq.com/sns/oauth2/";
    protected $app_id;
    const AUTH_URL = 'https://open.weixin.qq.com/connect/oauth2/authorize?appid=%s&redirect_uri=%s&response_type=%s&scope=%s&state=%s#wechat_redirect' ;
    const USER_INFO_URL = 'https://api.weixin.qq.com/sns/userinfo?access_token=%s&openid=%s&lang=zh_CN' ;


    public function __construct($appId){
        $this->app_id = $appId;
    }

    /**
     * Notes: 通过code获取网页授权accesstoken和openId
     * @param $code 用户授权code
     * @param $app_id 第三方用户唯一凭证
     * @param $secret 第三方用户唯一凭证密钥，即appsecret
     * @param string $grant_type
     * @return array
     * @throws Exception
     */
    public function getAccessToken($code,$app_id,$secret,$grant_type='authorization_code'){
        $url = $this->uri . "access_token?appid={$app_id}&secret={$secret}&code={$code}&grant_type={$grant_type}";

        $curl = new Curl();
        $result = $curl->get($url,array());

        \Yii::info(__FUNCTION__.':'.$result);
        if(empty($result)){
            return false;
        }

        $resultArr = json_decode($result,true);
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
        $unionId = isset($resultArr['unionid']) ? $resultArr['unionid'] : '';
        return array('token'=>$accessToken , 'openid'=>$openId, 'unionid' => $unionId);
    }


    /**
     * 获取accessToken
     * @param $app_id
     * @param $secret
     * @param string $grant_type
     * @return bool
     */
    public function getToken($app_id,$secret,$grant_type='client_credential'){

        $cache = \Yii::$app->cache;
        $accessToken = $cache->get($app_id);
        \Yii::info('------wx bases get start appid---'.$app_id.'---access_token----'.$accessToken);
        if(empty($accessToken)){
            $url = "https://api.weixin.qq.com/cgi-bin/token?grant_type={$grant_type}&appid={$app_id}&secret={$secret}";
            $curl = new Curl();
            $result = $curl->get($url,array());
            \Yii::info(__FUNCTION__.':'.$result);
            if(empty($result)){
                return false;
            }
            $resultArr = json_decode($result,true);
            if(!isset($resultArr['access_token'])){
                \Yii::info(__FUNCTION__.': not access_token data filed');
                return false;
            }
            $accessToken = $resultArr['access_token'];
            \Yii::info('------wx bases get new appid---'.$app_id.'---access_token----'.$accessToken);
            $cache->set($app_id, $accessToken, 7000);
        }
        \Yii::info('------wx bases get return appid---'.$app_id.'---access_token----'.$accessToken);
        return $accessToken;
    }


    /**
     * 先执行的方法
     * @param $app_id
     * @param $backUrl
     * @return bool
     * @throws Exception
     */
    public function WeixinInit($app_id,$backUrl)
    {
        // 跳转到微信授权页面
        $this->jumpToWXAuthPage($app_id,$backUrl) ;
        return true;
    }

    /**
     * 跳转到微信授权页面获取openId
     */
    protected function jumpToWXAuthPage ($app_id,$redirectUrl)
    {
        $_request = \Yii::$app->getResponse() ;
        if( false===stripos($redirectUrl, 'http://') ) {
            $redirectUrl ='http://'.$redirectUrl ;
        }
        if ( !$app_id ) {
            throw new Exception('缺少appId') ;
        }
        $oauthUrl = self::authUrl($app_id,$redirectUrl) ;
        \Yii::info('oauthUrl:'.$oauthUrl);
        $_request->redirect($oauthUrl) ;
    }


    /*
     * 授权地址
     * */
    public static function authUrl($appId,$redirctUrl,$responseType='code',$scope='snsapi_userinfo',$state='0') {
        $url = sprintf(self::AUTH_URL,$appId,urlencode($redirctUrl),$responseType,$scope,$state) ;
        return $url ;
    }




    /**
     * 模拟表单提交
     * @param $url
     * @param array $fields
     * @param string $method
     * @return mixed
     */
    public static function query($url, $fields = array(), $method = 'POST'){
        if(!empty($fields)){
            $arr = array();
            foreach ($fields as $key => $value) {
                $arr[] = $key.'='.$value;
            }
            $fields = implode('&',$arr);
        }
        $header = array();
        $header[] = "Content-Type: application/json; charset=utf-8";
        $ch = curl_init(); //初始化curl
        if(strtoupper($method) == 'GET'){
            if(!empty($fields)){
                $url = $url.'?'.$fields;
            }
            curl_setopt($ch, CURLOPT_URL, $url); // 要访问的地址
            curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, 0); // 对认证证书来源的检查
            curl_setopt($ch, CURLOPT_USERAGENT, $_SERVER['HTTP_USER_AGENT']); // 模拟用户使用的浏览器
            curl_setopt($ch, CURLOPT_FOLLOWLOCATION, 1); // 使用自动跳转
            curl_setopt($ch, CURLOPT_AUTOREFERER, 1); // 自动设置Referer
            curl_setopt($ch, CURLOPT_TIMEOUT, 30); // 设置超时限制防止死循环
            curl_setopt($ch, CURLOPT_HEADER, 0); // 显示返回的Header区域内容
            curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1); // 获取的信息以文件流的形式返回

        }else{
            curl_setopt($ch, CURLOPT_URL, $url);
            curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
            curl_setopt($ch, CURLOPT_POST, 1);
            curl_setopt($ch, CURLOPT_POSTFIELDS, $fields);
            curl_setopt($ch, CURLOPT_CONNECTTIMEOUT, 10);
            curl_setopt($ch, CURLOPT_TIMEOUT, 30);
        }
        $result = curl_exec($ch); //接收返回信息

        return $result;
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

        $resultArr = json_decode($result,true);

        if(!isset($resultArr['ticket'])){
            \Yii::info(__FUNCTION__.': not ticket data filed');
            return false;
        }

        $ticket = $resultArr['ticket'];

        return $ticket;
    }

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

}
