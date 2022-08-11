<?php
/**
 * Created by PhpStorm.
 * User: zhouk
 * Date: 2019/8/1
 * Time: 19:51
 */

namespace backend\actions\auth;


use backend\actions\BaseAction;
use common\library\helper\Code;
use common\models\admin\AdminMenuModel;

class MenuListAction extends BaseAction
{

    public function run(){
        \Yii::info('menu/list start' . date("Y-m-d H:i:s")) ;
        $type = $this->request()->post('type',0);
        $menuList = AdminMenuModel::getAllMenu($type) ;
        \Yii::info('menu/list end' . date("Y-m-d H:i:s")) ;

        return $this->returnApi(Code::SUCCESS, 'ok', ['list' => $menuList]) ;
    }

}