<?php
/**
 * Created by PhpStorm.
 * User: zhouk
 * Date: 2019/8/2
 * Time: 1:43
 */

namespace frontend\actions\group;


use frontend\actions\WxAction;
use common\library\helper\Code;
use common\models\adminGroup\AdminGroupfrontend;

class AddAction extends WxAction
{

    public function run(){
        $groupName = $this->request()->post('groupName');
        $describe = $this->request()->post('describe');
//        $sectionId = $this->request()->post('sectionId');

        if(empty($groupName)){
            return $this->returnApi(Code::PARAM_ERR, '请填写分组名称');
        }

        //判断分组名称是否已经存在
        $groupInfo = AdminGroupfrontend::find()->select('groupId')
            ->where(['groupName' => $groupName,
                'isValid' => AdminGroupfrontend::IS_VALID_OK,
                ]
            )->one();
        if(!empty($groupInfo)){
            return $this->returnApi(Code::POWER_ERR, '分组名称已存在');
        }
        $type = new AdminGroupfrontend();
        $type->groupName = $groupName;
        $type->describe = $describe;
//        $type->sectionId = $sectionId;
        $type->createTime = date('Y-m-d H:i:s');
        $type->isValid = AdminGroupfrontend::IS_VALID_OK;
        $save = $type->save();
        if($save){
            return $this->returnApi(Code::SUCCESS, '添加成功',array('id'=>$type->groupId));
        }else{
            return $this->returnApi(Code::SYSTEM_ERR, '操作失败');
        }
    }

}