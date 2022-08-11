<?php
/**
 * Created by PhpStorm.
 * User: zhouk
 * Date: 2019/11/12
 * Time: 21:43
 */

namespace frontend\actions;


use common\kjlib\auth\AuthCode;
use common\kjlib\auth\WXUserAuth;
use common\library\helper\Code;
use yii\helpers\Json;
use \Yii;

class WxAction extends BaseAction
{

    public function init()
    {
        parent::init();
//        $path = Yii::$app->request->getPathInfo();
//        $pathArr = explode('/', $path);     //取消限制权限接口处理预留
//        Yii::info('---------- frontend pathArr'.print_r($pathArr,true));
//        Yii::info('---------- frontend postData'.print_r($this->request()->post(),true));
//
        //判断微信登录成功
        $token = $this->request()->post('token');
        if (empty($token)) {
            $token = $this->request()->get('token');
        }
        $info = Yii::$app->cache->get($token);
        Yii::info('------- frontend wxaction info'.$info);

        //通过token 获取cache中存储的userId
        if(empty($info)){
           echo Json::encode( $this->returnApi(Code::LOGIN_ERR, '请进行微信授权登录',
               ['imgUrl' => Yii::$app->params['imageUrl']]));
           exit();
        }else{
            $data = Json::decode($info);
//            $openInfo = $data['openInfo'] ?? '';
            $userInfo = $data['userInfo'] ?? '';
            $staff = $data['staffId'] ?? '';
            $job = $data['jobId'] ?? '';

//            $openId = AuthCode::authcode($openInfo, 'DECODE', WXUserAuth::WEIXIN_COOKIE_KEY);
            $userId = AuthCode::authcode($userInfo, 'DECODE', WXUserAuth::WEIXIN_COOKIE_KEY);
            $staffId = AuthCode::authcode($staff, 'DECODE', WXUserAuth::WEIXIN_COOKIE_KEY);
            $jobId = AuthCode::authcode($job, 'DECODE', WXUserAuth::WEIXIN_COOKIE_KEY);
//            Yii::info('is Login openId:'.$openId);
            Yii::info('is Login userId:'.$userId);

            if (empty($jobId) && empty($staffId)) {
                echo Json::encode( $this->returnApi(Code::LOGIN_ERR, '请进行微信授权登录',
                    ['imgUrl' => Yii::$app->params['imageUrl']]));
                exit();
            }

            $this->userId = $userId;
//            $this->openId = $openId;
            $this->jobId = $jobId;
            $this->staffId = $staffId;

        }
        //判断userId是否存在
        //判断user账号是否授权

        Yii::info('----------wx duan info token'.$this->request()->post('token'));
        Yii::info('----------wx duan info userId'.$this->userId);
        Yii::info('----------wx duan info staffId'.$this->staffId);
        Yii::info('----------wx duan info jobId'.$this->jobId);
        $info = Yii::$app->cache->set($token, $info, 10 * 24 * 3600);
    }
}
