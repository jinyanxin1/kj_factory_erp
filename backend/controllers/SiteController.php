<?php
namespace backend\controllers;


use common\models\User;
use Yii;
use yii\web\Controller;


/**
 * Site controllers
 */
class SiteController extends Controller
{
    public $enableCsrfValidation = false;

    public function actions()
    {
        return [
            'login' => 'backend\actions\login\LoginAction',         //登录
            'logout' => 'backend\actions\login\LogoutAction',      //退出
//            'captcha' => array(
//                'class' => 'yii\captcha\CaptchaAction',
//                'backColor'=>0xffffff,//背景颜色
//                'maxLength' => 6, //最大显示个数
//                'minLength' => 6,//最少显示个数
//                'padding' => 5,//间距
//                'height'=>40,//高度
//                'width' => 110,  //宽度
//                'foreColor'=>0x6EC03B,     //字体颜色
//                'offset'=>4,        //设置字符偏移量 有效果
//            ),
        ];
    }

    public function actionSign()
    {
        $user = User::find()->where(['userAccount'=>'testadmin','isValid'=>User::IS_VALID_OK])->one();
        if(empty($user)){
            $user = new User();
        }
        $user->userAccount = 'testadmin';
        $user->userName = '管理账号';
        $user->tel = '15873330591';
        $user->userPwd = Yii::$app->security->generatePasswordHash('123456');
        $user->save();
        var_dump("ok");
    }

}
