<?php
/**
 * Created by lanww.
 * User: lanww
 * Date: 2019/7/30
 * Time: 16:22
 */

namespace backend\actions\user;


use backend\actions\BaseAction;
use common\library\helper\Code;
use common\models\User;

class UpdateAction extends BaseAction
{

    public function run()
    {
        $request = \Yii::$app->request->post();
        $userId = isset($request['id']) ? $request['id'] : '';
        $userPwd = isset($request['userPwd']) ? trim($request['userPwd']) : '';
//        $userName = isset($request['userName']) ? $request['userName'] : '';
//        $tel = isset($request['tel']) ? $request['tel'] : '';
//        $email = isset($request['email']) ? $request['email'] : '';
//        $company = isset($request['company']) ? $request['company'] : '';
        $groupId = isset($request['groupId']) ? $request['groupId'] : 0;
//        $userType = \Yii::$app->request->post('userType',0);


        $user = User::find()->where(['id' => $userId, 'isValid' => User::IS_VALID_OK])->one();

        if (empty($user)) {
            return $this->returnApi(Code::PARAM_ERR, '用户不存在');
        }

//        $user->userName = $userName;
//        $user->tel = $tel;
//        $user->email = $email;
//        $user->company = $company;
        $user->groupId = $groupId;
        if (!empty($userPwd)) {
            $user->setPassword($userPwd);
        }

//        $user->userType = $userType;

        if (!$user->validate()) {
            $firstItem = $user->getErrors();
            foreach ($firstItem as $value) {
                return $this->returnApi(Code::PARAM_ERR ,$value[0]);
            }
        }

        if (!empty($userPwd)) {
            //判断长度
            if (strlen($userPwd) < 6 || strlen($userPwd) > 64) {
                return $this->returnApi(Code::PARAM_ERR ,'密码的长度为6-64个字符');
            }
            $preg_match = '/^(?![0-9]+$)(?![a-zA-Z]+$)(?![0-9a-zA-Z]+$)(?![0-9\\W]+$)(?![a-zA-Z\\W]+$)[0-9A-Za-z\_\\W]{6,64}$/';
            //判断格式 必须有字母 数字 特殊符号
            if (preg_match($preg_match,
                $userPwd
            ) == 0) {
                return $this->returnApi(Code::PARAM_ERR ,'密码中必须包含字母、数字和特殊字符');
            }

            $user->userPwd = \Yii::$app->security->generatePasswordHash($userPwd);
        }

        if ($user->save()) {
            return $this->returnApi(Code::SUCCESS, '修改成功');
        } else {
            return $this->returnApi(Code::PARAM_ERR, '修改失败');
        }
    }
}
