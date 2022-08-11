<?php
/**
 *
 * author: jinyanxin
 * Date: 2020/9/7
 * Time: 8:59
 * PHP version 7
 */

namespace frontend\modules\goods\controllers;


use frontend\controllers\BaseController;

class ManageController extends BaseController
{

    /*
     * 物料管理
     * */
    public function actions()
    {
        return [
            //物品列表
            'list' => ['class' => 'frontend\actions\goods\manage\ListAction'],
        ];
    }

}