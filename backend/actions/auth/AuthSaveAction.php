<?php
/**
 * 保存权限数据
 * Created by PhpStorm.
 * User: zhouk
 * Date: 2019/8/2
 * Time: 1:59
 */

namespace backend\actions\auth;


use backend\actions\BaseAction;
use common\library\helper\Code;
use common\models\admin\AdminPowerModel;
use yii\db\Exception;
use yii\helpers\Json;

class AuthSaveAction extends BaseAction
{

    public function run(){
        $power = $this->request()->post('list');
        $groupId = $this->request()->post('groupId');
        $type = $this->request()->post('type');
        \Yii::info('权限处理：用户组：'.$groupId.  '数据：'. json_encode($power));

        if(empty($power)){
            return $this->returnApi(Code::PARAM_ERR, '参数错误');
        }

        if(empty($groupId)){
            return $this->returnApi(Code::PARAM_ERR, '参数错误');
        }
        $tran = \Yii::$app->db->beginTransaction();
        try {
            //处理权限数据
            $saveInfo = AdminPowerModel::savePowerInfo($power, $groupId,$type);
            $tran->commit();
        }catch(Exception $e){
            $tran->rollBack();
            \Yii::info($e->getMessage());
            return $this->returnApi(Code::SYSTEM_ERR, $e->getMessage());
        }

        return $this->returnApi(Code::SUCCESS, 'ok');
    }

}