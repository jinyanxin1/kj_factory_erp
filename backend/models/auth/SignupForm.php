<?php

namespace backend\models\auth;

use common\models\admin\AdminModel;
use common\models\BaseForm;
use common\models\user\UserModel;

/**
 * Signup form
 */
class SignupForm extends BaseForm
{
    public $adminId;
    public $adminAccount;
    public $adminPwd;
    public $groupId;
    public $adminName;
    public $adminTel;
    public $adminCreateTime;
    public $adminLastOpTime;
    public $adminStatus;
    public $adminAuthkey;
    public $isValid;


    public function signUp($data,$cUser = true)
    {
        if (!$this->validate()) {
            return null;
        }

        //注册，kj_sys_user加数据
        if ( $cUser ) {
            $sysUser = new UserModel();
            $sysUser->userSatus =  UserModel::STATUS_OK;
            $sysUser->userGroupId = $data['groupId'];
            $sysUser->userRealName = $data['adminName'];
            $sysUser->userVip = $data['userVip'];
            if( !$sysUser->save() ) {
                return null;
            } else {
                $data['userId'] = $sysUser->userId ;
            }
        }


        $user = new AdminModel();
        $user->adminAccount = $data['adminAccount'];
        $user->groupId = $data['groupId'];
        $user->adminName = isset($data['adminName']) ? $data['adminName'] : '' ;
        $user->userId = isset($data['userId'])?$data['userId']:0 ;
        $user->adminStatus = $data['adminStatus'];
        $user->isValid = AdminModel::IS_VALID_OK;
        
        //学样管理员
        if(isset($data['adminStatus'])&& $data['adminStatus']>0 ) {
            $user->isSuperAdmin = AdminModel::NO_SUPER_ADMIN;
        } else {
            $user->isSuperAdmin = AdminModel::IS_SUPER_ADMIN;
        }
        $user->setPassword($data['adminPwd']);
        $user->generateAuthKey();

        return $user->save() ? $user : null;
    }

}
