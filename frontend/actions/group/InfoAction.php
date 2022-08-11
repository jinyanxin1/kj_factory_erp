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
use common\models\adminGroup\AdminGroupModel;

class InfoAction extends WxAction
{

    public function run(){

        $id = intval($this->request()->post('groupId'));
        if(empty($id)){
            return $this->returnApi(Code::PARAM_ERR, '分组不存在');
        }
        $info = AdminGroupfrontend::getInfo($id);
        return $this->returnApi(Code::SUCCESS, 'ok', ['info' => $info]);
    }

}