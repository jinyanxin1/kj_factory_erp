<?php
/**
 * Created by PhpStorm.
 * User: zhouk
 * Date: 2019/8/24
 * Time: 15:41
 */

namespace common\kjlib\weixin;

use common\library\helper\Curl;
use common\models\stationConfig\StationConfigModel;
use \Yii;

class WxQrcode
{


    /**
     * 生成小程序二维码
     * @param array $data
     * @param $schoolId
     * @return bool|string
     */
    public static function getSmallProgramQrCode($data = array(), $schoolId){
        Yii::info('生成二维码参数：' .json_encode($data). ' 站点： '.$schoolId);
        if(empty($data)){
            return false;
        }
        if(empty($schoolId)){
            return false;
        }
        $wx = Yii::$app->wechat;
        $config = StationConfigModel::schoolIdByschoolId($schoolId);
        Yii::$app->wechat->appId = $config['smallAppId'];
        Yii::$app->wechat->appSecret = $config['smallAppSecret'];

        $accessToken = $wx->getToken();
        $curl = new Curl();
        $buffer = $curl->post('https://api.weixin.qq.com/wxa/getwxacodeunlimit?access_token=' . $accessToken, json_encode($data));

        //buffer数据如果是json数据，说明生成二维码失败
        if (self::isJson($buffer)) {
            return false;
        }

        //将buffer数据转换成base64数据
        $base64 = self::data_uri($buffer, 'image/png');
        return $base64;
    }

    /**
     * 判断是否是json数据
     * @param $data需要判断的数据
     * @return bool
     */
    public static function isJson($data)
    {
        if (!is_string($data)) {
            return false;
        }
        $data = json_decode($data);
        if (!empty($data) && (is_array($data) || is_object($data))) {
            return true;
        }
        return false;
    }

    //二进制转图片image/png
    public static function data_uri($contents, $mime)
    {
        $base64 = base64_encode($contents);
        return ('data:' . $mime . ';base64,' . $base64);
    }

}