<?php
/**
 * Created by cqj
 * User: cqj
 * Date: 2020/5/18
 * Time: 16:31
 */

namespace backend\actions\user;


use backend\actions\BaseAction;
use common\library\helper\Code;
use common\models\User;

class InfoAction extends BaseAction
{
    public function run() {
        $userId = \Yii::$app->request->post('id');

        $user = User::find()
            ->select(['id','userAccount','userType','userName','tel','email','company','groupId'])
            ->where(['staffId' => $userId, 'isValid' => User::IS_VALID_OK])
            ->limit(1)
            ->asArray()
            ->one();

        return $this->returnApi(Code::SUCCESS, 'ok',$user);

    }
}