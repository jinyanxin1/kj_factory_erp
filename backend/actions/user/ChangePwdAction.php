<?php
/**
 *
 * author: jinyanxin
 * Date: 2020/6/19
 * Time: 11:41
 * PHP version 7
 */

namespace backend\actions\user;


use backend\actions\BaseAction;
use common\models\User;
use Yii;

class ChangePwdAction extends BaseAction
{

    public function run()
    {
        $staffId = intval($this->request()->post('staffId'));
        $oldPwd = $this->request()->post('userPwd');
        $pwd = $this->request()->post('newPwd');
        $checkPwd = $this->request()->post('checkPwd');

        if(empty($staffId)){
            return $this->returnApi(100,'用户不能为空');
        }

        if($pwd !== $checkPwd){
            return $this->returnApi(100,'两次密码不一致');
        }
        $user = User::find()->where(['staffId'=>$staffId,'isValid'=>User::IS_VALID_OK])->one();
        if(empty($user)){
            return $this->returnApi(100,'用户不存在');
        }

        if(!Yii::$app->security->validatePassword($oldPwd,$user->userPwd)){
            return $this->returnApi(100,'原密码错误');
        }
        $user->setPassword($pwd);
        if(!$user->save()){
            return $this->returnApi(100,'修改失败');
        }
        return $this->returnApi(0,'修改成功');
    }

}