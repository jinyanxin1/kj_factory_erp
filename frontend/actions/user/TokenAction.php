<?php
/**
 * Created by PhpStorm.
 * User: zhouk
 * Date: 2019/11/30
 * Time: 16:28
 */

namespace frontend\actions\user;


use common\kjlib\auth\AuthCode;
use common\kjlib\auth\WXUserAuth;
use common\library\helper\Code;
use common\models\user\UserApiLoginModel;
use yii\base\Action;
use yii\helpers\Json;
use \Yii;

class TokenAction extends Action
{

    public function run(){
        $openId = \Yii::$app->request->post('openId');

        if(empty($openId)){
            return $this->returnApi(Code::PARAM_ERR, '请传递openId');
        }
        $openInfo = UserApiLoginModel::getByOpenId($openId);
        if(empty($openInfo)){
            return $this->returnApi(Code::PARAM_ERR, '微信信息不存在');
        }

        $data = [
            'openInfo' => AuthCode::authcode($openId, 'ENCODE', WXUserAuth::WEIXIN_COOKIE_KEY),
            'userInfo' => ''
        ];
        if(!empty($openInfo->loginUserId)){
            $data['userInfo'] = AuthCode::authcode($openInfo->loginUserId, 'ENCODE', WXUserAuth::WEIXIN_COOKIE_KEY);
        }

        $token = md5($openId);
        Yii::info('token信息：'. $token . 'msg:' . Json::encode($data), 8 * 24 * 3600);
        Yii::$app->cache->set($token, Json::encode($data));

        //将微信数据存至缓存
        Yii::$app->cache->set($openId, Json::encode($openInfo), 8 * 24 * 3600);

        return $this->returnApi(Code::SUCCESS , 'ok', ['token' => $token]);
    }


    public function returnApi($code = 0, $msg = '', $data = []){
        $result = [
            'ret' => $code,
            'msg' => $msg,
            'data' => $data,
        ];
        header('Content-type: application/json');
        return Json::encode($result);
    }
}