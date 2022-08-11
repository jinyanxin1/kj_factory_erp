<?php

namespace frontend\actions\job;

/**
* Created by cqj
* User: cqj
* Date: 2020-07-07
* Time: 14:23
* 新增
*/

use common\library\helper\Code;
use common\models\jobInfo\JobInfoForm;
use yii\base\Action;
use yii\web\Response;

class LoginAddAction extends Action
{
    public function init()
    {
        parent::init();
        \Yii::$app->response->format = Response::FORMAT_JSON;
    }
	public function run() {
		$model = new JobInfoForm() ;
		//TODO 具体情况接收参数
		$model->attributes = $this->request()->post() ;
        $model->name = $this->request()->post('name') ;
        $model->staffId = $this->request()->post('staffId') ;
		$model->sex = $this->request()->post('sex') ;
		$model->phone = $this->request()->post('phone') ;
		$model->birthday = $this->request()->post('birthday') ;
		$model->education = $this->request()->post('education') ;
        $model->idCard = $this->request()->post('idCard') ;
        $code = $this->request()->post('code') ;
        $userPwd = trim($this->request()->post('password'));
        $checkPwd = trim($this->request()->post('passwordTwo'));
        $token = $this->request()->post('token') ;

        if (empty($token)) {
            $info = \Yii::$app->cache->get($token);
            if (empty($info)) {
                return ['code' => Code::LOGIN_ERR, 'msg' => '请进行微信授权登录', 'data' => []];
            }
        }

        if(empty($code)){
            return $this->returnApi(Code::PARAM_ERR, '请填写验证码');
        }
        if(empty($userPwd)){
            return $this->returnApi(Code::PARAM_ERR, '请填写密码');
        }
        if(empty($checkPwd)){
            return $this->returnApi(Code::PARAM_ERR, '请填写确认密码');
        }

		$ret = $model->wxAdd($code,$userPwd,$checkPwd,$token) ;
		return $this->returnApi($ret['code'], $ret['msg'],$ret['data']) ;
	}
    protected function request(){
        return \Yii::$app->request;
    }
    public function returnApi($code = 0, $msg = '', $data = []){
        $result = [
            'ret' => $code,
            'msg' => $msg,
            'data' => $data,
        ];
        header('Content-type: application/json');
        return $result;
        \Yii::$app->end();
    }
}