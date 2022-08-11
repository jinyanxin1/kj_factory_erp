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
use common\models\user\UserApiLoginModel;
use common\models\user\UserModel;
use \Yii;
use yii\base\Action;
use yii\base\Exception;
use yii\helpers\Json;

class LoginAction extends Action
{

    public function run(){
        $code = Yii::$app->request->post('code');
        $wxUserInfo = Yii::$app->request->post('userInfo');

        \Yii::info('code:' . $code);

        //根据code得到openid
        $wxSmallProgram = Yii::$app->wxSmallProgram;

        $isBind = false;
        $tran = Yii::$app->db->beginTransaction();
        $menuList = [];
        try {
            $info = $wxSmallProgram->getOpenIdByCode($code);

            Yii::info('微信授权数据：' . Json::encode($info));

            if( (isset($info['unionId'])) && (!empty($info['unionId'])) ){
                $unionId = $info['unionId'];
            }
            if( ($info['openId'] === false) || empty($info['openId']) ){
                return $this->returnApi(Code::PARAM_ERR, '获取用户openid失败');
            }
            if( ($info['sessionKey'] === false) || empty($info['sessionKey']) ){
                return $this->returnApi(Code::PARAM_ERR, '获取用户sessionKey失败');
            }
            $token = $info['sessionKey'];
            $openId = $info['openId'];
            $unionId = $info['unionId'];

            if (empty($token)) {
                return '未获取到用户标志';
            }
            $data = [
                'openInfo' => AuthCode::authcode($openId, 'ENCODE', WXUserAuth::WEIXIN_COOKIE_KEY),
                'userInfo' => '',
                'staffId' => '',
                'jobId' => '',
            ];

            $openInfo = UserApiLoginModel::getByOpenId($openId);
            $userInfo = [];


            $userNetName = $wxUserInfo['nickName'] ?? '';
            $userPicUrl = $wxUserInfo['avatarUrl'] ?? '';
            $sex = $wxUserInfo['gender'] ?? '';

            if(!empty($openInfo)){
                if(!empty($openInfo->loginUserId)){
                    $data['userInfo'] = AuthCode::authcode($openInfo->loginUserId, 'ENCODE', WXUserAuth::WEIXIN_COOKIE_KEY);
                    $isBind = true;
                    $userInfo = UserModel::find()
                        ->select(['id as userId','staffId','checkStatus',
                            'jobId','tel as phone','groupId','userAccount','userType','userName'])
                        ->where(['id' => $openInfo->loginUserId])
                        ->andWhere(['isValid' => UserModel::IS_VALID_OK])
                        ->asArray()
                        ->one();
                    $data['staffId'] = AuthCode::authcode($userInfo['staffId'], 'ENCODE', WXUserAuth::WEIXIN_COOKIE_KEY);

                    $menuList = [];
                    if ( $userInfo['checkStatus'] == 1) {
                        $data['staffId'] = AuthCode::authcode(0, 'ENCODE', WXUserAuth::WEIXIN_COOKIE_KEY);
                        $userInfo['staffId'] = 0 ;

                    } else {
                        $menuList =  AdminPowerModel::getMenuList($userInfo['groupId'],1);

                    }
                    $data['jobId'] = AuthCode::authcode($userInfo['jobId'], 'ENCODE', WXUserAuth::WEIXIN_COOKIE_KEY);


                }
                $openInfo->netName = base64_encode($userNetName);
                $openInfo->pic = $userPicUrl;
                $openInfo->sex = $sex;
                $openInfo->userLoginTime = date('Y-m-d H:i:s');
                $openInfo->save();
            }else{
                $openInfo = new UserApiLoginModel();
                $openInfo->netName = base64_encode($userNetName);
                $openInfo->pic = $userPicUrl;
                $openInfo->sex = $sex;
                $openInfo->userLoginTime = date('Y-m-d H:i:s');
                $openInfo->loginName = $openId;
                $openInfo->loginPlat = 'weixin';
                $openInfo->unionId = $unionId;
                $openInfo->isValid = UserApiLoginModel::IS_VALID_OK;
                $openInfo->save();
            }
            //将token存至缓存
            $token = md5($openId);
            Yii::info('token信息：'. $token . 'msg:' . Json::encode($data));
            Yii::$app->cache->set($token, Json::encode($data), 10 * 24 * 3600);

//            删除该用户其他登录用户的token
//            $openList = UserApiLoginModel::find()->where(['loginUserId' => $openInfo->loginUserId])
//                ->andWhere(['!=', 'loginName', $openId])->asArray()->all();
//            if(!empty($openList)){
//                foreach ($openList as $item) {
//                    if(isset($item['loginName'])){
//                        Yii::$app->cache->set(md5($item['loginName']), '');
//                    }
//                }
//            }

            $tran->commit();
        }catch(Exception $exception){
            $tran->rollBack();
            Yii::info('登录授权失败'. $exception->getMessage());
            return '未找到您的用户信息，请联系管理员';
        }

        return $this->returnApi(Code::SUCCESS, 'ok',
            ['token' => $token , 'bind' => $isBind ,
                'imgUrl' => Yii::$app->params['imageUrl'],
                'menuList' =>$menuList,
                'userInfo' => $userInfo
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