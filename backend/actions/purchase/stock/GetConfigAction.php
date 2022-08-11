<?php
/**
 * @Author: jinyanxin
 * @Date: 2020/2/11
 * @Time: 10:37
 * 得到所有仓库，商品类别
 */


namespace backend\actions\purchase\stock;


use backend\actions\BaseAction;
use common\library\helper\Code;
use common\models\goods\GoodsCategoryModel;
use common\models\purchase\WarehouseModel;

class GetConfigAction extends BaseAction
{

    public function run()
    {
        $house = WarehouseModel::getAllHouse();
        $showHouse = [];
        if(count($house) > 0){
            foreach($house as $houseInfo){
                $showHouse[] = [
                    'houseId'=>intval($houseInfo['id']),
                    'name'=>$houseInfo['name']
                ];
            }
        }
        $category = GoodsCategoryModel::find()->where(['isValid'=>GoodsCategoryModel::IS_VALID_OK])->orderBy('createTime desc')->asArray()->all();
        $showCategory = [];
        if(count($category)>0){
            foreach($category as $info){
                $showCategory[] = [
                    'categoryId'=>intval($info['id']),
                    'categoryName'=>$info['name'],
                ];
            }
        }
        return $this->returnApi(Code::SUCCESS,'ok',[
            'house'=>$showHouse,
            'category'=>$showCategory
        ]);
    }

}