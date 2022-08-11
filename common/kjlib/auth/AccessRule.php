<?php
/**
 * Created by PhpStorm.
 * User: zhoukey
 * Date: 2016/8/20 0020
 * Time: 11:13
 * 权限管理
 */
namespace common\kjlib\auth;

use common\models\User;

class AccessRule extends \yii\filters\AccessRule
{

    protected function matchRole($user)
    {

        if (count($this->roles) === 0) {
            return true;
        }
//        var_dump($this->roles);exit;
        foreach ($this->roles as $role) {
            if ($role === '?') {
                if ($user->getIsGuest()) {
                    return true;
                }
            } elseif ($role == '@') {
                if (!$user->getIsGuest()) {
                    return true;
                }
            } elseif ($role === $user->identity->userRole) {
                if (!$user->getIsGuest()) {
                    return true;
                }
            }
        }
        return false;
    }


}