<?php
/**
 *
 * author: jinyanxin
 * Date: 2020/11/16
 * Time: 11:26
 * PHP version 7
 */

namespace backend\modules\purchase\controllers;


use backend\controllers\BaseController;

class WareHouseController extends BaseController
{

    /*
     * 仓库管理
     * */

    public function actions()
    {
        return [
            //保存
            'save'=>['class'=>'backend\actions\purchase\wareHouse\SaveAction'],
            //列表
            'list'=>['class'=>'backend\actions\purchase\wareHouse\ListAction'],
            //详情
            'info'=>['class'=>'backend\actions\purchase\wareHouse\InfoAction'],
            //删除
            'del'=>['class'=>'backend\actions\purchase\wareHouse\DelAction']
        ];
    }

}