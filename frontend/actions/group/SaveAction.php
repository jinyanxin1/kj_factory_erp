<?php
/**
 * Created by PhpStorm.
 * User: zhouk
 * Date: 2019/8/1
 * Time: 11:44
 */

namespace frontend\actions\group;


use frontend\actions\WxAction;
use common\library\helper\Code;
use common\models\adminGroup\AdminGroupfrontend;

class SaveAction extends WxAction
{

    public function run(){
        $groupId = intval($this->request()->post('groupId'));
        $groupName = $this->request()->post('groupName');
        $describe = $this->request()->post('describe');
        if(empty($groupName)){
            return $this->returnApi(Code::PARAM_ERR, '请填写分组名称');
        }


        $type = AdminGroupfrontend::find()
            ->where([
                'isValid' => AdminGroupfrontend::IS_VALID_OK,
                'groupId' => $groupId
            ])->one();
        if(empty($type)){
            return $this->returnApi(Code::NOT_FOUND, '未识别的分类');
        }
        $type->groupName = $groupName;
        $type->describe = $describe;
        $type->createTime = date('Y-m-d H:i:s');
        $type->isValid = AdminGroupfrontend::IS_VALID_OK;
        $save = $type->save();
        if($save){
            return $this->returnApi(Code::SUCCESS, '修改成功',array('id'=>$type->groupId));
        }else{
            return $this->returnApi(Code::SYSTEM_ERR, '操作失败');
        }

    }

}