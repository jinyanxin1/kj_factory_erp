<?php
/**
 * Created by PhpStorm.
 * User: zhouk
 * Date: 2019/7/31
 * Time: 17:48
 */

namespace common\models\adminMenu;



use common\models\BaseModel;

class AdminMenuModel extends BaseModel
{

    public static function tableName()
    {
        return 'kj_sys_admin_menu';
    }

}