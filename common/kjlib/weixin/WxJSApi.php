<?php
namespace common\kjlib\weixin;

/**
 * class WxJSApi
 * 微信JS相关类
 */


use yii;
use yii\helpers\Json;
use common\kjlib\until\KjValidate;

class WxJSApi
{

    private $_wxAppId;
    private $_url;
    private $_hideShare = false;
    private $_onlyShow = false;
    private $_jsApiList = array();
    private $_scriptFileArr = array();
    private $_params = array();

    public function __construct($wxAppId)
    {
        $this->_wxAppId = $wxAppId;
        $this->_url = yii::$app->request->getHostInfo() . yii::$app->request->url;
    }

    /**
     * 隐藏分享按钮
     * @return $this
     */
    public function hideShare()
    {
        $this->_hideShare = true;
        $this->_jsApiList[] = 'hideMenuItems';
        return $this;
    }

    /**
     * 只显示'调整字体' 与 '投拆'
     * @return $this
     */
    public function showOnlyMenu()
    {
        $this->_onlyShow = true;
        $this->_jsApiList[] = 'showMenuItems';
        return $this;
    }

    public function location()
    {
        $locationApiList = array(
            'getLocation', // 获取地理位置
            'openLocation',// 打开内置地图
        );
        $this->_jsApiList = array_unique(array_merge($this->_jsApiList, $locationApiList));
        return $this;
    }

    public function voice()
    {
        $voiceApiList = array(
            'startRecord', // 开始录音接口
            'stopRecord', // 停止录音接口
            'onVoiceRecordEnd', // 监听录音自动停止接口
            'playVoice', // 播放语音接口
            'pauseVoice', //暂停播放接口
            'stopVoice', //停止播放接口
            'onVoicePlayEnd', //监听语音播放完毕接口
            'uploadVoice', //上传语音接口
            'downloadVoice' //下载语音接口
        ); // 核销后再次赠送卡券接口;


        $this->_jsApiList = array_unique(array_merge($this->_jsApiList, $voiceApiList));

        return $this;
    }


    /**
     * 获取分享相关 script
     *
     */
    public function shareTo()
    {
        $shareToArr = array(
            'onMenuShareTimeline',
            'onMenuShareAppMessage',
            'onMenuShareQQ',
            'onMenuShareWeibo'
        );

        $this->_jsApiList = array_unique(array_merge($this->_jsApiList, $shareToArr));
        return $this;
    }

    /**
     * 扫码接口
     */
    public function scan()
    {
        $shareToArr = array(
            'scanQRCode'
        );

        $this->_jsApiList = array_unique(array_merge($this->_jsApiList, $shareToArr));
        return $this;
    }

    /**
     * 卡券
     */
    public function card()
    {
        $cardApiList = array(
            'chooseCard', // 拉取适用卡券列表并获取用户选择信息
            'addCard', // 批量添加卡券接口
            'openCard', // 查看微信卡包中的卡券接口
            'consumeAndShareCard'
        ); // 核销后再次赠送卡券接口;


        $this->_jsApiList = array_unique(array_merge($this->_jsApiList, $cardApiList));

        return $this;
    }


    /**
     * @param bool $debug
     * @return string
     */
    private function getConfig($debug = false)
    {
        $url = $this->_url;
        $appId = $this->_wxAppId;
        $timestamp = time();
        $nonceStr = $this->getRandomStr();;
        $sign_params['noncestr'] = $nonceStr;
        $sign_params['jsapi_ticket'] = Yii::$app->wechat->getJsApiTicket();
        $sign_params['timestamp'] = $timestamp;
        $sign_params['url'] = $url;
        $params = array();
        $params['debug'] = $debug;
        $params['appId'] = $appId;
        $params['timestamp'] = $timestamp;
        $params['nonceStr'] = $nonceStr;
        $params['signature'] = $this->makeSign($sign_params);
        $params['jsApiList'] = $this->_jsApiList;
        return $params;
    }

