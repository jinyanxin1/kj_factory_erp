<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2017/9/6 0006
 * Time: 上午 11:20
 */

namespace common\kjlib\weixin;


use callmez\wechat\sdk\components\MessageCrypt;
use callmez\wechat\sdk\MpWechat;

class WxFunction extends MpWechat
{


    /*
     * 获取所有关注者
     * */
    public function getUserList($nextOpenId)
    {
        $result = $this->httpGet(self::WECHAT_USER_LIST_GET_PREFIX, [
            'access_token' => $this->getAccessToken(),
            'next_openid' => $nextOpenId,
        ]);
        return !array_key_exists('errcode', $result) ? $result : false;
    }

    public function getToken(){
        return $this->getAccessToken();
    }

    public function createMessageCrypt()
    {
        return \Yii::createObject(MessageCrypt::className(), [$this->token, $this->encodingAesKey, $this->appId]);
    }


    /*
     * 组织分享的数据
     * $url 生成签名的时候需要的地址，当前网页的URL，不包含#及其后面部分
     * $title 分享的标题
     * $link 分享内容中的链接
     * $imgUrl 分享的图片
     * $desc 分享的描述
     * $type 分享类型,music、video或link，不填默认为link
     * $dataUrl 如果type是music或video，则要提供数据链接，默认为空
     * */
    public function formatShareData($url,$title,$link,$imgUrl,$desc = '',$type = '',$dataUrl = '')
    {
        /*
         * 得到接口注入权限验证配置的参数
         * appId
         * timestamp 生成签名的时间戳
         * nonceStr 生成签名的随机串
         * signature 签名
         * */
        $time = time();
        $shareInfo['appId'] = $this->appId;
        $shareInfo['timestamp'] = $time ;
        $shareInfo['noncestr'] = $time . rand(10000, 99999) ;
        $shareInfo['url'] = $url;
        //按照键名进行升序重新排列
        ksort($shareInfo) ;
        //生成 URL-encode 之后的请求字符串
        $str = http_build_query($shareInfo) ;
        $str = urldecode($str) ;
        //生成签名
        $shareInfo['sign'] = sha1($str) ;

        /*
         * 分享接口需要的参数
         * 朋友圈：titile,link,imgUrl
         * 分享给朋友：title,link,imgUrl,desc,type,dataUrl
         * */
        $shareInfo['title'] = $title;
        $shareInfo['link'] = $link;
        $shareInfo['imgUrl'] = $imgUrl;
        $shareInfo['desc'] = $desc;
        $shareInfo['type'] = $type;
        $shareInfo['dataUrl'] = $dataUrl;

        return $shareInfo;
    }

}