<?php
/**
 * Created by lanww.
 * User: lanww
 * Date: 2019/7/31
 * Time: 15:51
 */

namespace common\models\user;


use common\models\BaseModel;

class UserAddressModel extends BaseModel
{

    public static function tableName()
    {
        return 'kj_sys_user_address';
    }
}
