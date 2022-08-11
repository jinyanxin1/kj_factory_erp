<?php
/**
 * User: cqj
 * Date: 2020/7/20
 * Time: 4:40 下午
 */

namespace frontend\actions\user;


use common\kjlib\auth\AuthCode;
use common\kjlib\auth\WXUserAuth;
use common\library\helper\Code;
use common\models\admin\AdminPowerModel;
use common\models\User;
use common\models\user\UserApiLoginModel;
use common\models\user\UserModel;
use yii\base\Action;
use yii\helpers\Json;

class BindAction extends Action
{
    public function run(){
        $adminAccount = trim(\Yii::$app->request->post('userAccount', ''));
        $adminPwd = trim(\Yii::$app->request->post('userPwd', ''));
        $type = \Yii::$app->request->post('type');
        $token = trim(\Yii::$app->request->post('token', ''));

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
        if ($userInfo->checkStatus == 1) {
            return $this->returnApi(Code::NORMAL_ERR, '无法登陆');
        }
        $pwdKey = $userInfo->validatePassword($adminPwd);
        if (!$pwdKey) {
            return $this->returnApi(Code::NORMAL_ERR, '密码错误！');
        }

        $info = \Yii::$app->cache->get($token);
        \Yii::info('token:'.$token);
        \Yii::info('token[data]:'.Json::encode($info));
        if (empty($info)) {
            return $this->returnApi(Code::NORMAL_ERR, '请授权小程序登陆');
        }
        $data = Json::decode($info);
        $openInfo = $data['openInfo'] ?? '';
        $openId = AuthCode::authcode($openInfo, 'DECODE', WXUserAuth::WEIXIN_COOKIE_KEY);
        \Yii::info("openId:$openId");
        //判断小程序号是否绑定了其他账号
        $userApi = UserApiLoginModel::getByOpenId($openId);

        if (empty($userApi)) {
            return $this->returnApi(Code::NORMAL_ERR, '请授权小程序登陆');
        }

        if (!empty($userApi->loginUserId)) {
            return $this->returnApi(Code::NORMAL_ERR, '该微信已绑定账号');
        }

        $userApi->loginUserId = $userInfo->id;
        $userApi->save();


        $info = \Yii::$app->cache->get($token);
        $data = Json::decode($info);


        $user = UserModel::find()
            ->select(['id as userId','staffId','tel as phone','jobId','userType','groupId','userAccount','userName'])
            ->where(['id' => $userInfo->id])
            ->andWhere(['isValid' => UserModel::IS_VALID_OK])
            ->asArray()
            ->one();
        $menuList =  AdminPowerModel::getMenuList($user['groupId'],1);

        $data['userInfo'] = AuthCode::authcode($user['userId'], 'ENCODE', WXUserAuth::WEIXIN_COOKIE_KEY);
        $data['staffId'] = AuthCode::authcode($user['staffId'], 'ENCODE', WXUserAuth::WEIXIN_COOKIE_KEY);
        $data['jobId'] = AuthCode::authcode($user['jobId'], 'ENCODE', WXUserAuth::WEIXIN_COOKIE_KEY);
        \Yii::info('token信息：'. $token . 'msg:' . Json::encode($data));
        \Yii::$app->cache->set($token, Json::encode($data), 1 * 24 * 3600);

        return $this->returnApi(Code::SUCCESS, 'ok',
            [
                'token' => $token ,
                'imgUrl' => \Yii::$app->params['imageUrl'],
                'userInfo' => $user,
                'menuList' => $menuList
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