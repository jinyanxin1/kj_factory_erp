<?php
/**
 * Created by PhpStorm.
 * User: zhouk
 * Date: 2019/8/1
 * Time: 11:44
 */

namespace backend\actions\group;


use backend\actions\BaseAction;
use common\library\helper\Code;
use common\models\adminGroup\AdminGroupBackend;
use common\models\adminGroup\AdminGroupModel;

class InfoAction extends BaseAction
{

    public function run(){

        $id = intval($this->request()->post('groupId'));
        if(empty($id)){
            return $this->returnApi(Code::PARAM_ERR, '分组不存在');
        }
        $info = AdminGroupBackend::getInfo($id);
        return $this->returnApi(Code::SUCCESS, 'ok', ['info' => $info]);
    }

}