<?php
/**
 * 查看权限，分配权限
 * Created by PhpStorm.
 * User: zhouk
 * Date: 2019/8/2
 * Time: 1:58
 */

namespace frontend\actions\auth;


use frontend\actions\WxAction;
use common\library\helper\Code;
use common\models\admin\AdminMenuModel;

class AuthInfoAction extends WxAction
{

    public function run(){

        //得到当前用户所能控制的菜单
        $userId = \Yii::$app->user->identity->id;
        $groupId = $this->request()->post('groupId');

        $menuData = AdminMenuModel::getMenuByLoginAdminIdAndGroupId($userId,$groupId);

        if($menuData['code'] === 0){
            return $this->returnApi(Code::SUCCESS, 'ok', ['list' => $menuData['data']]);
        }else{
            return $this->returnApi(Code::PARAM_ERR,$menuData['msg']);
        }

    }

}