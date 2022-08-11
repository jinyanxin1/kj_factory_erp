<?php
/**
 * Created by cqj
 * User: cqj
 * Date: 2020/5/23
 * Time: 9:42
 */

namespace backend\actions\user;


use backend\actions\BaseAction;
use common\library\helper\Code;
use common\models\user\UserModel;

class UserTypeAction extends BaseAction
{
    public function run() {
        $labe = [] ;
        foreach (UserModel::$ENUM_TYPE as $key => $value) {
            $labe[] = [
                'label' => $value,
                'value' => $key
            ];
        }
        return $this->returnApi(Code::SUCCESS, 'ok',$labe);
    }
}