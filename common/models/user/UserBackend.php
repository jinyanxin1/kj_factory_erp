<?php
/**
 * Created by lanww.
 * User: lanww
 * Date: 2019/7/30
 * Time: 15:41
 */

namespace common\models\user;


use common\models\User;

class UserBackend extends UserModel
{

    /*
     * 数据处理
     * */
    public function handle($data = array())
    {

        if (empty($data)) {
            return $data;
        }

        foreach ($data as $key => $value) {
            $data[$key]['userType'] = self::$ENUM_TYPE[$value['userType']] ?? '';
        }

        return $data;
    }
}
