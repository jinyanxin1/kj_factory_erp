<?php
/**
 * Created by PhpStorm.
 * User: zhouk
 * Date: 2019/11/16
 * Time: 11:39
 */

namespace backend\actions\auth;


use backend\actions\BaseAction;
use common\library\helper\Code;
use common\models\admin\AdminPowerModel;
use common\models\adminGroup\AdminGroupBackend;
use common\models\entrust\EntrustModel;
use common\models\port\PortModel;
use common\models\project\ProjectModel;
use common\models\task\TaskModel;
use\Yii;
use yii\web\Cookie;

class CheckTokenAction extends BaseAction
{

    public function run(){

        if(Yii::$app->user->isGuest){
            return $this->returnApi(Code::LOGIN_ERR, '用户不存在');
        }

        $authKey = Yii::$app->user->identity->getAuthKey();
        $key = 'user_key_'. str_replace('.', '@', Yii::$app->user->identity->userAccount);
        $cookies = Yii::$app->request->cookies;
        $data = $cookies->getValue($key);
        if(empty($data)){
            $cookies = Yii::$app->response->cookies;
            $cookies->remove($key);
            $cookies->add(new Cookie(array(
                'name' => $key,
                'value' => $authKey,
                'expire' => time() + 3600 * 4
            )));
        }
        $token = base64_encode($key);

        $userInfo = Yii::$app->user->identity;
        Yii::info('------auth logo info---groupId'.Yii::$app->user->identity->groupId.'---acount'.Yii::$app->user->identity->userAccount);
        $data = array(
            'accessToken' => $token,
            'menuList' => AdminPowerModel::getMenuList(Yii::$app->user->identity->groupId,0),
            'userInfo' => [
                'adminAccount'=>$userInfo['userAccount'],
                'adminAuthkey'=>$userInfo['authkey'],
                'userId'=>$userInfo['id'],
                'groupId'=>$userInfo['groupId'],
                'userName'=>$userInfo['userName']
            ],
        );
        return $this->returnApi(Code::SUCCESS, 'ok', $data);
    }


    private function formateList($list)
    {
        $returnArr = [];
        if(count($list) > 0){
            foreach($list as $k=>$v){
                $returnArr[] = ['key'=>$k,'value'=>$v];
            }
        }
        return $returnArr;
    }

}