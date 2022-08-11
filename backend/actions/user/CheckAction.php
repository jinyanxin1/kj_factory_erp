<?php
/**
 * Created by cqj
 * User: cqj
 * Date: 2020/5/18
 * Time: 14:45
 */

namespace backend\actions\user;


use backend\actions\BaseAction;
use common\library\helper\Code;
use common\models\User;

class CheckAction extends BaseAction
{
    public function run() {
        $request = \Yii::$app->request->post();
        $userId = \Yii::$app->request->post('id',0);
        $userType = \Yii::$app->request->post('userType',0);

        $user = User::find()
            ->where(['id' => $userId, 'isValid' => User::IS_VALID_OK])
            ->one();

        if (empty($user)) {
            return $this->returnApi(Code::PARAM_ERR, '用户不存在');
        }

//        if (!empty($user->userType)) {
//            return $this->returnApi(Code::PARAM_ERR, '已分配的用户无法重新分配');
//        }

        $user->userType = $userType;

        if ($user->save()) {
            return $this->returnApi(Code::SUCCESS, '操作成功');
        } else {
            return $this->returnApi(Code::PARAM_ERR, '操作成功');
        }
    }
}