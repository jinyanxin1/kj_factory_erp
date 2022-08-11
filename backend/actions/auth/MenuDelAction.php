<?php
/**
 * Created by PhpStorm.
 * User: zhouk
 * Date: 2019/8/1
 * Time: 19:58
 */

namespace backend\actions\auth;


use backend\actions\BaseAction;
use common\library\helper\Code;
use common\models\admin\AdminMenuModel;
use yii\db\Exception;

class MenuDelAction extends BaseAction
{

    public function run(){
        $menuId = intval($this->request()->post('menuId'));
        \Yii::info('开始删除菜单：'. $menuId);

        if(empty($menuId)) {
            return $this->returnApi(Code::PARAM_ERR, '菜单不存在');
        }

        $menuInfo = AdminMenuModel::find()->where(['menuId' => $menuId, 'isValid' => AdminMenuModel::IS_VALID_OK])->one();
        if(empty($menuInfo)){
            return $this->returnApi(Code::NORMAL_ERR, '菜单不存在');
        }

        $tran = \Yii::$app->db->beginTransaction();
        try{
            $menuInfo->isValid = AdminMenuModel::IS_VALID_NO;
            $menuInfo->save();
            //查询是否为父级菜单
            $menuList = AdminMenuModel::find()->select('menuId')->where(['parentId' => $menuId, 'isValid' => AdminMenuModel::IS_VALID_OK])->all();
            if(!empty($menuList)){
                AdminMenuModel::updateAll(['parentId' => $menuId], ['isValid' => AdminMenuModel::IS_VALID_NO]);
            }
            $tran->commit();
        }catch (Exception $e){
            \Yii::info('删除菜单错误:' . $e->getMessage());
            $tran->rollBack();
            return $this->returnApi(Code::SYSTEM_ERR, '操作失败');
        }

        return $this->returnApi(Code::SUCCESS, 'ok');
    }

}