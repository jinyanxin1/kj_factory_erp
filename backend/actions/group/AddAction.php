<?php
/**
 * Created by PhpStorm.
 * User: zhouk
 * Date: 2019/8/2
 * Time: 1:43
 */

namespace backend\actions\group;


use backend\actions\BaseAction;
use common\library\helper\Code;
use common\models\adminGroup\AdminGroupBackend;

class AddAction extends BaseAction
{

    public function run(){
        $groupName = $this->request()->post('groupName');
        $describe = $this->request()->post('describe');
        $roleType = $this->request()->post('roleType');
        $parentId = $this->request()->post('parentId');
        if(empty($groupName)){
            return $this->returnApi(Code::PARAM_ERR, '请填写分组名称');
        }

        //判断分组名称是否已经存在
        $groupInfo = AdminGroupBackend::find()->select('groupId')
            ->where(['groupName' => $groupName,
                'isValid' => AdminGroupBackend::IS_VALID_OK,
                ]
            )->one();
        if(!empty($groupInfo)){
            return $this->returnApi(Code::POWER_ERR, '分组名称已存在');
        }
        $type = new AdminGroupBackend();
        $type->groupName = $groupName;
        $type->describe = $describe;
        $type->parentId = $parentId;
        $type->roleType = $roleType;
        $type->createTime = date('Y-m-d H:i:s');
        $type->isValid = AdminGroupBackend::IS_VALID_OK;
        $save = $type->save();
        if($save){
            return $this->returnApi(Code::SUCCESS, '添加成功',array('id'=>$type->groupId));
        }else{
            return $this->returnApi(Code::SYSTEM_ERR, '操作失败');
        }
    }

}