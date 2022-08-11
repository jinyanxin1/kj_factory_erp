<?php
/**
 * Created by PhpStorm.
 * User: zhouk
 * Date: 2019/11/16
 * Time: 11:39
 */

namespace frontend\actions\auth;


use common\models\user\UserModel;
use frontend\actions\WxAction;
use common\library\helper\Code;
use common\models\admin\AdminPowerModel;
use\Yii;
use yii\web\Cookie;

class CheckTokenAction extends WxAction
{

    public function run(){
        $token = $this->request()->post('token');
        $this->userId;
        $userInfo = UserModel::getById($this->userId);
        $data = array(
            'accessToken' => $token,
            'menuList' => AdminPowerModel::getMenuList($userInfo['groupId'],1),
            'imgUrl' => Yii::$app->params['imageUrl'],
            'userInfo' => [
                'adminAccount'=>$userInfo['userAccount'],
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