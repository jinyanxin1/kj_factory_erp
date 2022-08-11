<?php
/**
 * @Author: jinyanxin
 * @Date: 2019/12/20
 * @Time: 15:17
 * 微信用户登录账户记录表
 */


namespace common\models\user;


use common\models\BaseModel;

class UserLoginAccount extends BaseModel
{

    public static function tableName()
    {
        return 'kj_user_login_account';
    }

}