<?php
/**
 * Created by PhpStorm.
 * User: zhouk
 * Date: 2019/8/2
 * Time: 2:01
 */

namespace frontend\actions\auth;


use frontend\actions\WxAction;
use common\library\helper\Code;
use common\models\admin\AdminMenuModel;
use common\models\admin\AdminPowerModel;
use yii\base\Exception;

class MenuAddAction extends WxAction
{

    public function run(){
        $parentId = intval($this->request()->post('parentId'));
        $menuName = $this->removeSpace($this->request()->post('menuName'));
        $menuLevel = intval($this->request()->post('menuLevel'));
        $menuUrl = $this->removeSpace($this->request()->post('menuUrl'));
        $menuIcon = $this->removeSpace($this->request()->post('menuIcon'));
        $interface = $this->removeSpace($this->request()->post('interface'));
        $btnTitle = $this->removeSpace($this->request()->post('btnTitle'));
        $btnClass = $this->removeSpace($this->request()->post('btnClass'));
        $btnType = $this->removeSpace($this->request()->post('btnType'));
        $btnHandle = $this->removeSpace($this->request()->post('btnHandle'));
        $btnHandleParams = $this->removeSpace($this->request()->post('btnHandleParams'));
        $btnIsTable = intval($this->request()->post('btnIsTable'));

        if(empty($menuName)){
            return $this->returnApi(Code::PARAM_ERR, '菜单名称不能为空');
        }

        //根据前端菜单路由地址
        $menuInfo = AdminMenuModel::find()->select('menuId')
            ->where(['menuUrl' => $menuUrl])
            ->andWhere(['isValid' => AdminMenuModel::IS_VALID_OK])
            ->one();

       if(!empty($menuInfo)){
           return $this->returnApi(Code::NORMAL_ERR, '菜单已存在');
       }
       $menuLevel = 1 ;
        if(!empty($parentId)){
            $parentInfo = AdminMenuModel::find()->select('menuId,menuLevel')->where(['menuId' => $parentId])->one();
            if(empty($parentInfo)) {
                return $this->returnApi(Code::PARAM_ERR, '父级节点不存在');
            } else {
                $menuLevel = $parentInfo->menuLevel + 1 ;
            }
        }

        $tran = \Yii::$app->db->beginTransaction();
        try {
            $menu = new AdminMenuModel();
            $menu->parentId = $parentId;
            $menu->menuLevel = $menuLevel; //todo 计算
            $menu->menuName = $menuName;
            $menu->menuUrl = $menuUrl;
            $menu->menuType = AdminMenuModel::MENU_TYPE_NORMAl ;
            $menu->sort = AdminMenuModel::MENU_DEFAULT_SORT ;
            $menu->menuIcon = $menuIcon;
            $menu->interface = $interface;
            $menu->btnTitle = $btnTitle;
            $menu->btnClass = $btnClass;
            $menu->btnType = $btnType;
            $menu->btnHandle = $btnHandle;
            $menu->btnHandleParams = $btnHandleParams;
            $menu->btnIsTable = $btnIsTable;
            $menu->isValid = AdminMenuModel::IS_VALID_OK;
            $menu->save();
                //添加子节点：删除，新增，修改
//             AdminMenuModel::saveSonList($menu->menuId, $menuName, $menuLevel);

                //添加管理员权限
            $power = new AdminPowerModel();
            $power->groupId = 1;
            $power->menuId = $menu->menuId;
            $power->isValid = AdminPowerModel::IS_VALID_OK;
            $power->save();

            $tran->commit();
        }catch (Exception $e){
            $tran->rollBack();
            \Yii::info('添加菜单失败：'. $e->getMessage());
            return $this->returnApi(Code::SYSTEM_ERR, $e->getMessage());
        }

        return $this->returnApi(Code::SUCCESS, '添加成功');
    }

}