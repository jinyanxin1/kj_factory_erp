<?php
/**
 * Created by PhpStorm.
 * User: zhouk
 * Date: 2019/8/1
 * Time: 19:51
 */

namespace frontend\actions\auth;


use frontend\actions\WxAction;
use common\library\helper\Code;
use common\models\admin\AdminMenuModel;

class MenuListAction extends WxAction
{

    public function run(){
        \Yii::info('menu/list start' . date("Y-m-d H:i:s")) ;
        $menuList = AdminMenuModel::getAllMenu() ;
        \Yii::info('menu/list end' . date("Y-m-d H:i:s")) ;

        return $this->returnApi(Code::SUCCESS, 'ok', ['list' => $menuList]) ;
    }

}