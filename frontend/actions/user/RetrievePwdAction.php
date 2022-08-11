<?php
/**
 *
 * author: jinyanxin
 * Date: 2020/6/1
 * Time: 11:49
 * PHP version 7
 */

namespace frontend\actions\user;


use common\library\helper\Code;
use common\models\SmsLog;
use common\models\User;
use Yii;
use yii\base\Action;

class RetrievePwdAction extends  Action
{

    public function run()
    {
        $request = Yii::$app->request->post();

        $userAccount = Yii::$app->request->post('userAccount');
        $tel = isset($request['tel']) ? $request['tel'] : '';
        $code = isset($request['code']) ? $request['code'] : '';
        $userPwd = isset($request['userPwd']) ? $request['userPwd'] : '';
        $checkPwd = isset($request['checkPwd']) ? $request['checkPwd'] : '';

        if(empty($tel) || empty($userPwd)){
            return $this->returnApi(Code::PARAM_ERR,'手机号或密码不能为空');
        }
        $user  = User::find()
            ->where(['tel' => $tel, 'userAccount' => $userAccount])
            ->one();
        if(empty($user)){
            return $this->returnApi(Code::PARAM_ERR, '用户未找到');
        }

        //短信验证码验证
        $checkCode = SmsLog::checkCode($tel,$code,$user->userAccount,SmsLog::TYPE_ONE);
        if($checkCode['code'] !== 0){
            return $this->returnApi($checkCode['code'],$checkCode['msg']);
        }

        if($userPwd !== $checkPwd){
            return $this->returnApi(100,'两次密码不一致');
        }

        $user->setPassword($userPwd);
        $user->updater = $user->userAccount;
        try{
            if(!$user->save()){
                throw new \Exception('密码保存失败');
            }
            SmsLog::updateAll(['isCheck'=>SmsLog::IS_CHECK],['tel'=>$tel,'code'=>$checkCode]);
        }catch (\Exception $e){
            Yii::info('-----retrieve pwd fail---'.$e->getMessage());
            return $this->returnApi(100,'修改失败');
        }

        return $this->returnApi(0,'修改成功');

    }

    public function returnApi($code = 0, $msg = '', $data = []){
        $result = [
            'ret' => $code,
            'msg' => $msg,
            'data' => $data,
        ];
        header('Content-type: application/json');
        return $result;
    }

}