<?php
/**
 * Created by cqj
 * User: cqj
 * Date: 2020/5/18
 * Time: 14:19
 */

namespace backend\actions\user;


use backend\actions\BaseAction;
use common\library\helper\Code;
use common\models\User;

class ResetAction extends BaseAction
{
    public function run()
    {
        $userId = \Yii::$app->request->post('id');

        $user = User::find()->where(['id' => $userId, 'isValid' => User::IS_VALID_OK])->one();

        if (empty($user)) {
            return $this->returnApi(Code::PARAM_ERR, '用户不存在');
        }

        $pwd = $this->getPwd();
        $user->setPassword($pwd);

        if ($user->save()) {
            return $this->returnApi(Code::SUCCESS, '重置成功',['userPwd' => $pwd]);
        } else {
            return $this->returnApi(Code::PARAM_ERR, '重置失败');
        }
    }

    public function getPwd() {
        $totalChar = 8; // 密码中字符串的个数
        $salt = "abcdefghijklmnpqrstuvwxyzABCDEFGHIJKLMNPQRSTUVWXYZ123456789";
        srand((double)microtime()*1000000); // 启动随机产生器
        $Spass=""; // 设置初始值
        for ($i=0;$i<$totalChar;$i++) // 循环创建密码
            $Spass = $Spass . substr ($salt, rand() % strlen($salt), 1);

        return $Spass.'@' ;

    }
}