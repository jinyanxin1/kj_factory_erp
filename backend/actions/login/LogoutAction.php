<?php
/**
 * Created by PhpStorm.
 * User: zhouk
 * Date: 2019/8/1
 * Time: 14:49
 */

namespace backend\actions\login;


use backend\actions\BaseAction;
use common\library\helper\Code;

class LogoutAction extends BaseAction
{

    public function run(){
        if (!\Yii::$app->user->isGuest) {
            $key = 'user_key_'. str_replace('.', '@', \Yii::$app->user->identity['userAccount']);
            \Yii::$app->cache->set($key, [] , 10 * 24 * 3600);
            \Yii::$app->user->logout();
        }
        return $this->returnApi(Code::SUCCESS, 'logout');
    }

}