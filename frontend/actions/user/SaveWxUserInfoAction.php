<?php
/**
 * Created by PhpStorm.
 * User: zhouk
 * Date: 2019/8/21
 * Time: 17:59
 */

namespace frontend\actions\user;


use common\library\helper\Code;
use common\models\jobInfo\JobInfoModel;
use common\models\staffInfo\StaffInfoModel;
use common\models\user\UserModel;
use frontend\actions\WxAction;
use \Yii;
use yii\helpers\Json;

class SaveWxUserInfoAction extends WxAction
{

    public function run(){
//        $openId = $this->openId ;
//        if( empty($openId) ){
//            return $this->returnApi(Code::USER_ERR, '未授权小程序');
//        }
        $userName = Yii::$app->request->post('userName');
        $tel = Yii::$app->request->post('phone');



        //保存用户详情
        $sysUserInfo = UserModel::find()
            ->where(array('id' => $this->userId,'isValid'=> UserModel::IS_VALID_OK))
            ->one();

        $sysUserInfo->userName = $userName;
        $sysUserInfo->tel = $tel;
        $saveSysUser = $sysUserInfo->save();
        if( !$saveSysUser ){
            return $this->returnApi(Code::PARAM_ERR, '用户详情保存失败');
        }
        Yii::info('用户信息=====================================');
        Yii::info(Json::encode($sysUserInfo));
        Yii::info('用户信息=====================================');
        switch ($sysUserInfo->userType) {
            case UserModel::JOB:
                $job = JobInfoModel::getById($sysUserInfo->jobId);
                $job->name = $userName;
                $job->phone = $tel;
                $job->save();
                break;
            case UserModel::STAFF:
                $staff = StaffInfoModel::getById($sysUserInfo->staffId);
                $staff->name = $userName;
                $staff->phone = $tel;
                $staff->save();
                break;
        }

        return $this->returnApi(Code::SUCCESS, 'ok');
    }
}