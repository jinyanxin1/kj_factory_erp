<?php
/**
 * Created by PhpStorm.
 * User: zhouk
 * Date: 2019/8/1
 * Time: 17:46
 */

namespace frontend\actions\group;


use frontend\actions\WxAction;
use common\library\helper\Code;
use common\models\admin\AdminModel;
use common\models\adminGroup\AdminGroupfrontend;
use common\models\User;

class DeleteAction extends WxAction
{

    public function run(){
        $id = intval($this->request()->post('groupId'));

        \Yii::info('删除分组：id:'.$id);

        if (empty($id)){
            return $this->returnApi(Code::NOT_FOUND, '未找到分组');
        }

        $groupInfo = AdminGroupfrontend::findOne(['isValid' => AdminGroupfrontend::IS_VALID_OK, 'groupId' => $id]);
        if(empty($groupInfo)){
            return $this->returnApi(Code::NOT_FOUND, '未找到分组');
        }

        //todo 判断分组是否已经使用 (改成判断分组下方是否存在用户
        $adminList = User::getListByGroup($id);
        if(!empty($adminList)){
            return $this->returnApi(Code::POWER_ERR, '该分组已被使用，请勿删除');
        }

        $groupInfo->isValid = AdminGroupfrontend::IS_VALID_NO;
        $update = $groupInfo->save();

        if($update) {
            return $this->returnApi(Code::SUCCESS, 'ok');
        }else{
            return $this->returnApi(Code::SYSTEM_ERR, '操作失败');
        }
    }

}