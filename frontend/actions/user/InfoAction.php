<?php
/**
 * User: cqj
 * Date: 2020/7/20
 * Time: 4:26 下午
 */

namespace frontend\actions\user;


use common\library\helper\Code;
use common\models\user\UserModel;
use frontend\actions\WxAction;

class InfoAction extends WxAction
{
    public function run(){

        $user = UserModel::find()
            ->select(['id','userAccount','staffId','jobId','userType','userName'])
            ->where(['id' => $this->userId])
            ->asArray()
            ->one();
        return $this->returnApi(Code::SUCCESS , 'ok', ['info' => $user]);
    }
}