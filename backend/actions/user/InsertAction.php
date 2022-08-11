<?php
/**
 * Created by lanww.
 * User: lanww
 * Date: 2019/8/1
 * Time: 14:40
 */

namespace backend\actions\user;


use backend\actions\BaseAction;
use common\models\SignupForm;


class InsertAction extends BaseAction
{

    public function run()
    {

        $request = \Yii::$app->request->post();
        $userAccount = isset($request['tel']) ? $request['tel'] : '';
        $userPwd = isset($request['userPwd']) ? $request['userPwd'] : '';
        $userName = isset($request['userName']) ? $request['userName'] : '';
        $tel = isset($request['tel']) ? $request['tel'] : '';
        $email = isset($request['email']) ? $request['email'] : '';
        $company = isset($request['company']) ? $request['company'] : '';
        $groupId = isset($request['groupId']) ? $request['groupId'] : 0;

        $signUp = new SignupForm();
        $signUp->userAccount = $userAccount;
        $signUp->userPwd = $userPwd;
        $signUp->userName = $userName;
        $signUp->tel = $tel;
        $signUp->email = $email;
        $signUp->company = $company;
        $signUp->groupId = $groupId;
        $result = $signUp->signup();

        return $this->returnApi($result['code'], $result['msg']);

    }
}
