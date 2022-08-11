<?php
/**
 * Created by PhpStorm.
 * User: zhouk
 * Date: 2019/8/1
 * Time: 20:05
 */

namespace backend\actions\auth;


use backend\actions\BaseAction;
use common\library\helper\Code;
use common\models\admin\AdminMenuModel;

class MenuSaveAction extends BaseAction
{
    public function run(){
        $parentId = intval($this->request()->post('parentId'));
        $menuId = intval($this->request()->post('menuId'));
        $menuName = $this->removeSpace($this->request()->post('menuName'));
        $menuLevel = intval($this->request()->post('level'));
        $menuUrl = $this->removeSpace($this->request()->post('menuUrl'));
        $menuIcon = $this->removeSpace($this->request()->post('menuIcon'));
        $interface = $this->removeSpace($this->request()->post('interface'));
        $btnTitle = $this->removeSpace($this->request()->post('btnTitle'));
        $btnClass = $this->removeSpace($this->request()->post('btnClass'));
        $btnType = $this->removeSpace($this->request()->post('btnType'));
        $btnHandle = $this->removeSpace($this->request()->post('btnHandle'));
        $btnHandleParams = $this->removeSpace($this->request()->post('btnHandleParams'));
        $btnIsTable = intval($this->request()->post('btnIsTable'));
        $sort = intval($this->request()->post('sort'));

        if(empty($menuName)){
            return $this->returnApi(Code::PARAM_ERR, '菜单名称不能为空');
        }

        $menuLevel = 1 ;
        if( $parentId>0 ) {
            $parentInfo = AdminMenuModel::find()->select('menuId,menuLevel')->where(['menuId' => $parentId])->one();
            if(empty($parentInfo)) {
                return $this->returnApi(Code::PARAM_ERR, '父级节点不存在');
            } else {
                $menuLevel = $parentInfo->menuLevel + 1 ;
            }
        }

        //根据菜单地址和接口地址查重
        $menuInfo = AdminMenuModel::find()
            ->where(['menuId' => $menuId, 'isValid' => AdminMenuModel::IS_VALID_OK])->one();

        $menuInfo->parentId = $parentId;
        $menuInfo->menuLevel = $menuLevel;
        $menuInfo->menuName = $menuName;
        $menuInfo->menuUrl = $menuUrl;
        $menuInfo->menuIcon = $menuIcon;
        $menuInfo->interface = $interface;
        $menuInfo->btnTitle = $btnTitle;
        $menuInfo->btnClass = $btnClass;
        $menuInfo->btnType = $btnType;
        $menuInfo->btnHandle = $btnHandle;
        $menuInfo->btnHandleParams = $btnHandleParams;
        $menuInfo->btnIsTable = $btnIsTable;
        $menuInfo->sort = $sort;
        $menuInfo->isValid = AdminMenuModel::IS_VALID_OK;

        $save = $menuInfo->save();
        if($save){
            return $this->returnApi(Code::SUCCESS, '修改成功');
        }else{
            return $this->returnApi(Code::SYSTEM_ERR, '接口错误');
        }


    }

}