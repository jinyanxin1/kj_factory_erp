<?php
/**
 * Created by PhpStorm.
 * User: zhouk
 * Date: 2019/12/5
 * Time: 10:56
 */

namespace frontend\actions\user;



use common\library\helper\Code;
use common\models\User;
use common\models\user\UserModel;
use frontend\actions\WxAction;

class ChangePwdAction extends WxAction
{
    public function run(){
        $oldPwd = trim($this->request()->post('oldPwd'));
        $newPwd = trim($this->request()->post('newPwd'));
        $checkPwd = trim($this->request()->post('checkPwd'));

        if(empty($oldPwd)){
            return $this->returnApi(Code::PARAM_ERR, '请填写原密码');
        }
        if(empty($newPwd)){
            return $this->returnApi(Code::PARAM_ERR, '请填写新密码');
        }
        if(empty($checkPwd)){
            return $this->returnApi(Code::PARAM_ERR, '请填写确认密码');
        }

        if(strlen($newPwd) < 4){
            return $this->returnApi(Code::PARAM_ERR, '您的密码太简单，请重设');
        }

        if(strlen($newPwd) > 16){
            return $this->returnApi(Code::PARAM_ERR, '您的密码太长，请重设');
        }

        if($newPwd !== $checkPwd){
            return $this->returnApi(Code::PARAM_ERR, '两次输入密码不一致，请确认');
        }


        $userInfo = User::find()->where(['id' => $this->userId])->one();

        //校验密码
        if(!\Yii::$app->security->validatePassword($oldPwd, $userInfo->userPwd)) {
            return $this->returnApi(Code::PARAM_ERR, '密码错误');
        }

        $userInfo->setPassword($newPwd);
        $save = $userInfo->save();

        if($save){
            return $this->returnApi(Code::SUCCESS, '修改成功');
        }else{
            return $this->returnApi(Code::SUCCESS, '修改成功');
        }
    }

}