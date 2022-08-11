<?php
/**
 * Created by PhpStorm.
 * User: zhouk
 * Date: 2019/8/1
 * Time: 14:49
 */

namespace frontend\actions\login;


use frontend\actions\WxAction;
use common\library\helper\Code;

class LogoutAction extends WxAction
{

    public function run(){
        if (!\Yii::$app->user->isGuest) {
            $key = 'user_key_'. str_replace('.', '@', \Yii::$app->user->identity->userAccount);
            $cookies = \Yii::$app->response->cookies;
            $cookies->remove($key);
            \Yii::$app->user->logout();
        }
        return $this->returnApi(Code::SUCCESS, 'logout');
    }

}