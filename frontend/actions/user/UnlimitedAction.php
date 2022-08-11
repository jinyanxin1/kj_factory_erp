<?php
/**
 * User: cqj
 * Date: 2020/8/1
 * Time: 10:18 上午
 */

namespace frontend\actions\user;


use common\library\helper\Curl;
use common\models\user\UserModel;
use frontend\actions\WxAction;
use yii\helpers\Json;

class UnlimitedAction extends WxAction
{
    public function run() {
        $user = UserModel::getById($this->userId,false);
        $staffId  = $user->staffId;
        $appId = \Yii::$app->wxSmallProgram->appId;
        $appSecret = \Yii::$app->wxSmallProgram->appSecret;

        $url = sprintf(
            'https://api.weixin.qq.com/cgi-bin/token?grant_type=client_credential&appid=%s&secret=%s',
            $appId, $appSecret);
        $result = file_get_contents($url);
        $data = json_decode($result);
        $url = sprintf(
            'https://api.weixin.qq.com/wxa/getwxacodeunlimit?access_token=%s',
            $data->access_token);
        $scene = $staffId ;
        $params = array(
            'scene' => $scene,
        );
        $curl = new Curl();
        $r = $curl->post($url,Json::encode($params));
        self::renderPng($r);
    }
    //输出png图片
    public static function renderPng($data)
    {
        header("Content-Type:image/png");
        echo $data;
        exit;
    }

}