<?php
/**
 * 登录方法
 * Created by PhpStorm.
 * User: zhouky
 * Date: 2019/7/30
 * Time: 11:55
 */

namespace backend\actions\login;



use backend\actions\BaseAction;
use backend\models\auth\LoginForm;
use common\library\helper\Code;
use common\models\User;
use common\models\user\UserModel;
use Yii;
use yii\helpers\Json;

class LoginAction extends BaseAction
{

    public function run()
    {
        $adminAccount = trim($this->request()->post('userAccount', ''));
        $adminPwd = trim($this->request()->post('userPwd', ''));
//        $verifyCode = $this->request()->post('verifyCode', '');
//        $cookies = Yii::$app->response->cookies;
        if (empty($adminAccount)) {
            return $this->returnApi(Code::NORMAL_ERR, '请输入账号！');

        }
        if (empty($adminPwd)) {
            return $this->returnApi(Code::NORMAL_ERR, '请输入密码！');

        }
        $userInfo = User::findByUsername($adminAccount);
        if (empty($userInfo)) {
            return $this->returnApi(Code::NORMAL_ERR, '用户名错误！');
        }

        if ($userInfo->checkStatus == 1 || empty($userInfo->staffId)) {
            return $this->returnApi(Code::NORMAL_ERR, '无法登陆');
        }



        $loginModel = new LoginForm();
        $loginModel->adminAccount = $adminAccount;
        $loginModel->adminPwd = $adminPwd;
        $loginModel->userType = UserModel::STAFF;
//        $loginModel->verifyCode = $verifyCode;

        /*
             //验证登陆错误次数
            $accountLoginNumKey = 'web:loginNum:'.$adminAccount;
            $accountLoginNum = intval(Yii::$app->cache->get($accountLoginNumKey));
        //超过三次需要验证码
            if ($accountLoginNum > 3) {
                $loginModel->codeKey = true;
            }
        */

        if ($loginModel->login()) {
            $userId = Yii::$app->user->id;
            $userInfo = User::find()->where(array('id' => $userId, 'isValid' => User::IS_VALID_OK))->one();

            if (!empty($userInfo)) {
                $authKey = Yii::$app->user->identity->getAuthKey();

                $key = 'user_key_' . str_replace('.', '@', Yii::$app->user->identity->userAccount);
                Yii::info('登录key:' . $key);
                //将authKey设置cookie中
                Yii::$app->cache->set($key, Json::encode([
                    'name' => $key,
                    'value' => $authKey,
                ]), 10 * 24 * 3600);

                $token = base64_encode($key);

                $data = array(
                    'accessToken' => $token,
                    'userInfo' => [
                        'adminAccount' => $userInfo->userAccount,
                        'userId' => $userInfo->id,
                        'staffId' => $userInfo->staffId,
                        'groupId' => $userInfo->groupId,
                        'userName' => $userInfo->userName
                    ],
                    'imgUrl' => Yii::$app->params['imageUrl']

                );
//                Yii::$app->cache->set($accountLoginNumKey,0,60*3);
                return $this->returnApi(Code::SUCCESS, 'ok', $data);
            } else {
                return $this->returnApi(Code::NORMAL_ERR, '登录失败', ['verify' => $loginModel->codeKey]);
            }
        } else {
//            $accountLoginNum++;
//            Yii::$app->cache->set($accountLoginNumKey,$accountLoginNum,60*3);
            $firstItem = $loginModel->getErrors();
            foreach ($firstItem as $value) {
//                return $this->returnApi(Code::PARAM_ERR ,$value[0],['verify' => $accountLoginNum > 3 ? true : false]);
                return $this->returnApi(Code::PARAM_ERR, $value[0], []);
            }
        }
    }
}