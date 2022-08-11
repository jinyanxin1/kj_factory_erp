<?php
/**
 * Created by PhpStorm.
 * User: zhouk
 * Date: 2019/8/17
 * Time: 16:59
 */

namespace frontend\controllers;



use yii\web\Controller;
use yii\web\Response;

class WechatController extends Controller
{
    public $enableCsrfValidation = false;
    public function __construct($id, $module = null, array $config = [])
    {
        parent::__construct($id, $module, $config);
        \Yii::$app->response->format = Response::FORMAT_JSON;
    }
    public function actions()
    {
        return array(
            //登录 小程序验证
//            'login-wx-user'=>array(
//                'class'=>'frontend\actions\user\LoginAction'
//            ),
            //登陆 账号密码
            'login-user'=>array(
                'class'=>'frontend\actions\user\LoginAdminAction'
            ),
            //
//            'jobAdd'=>array(
//                'class'=>'frontend\actions\job\LoginAddAction'
//            ),
            //退出
            'login-out'=>array(
                'class'=>'frontend\actions\user\LoginOutAction'
            ),
            //绑定小程序号
//            'bind'=>array(
//                'class'=>'frontend\actions\user\BindAction'
//            ),
            //发送短信-找回密码
            'send'=>array(
                'class'=>'frontend\actions\user\SendSmsAction'
            ),
            //发送短信-注册
//            'login-send'=>array(
//                'class'=>'frontend\actions\user\LoginSendSmsAction'
//            ),
            //找回密码
            'retrieve-pwd' => ['class'=>'frontend\actions\user\RetrievePwdAction'],
            //修改密码
            'change-pwd' => ['class'=>'frontend\actions\user\ChangePwdAction'],
//            'save-wx-user-info'=>array(
//                'class'=>'frontend\actions\user\SaveWxUserInfoAction',
//            ),
//            'getUnlimited' => ['class'=>'frontend\actions\user\UnlimitedAction'],
        );
    }
}