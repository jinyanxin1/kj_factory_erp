<?php
/**
 * @Author: jinyanxin
 * @Date: 2020/1/7
 * @Time: 11:09
 * 删除类别
 */


namespace backend\actions\purchase\goods;


use backend\actions\BaseAction;
use common\library\helper\Code;
use common\models\goods\GoodsCategoryModel;

class DelCategoryAction extends BaseAction
{

    public function run()
    {
        $categoryIds = $this->request()->post('categoryIds');
        if((!is_array($categoryIds)) || (count($categoryIds)<=0)){
            return $this->returnApi(Code::PARAM_ERR,'请选择删除的类别');
        }
        GoodsCategoryModel::updateAll(['isValid'=>GoodsCategoryModel::IS_VALID_NO],['categoryId'=>$categoryIds]);
        return $this->returnApi(Code::SUCCESS,'删除成功');
    }

}