<?php
/**
 * Created by PhpStorm.
 * User: zhouk
 * Date: 2019/12/2
 * Time: 20:58
 */

namespace frontend\actions\user;


use backend\actions\BaseAction;

class CheckTokenAction extends BaseAction
{

    public function run(){
        $token = \Yii::$app->request->post('token');

        $msg = \Yii::$app->cache->get($token);
        \Yii::info('test token:'. $token. ' xxxxxmsg:'.$msg);
        return $msg;
    }

}