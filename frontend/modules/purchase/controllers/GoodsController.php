<?php
/**
 * @Author: jinyanxin
 * @Date: 2020/1/7
 * @Time: 9:41
 * 物品设置
 */


namespace frontend\modules\purchase\controllers;


use frontend\controllers\BaseController;

class GoodsController extends BaseController
{
    public function actions()
    {
        return [
            //新增类别
            'add-category'=>['class'=>'frontend\actions\purchase\goods\AddCategoryAction'],
            //修改类别
            'edit-category'=>['class'=>'frontend\actions\purchase\goods\EditCategoryAction'],
            //删除类别
            'del-category'=>['class'=>'frontend\actions\purchase\goods\DelCategoryAction'],
            //类别列表
            'list-category'=>['class'=>'frontend\actions\purchase\goods\ListCategoryAction'],

            //新增商品
            'add-goods'=>['class'=>'frontend\actions\purchase\goods\AddGoodsAction'],
            //商品列表
            'list-goods'=>['class'=>'frontend\actions\purchase\goods\ListGoodsAction'],
            //删除商品
            'del-goods'=>['class'=>'frontend\actions\purchase\goods\DelGoodsAction'],
            //导出商品
            'export-goods'=>['class'=>'frontend\actions\purchase\goods\ExportGoodsAction'],
            //导入商品
            'import-goods'=>['class'=>'frontend\actions\purchase\goods\ImportGoodsAction']
        ];
    }

}