    /**
     *
     * 生成输出 Script
     * @param bool $debug 是否调试
     * @return string
     */
    public function getScript($debug = false)
    {
        if (!KjValidate::isWxBrowser()) {
            return '';
        }

        $_jsConfig = $this->getConfig($debug);

        $script = '<script type="text/javascript" src="http://res.wx.qq.com/open/js/jweixin-1.1.0.js"></script>';
        $script .= '<script type="text/javascript">';
        $script .= 'wx.config(' . Json::encode($_jsConfig) . ');' . "\n";
        $wxReady = '';
        if ($this->_hideShare) {
            $btnArr = array('menuItem:share:appMessage', 'menuItem:share:timeline', 'menuItem:share:qq',
                'menuItem:share:QZone', 'menuItem:share:weiboApp', 'menuItem:share:facebook', 'menuItem:favorite',
                'menuItem:jsDebug', 'menuItem:editTag', 'menuItem:delete', 'menuItem:copyUrl', 'menuItem:originPage',
                'menuItem:readMode', 'menuItem:openWithQQBrowser', 'menuItem:openWithSafari', 'menuItem:share:email'
            , 'menuItem:share:brand');
            $wxReady .= 'wx.hideMenuItems({ menuList: ' . Json::encode($btnArr) . '});';
        }
        if ($this->_onlyShow) {
            $btnArr = array('menuItem:exposeArticle', 'menuItem:setFont');
            $wxReady .= 'wx.showMenuItems({ menuList: ' . Json::encode($btnArr) . '});';
        }
        if (!empty($wxReady)) {
            $script .= 'wx.ready(function(){' . $wxReady . '});' . "\n";
        }
        $script .= '</script>';

        foreach ($this->_scriptFileArr as $_scriptFile) {
            $script .= '<script type="text/javascript" src="' . $_scriptFile . '"></script>';
        }

        return $script;
    }

    public function addCardJsFuncStr($card_id)
    {
        $str = '';
        $str .= 'var addCard = function(){
			
			wx.addCard({
				cardList:[{
					cardId : \'' . $card_id . '\',
					cardExt : \'' . $this->getCardExtStr($card_id) . '\'
					}],
				    success: function (res) {
				        var cardList = res.cardList; // 添加的卡券列表信息
				    }	
				});
			};';
        return $str;
    }

    /**
     *
     * @param $card_id
     * @param string $code 指定的卡券code码，只能被领一次。use_custom_code字段为true的卡券必须填写，非自定义code不必填写。
     * @param string $openid 指定领取者的openid，只有该用户能领取。bind_openid字段为true的卡券必须填写，bind_openid字段为false不必填写。
     * @param int $outer_id 领取场景值，用于领取渠道的数据统计，默认值为0，字段类型为整型，
     *                         长度限制为60位数字。用户领取卡券后触发的事件推送中会带上此自定义场景值，不参与签名。
     * @return string CardExt
     */
    private function getCardExtStr($card_id, $code = '', $openid = '', $outer_id = 0)
    {
        $field['api_ticket'] = Yii::$app->wechat->getJsApiTicket('wx_card');
        $field['timestamp'] = time();
        //$field['timestamp'] = 1478764022;
        $field['card_id'] = $card_id;
        $field['nonce_str'] = self::getRandomStr(rand(16, 32));
        // $field['nonce_str'] = 'aTb68S58LdwTf6UTGWfjXi4xqJgX21D';
        if (!empty($code)) {
            $field['code'] = $code;
        }
        if (!empty($openid)) {
            $field['openid'] = $openid;
        }
        $params = $field;
        sort($params, SORT_STRING);
        $str = implode($params);
        $signature = sha1($str);
        $field['signature'] = $signature;
        $field['outer_id'] = $outer_id;
        return Json::encode($field);
    }

    /**
     * 随机生成16位字符串
     * @return string 生成的字符串
     */
    private function getRandomStr($size = 16)
    {

        $str = "";
        $str_pol = "ABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789abcdefghijklmnopqrstuvwxyz";
        $max = strlen($str_pol) - 1;
        for ($i = 0; $i < $size; $i++) {
            $str .= $str_pol[mt_rand(0, $max)];
        }
        return $str;
    }

    private function makeSign(array $params)
    {
        yii::info('生成js_sign' . print_r($params, true));
        $accessable = array();
        //过滤空值、sign与sign_type参数
        foreach ($params as $key => $value) {
            $key = strtolower($key);
            if ($key != "_sign" && $value != "" && $value != null) {
                $accessable[$key] = $value;
            }
        }
        ksort($accessable);
        //获得签名结果
        $str = '';
        foreach ($accessable as $key => $value) {
            $str .= $key . '=' . $value . '&';
        }
        $len = strlen($str);
        $str = substr($str, 0, $len - 1);
        $sha1 = sha1($str);
        return $sha1;
    }
    //获取微信参数
    public function getWxConfig(){
        $wxParms = $this->getConfig();
        return $wxParms;
    }
}
?>