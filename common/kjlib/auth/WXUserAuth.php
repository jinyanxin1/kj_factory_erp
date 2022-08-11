<?php
/**
 * Created by PhpStorm.
 * User: zky
 * Date: 2018/08/15
 * Time: 0:15
 */
namespace common\kjlib\auth;


use yii\base\Exception;

class WXUserAuth {
    const OPEN_ID_COOKIE_NAME = 'jxt_open_id';
    const CUSTOMER_ID_COOKIE_NAME = 'jxt_cem_customer';
    const WEIXIN_COOKIE_KEY = 'jxt!@#XinWei2016' ;

    const AUTH_URL = 'https://open.weixin.qq.com/connect/oauth2/authorize?appid=%s&redirect_uri=%s&response_type=%s&scope=%s&state=%s#wechat_redirect' ;
    const USER_INFO_URL = 'https://api.weixin.qq.com/sns/userinfo?access_token=%s&openid=%s&lang=zh_CN' ;



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
     * @param $app_id
     * @param $app_secret
     * @param $backUrl
     * @return bool
     * @throws Exception
     */
    public function WeixinInit($app_id,$backUrl)
    {
        $redirectUrl = \Yii::$app->request->getHostInfo() . '/wechat/login-wx-user?appid='.$app_id.'&back_url='.urlencode($backUrl) ;
        // 跳转到微信授权页面
        $this->jumpToWXAuthPage($app_id,$redirectUrl) ;
    }


    /**
     * 跳转到微信授权页面获取openId
     */
    protected function jumpToWXAuthPage ($app_id,$redirectUrl)
    {
        $_request = \Yii::$app->getResponse() ;
        /*if( false===stripos($redirectUrl, 'http://') ) {
            $redirectUrl ='http://'.$redirectUrl ;
        }*/
        if ( !$app_id ) {
            throw new Exception('缺少appId') ;
        }
        $oauthUrl = self::authUrl($app_id,$redirectUrl) ;
        \Yii::info('oauthUrl:'.$oauthUrl);
        header("Location: ".$oauthUrl);
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
            $resultData = json_decode($result) ;

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