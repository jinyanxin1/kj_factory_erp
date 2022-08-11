<?php
/**
 * @Author: jinyanxin
 * @Date: 2020/1/7
 * @Time: 11:02
 * 修改物品类别
 */


namespace frontend\actions\purchase\goods;


use frontend\actions\WxAction;
use common\library\helper\Code;
use common\models\goods\GoodsCategoryModel;

class EditCategoryAction extends WxAction
{

    public function run()
    {
        $categoryId = intval($this->request()->post('categoryId'));
        $name = $this->request()->post('name');
        if(empty($name)){
            return $this->returnApi(Code::PARAM_ERR,'名称不能为空');
        }
        if(mb_strlen($name,'utf8') > 32){
            return $this->returnApi(Code::PARAM_ERR,'类别名称过长');
        }
        $nameCategory = GoodsCategoryModel::getByName($name,true);
        if($nameCategory !== null){
            $nameCategoryId = intval($nameCategory['categoryId']);
            if($nameCategoryId !== $categoryId){
                return $this->returnApi(Code::PARAM_ERR,'名称重复');
            }
        }

        $category = GoodsCategoryModel::getById($categoryId);
        if($category === null){
            return $this->returnApi(Code::PARAM_ERR,'该类别不存在');
        }
        $category->categoryName = $name;
        if(!$category->save()){
            return $this->returnApi(Code::PARAM_ERR,'修改失败');
        }
        return $this->returnApi(Code::SUCCESS,'修改成功');
    }

}