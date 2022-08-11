<?php
/**
 * @Author: jinyanxin
 * @Date: 2020/1/7
 * @Time: 11:13
 * 物品类别列表
 */


namespace frontend\actions\purchase\goods;


use frontend\actions\WxAction;
use common\library\helper\Code;
use common\models\goods\GoodsCategoryModel;

class ListCategoryAction extends WxAction
{

    public function run()
    {
        $model = GoodsCategoryModel::find()
            ->where(['isValid'=>GoodsCategoryModel::IS_VALID_OK])
            ->orderBy('createTime desc')
            ->asArray()
            ->all();
        $showList = [];
        if(count($model)>0){
            foreach($model as $info){
                $showList[] = [
                    'categoryId'=>intval($info['categoryId']),
                    'categoryName'=>$info['categoryName'],
                    'isStore'=>intval($info['isStore'])
                ];
            }
        }
        return $this->returnApi(Code::SUCCESS,'ok',['showList'=>$showList]);
    }

}