<?php
/**
 * Created by PhpStorm.
 * User: zhouk
 * Date: 2019/12/3
 * Time: 17:27
 */

namespace frontend\actions\user;


use common\library\helper\Code;
use yii\base\Action;
use yii\helpers\Json;

class LoginOutAction extends Action
{

    public function run(){
        $token = \Yii::$app->request->post('token');

        if(empty($token)){
            return $this->returnApi(Code::PARAM_ERR , '操作失败');
        }
        $info = \Yii::$app->cache->get($token);

        if(empty($info)){
            return $this->returnApi(Code::SUCCESS , 'ok');
        }
        $data = [];
        \Yii::$app->cache->set($token,Json::encode($data));
        return $this->returnApi(Code::SUCCESS , 'ok');
    }


    public function returnApi($code = 0, $msg = '', $data = []){
        $result = [
            'ret' => $code,
            'msg' => $msg,
            'data' => $data,
        ];
        header('Content-type: application/json');
        return $result;
    }
}