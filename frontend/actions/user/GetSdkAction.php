<?php
/**
 *
 * author: jinyanxin
 * Date: 2020/6/4
 * Time: 17:24
 * PHP version 7
 */

namespace frontend\actions\user;

use common\kjlib\auth\WxBease;
use common\models\school\SchoolConfigModel;
use frontend\actions\WxAction;

class GetSdkAction extends WxAction
{

    public function run()
    {
        \Yii::info("-------get wx sdk-----".$this->schoolId);
        $url = \Yii::$app->request->post('url');
        $config = SchoolConfigModel::getWxConfig($this->schoolId);
        if(empty($config)){
            return $this->returnApi(100,'配置不存在');
        }
        \Yii::info("-------get wx sdk-----".print_r($config,true));
        $wx = new WxBease($config['wechatAppId']);
        $accessToken = $wx->getToken($config['wechatAppId'], $config['WeChatAppSecret']);

        $ticket = $wx->getTicket($accessToken);

        $result = [
            'noncestr' => time() . rand(0,99999),
            'jsapi_ticket' => $ticket,
            'timestamp' => time(),
            'url'=>$url
        ];
        \Yii::info("-------get wx sdk-----".$url);
        $sign = $wx->signSha1($result);

        $result['signature'] = $sign;
        $result['appId'] = $config['wechatAppId'];
        return $this->returnApi(0,'ok',$result);
    }

}