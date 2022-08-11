<?php
/**
 * Created by PhpStorm.
 * User: zhouk
 * Date: 2019/8/17
 * Time: 17:02
 */

namespace frontend\actions\user;


use common\kjlib\auth\AuthCode;
use common\kjlib\auth\WxBease;
use common\kjlib\auth\WXUserAuth;
use common\library\helper\Code;
use common\models\admin\AdminPowerModel;
use common\models\User;
use common\models\user\UserApiLoginModel;
use common\models\user\UserModel;
use \Yii;
use yii\base\Action;
use yii\base\Exception;
use yii\helpers\Json;

class LoginAdminAction extends Action
{

    public function run(){
        $adminAccount = trim(Yii::$app->request->post('userAccount', ''));
        $adminPwd = trim(Yii::$app->request->post('userPwd', ''));

        if (empty($adminAccount)) {
            return $this->returnApi(Code::NORMAL_ERR, '请输入账号！');

        }
        if (empty($adminPwd)) {
            return $this->returnApi(Code::NORMAL_ERR, '请输入密码！');

        }
        $userInfo = User::findByUsername($adminAccount);
        if (empty($userInfo)) {
            return $this->returnApi(Code::NORMAL_ERR, '账号错误！');
        }


        $pwdKey = $userInfo->validatePassword($adminPwd);

        if (!$pwdKey) {
            return $this->returnApi(Code::NORMAL_ERR, '密码错误！');
        }

        $data = [
            'userInfo' => AuthCode::authcode($userInfo->id, 'ENCODE', WXUserAuth::WEIXIN_COOKIE_KEY),
            'staffId' => '',
            'jobId' => '',
            'openInfo' => ''
        ];
        $user = [];
        $menuList = [];
        $user = UserModel::find()
            ->select(['id as userId','checkStatus','staffId','tel as phone',
                'jobId','groupId','userAccount','userName'])
            ->where(['id' => $userInfo->id])
            ->andWhere(['isValid' => UserModel::IS_VALID_OK])
            ->asArray()
            ->one();

        $data['staffId'] = AuthCode::authcode($userInfo['staffId'], 'ENCODE', WXUserAuth::WEIXIN_COOKIE_KEY);

        $data['jobId'] = AuthCode::authcode($userInfo['jobId'], 'ENCODE', WXUserAuth::WEIXIN_COOKIE_KEY);
        //将token存至缓存
        $token = md5($userInfo->authKey);
        Yii::info('token信息：'. $token . 'msg:' . Json::encode($data));
        Yii::$app->cache->set($token, Json::encode($data), 10 * 24 * 3600);

        return $this->returnApi(Code::SUCCESS, 'ok',
            [
                'token' => $token ,
                'menuList' =>$menuList,
                'imgUrl' => Yii::$app->params['imageUrl'],
                'userInfo' => $user
            ]);

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