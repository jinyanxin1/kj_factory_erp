<?php
/**
 * @Author: jinyanxin
 * @Date: 2020/1/7
 * @Time: 10:48
 * 新增物品类别
 */


namespace backend\actions\purchase\goods;


use backend\actions\BaseAction;
use common\library\helper\Code;
use common\models\goods\GoodsCategoryModel;

class AddCategoryAction extends BaseAction
{

    public function run()
    {
        $categoryName = $this->request()->post('categoryName');
        $isStore = intval($this->request()->post('isStore',0));
        if((!is_array($categoryName)) || (count($categoryName)<=0)){
            return $this->returnApi(Code::PARAM_ERR,'类别名称不能为空');
        }
        $existCategory = GoodsCategoryModel::find()
            ->where(['categoryName'=>$categoryName,'isValid'=>GoodsCategoryModel::IS_VALID_OK])->asArray()->all();
        if(count($existCategory)>0){
            return $this->returnApi(Code::PARAM_ERR,'类别名称重复');
        }
        $transaction = \Yii::$app->db->beginTransaction();
        try{
            foreach($categoryName as $name){
                $name = trim($name);
                if(mb_strlen($name,'utf8') > 32){
                    return $this->returnApi(Code::PARAM_ERR,'类别名称过长');
                }
                if(!empty($name)){
                    $category = new GoodsCategoryModel();
                    $category->categoryName = $name;
                    $category->isStore = $isStore;
                    $category->save();
                }
            }
            $transaction->commit();
        }catch(\Exception $e){
            $transaction->rollBack();
            return $this->returnApi(Code::PARAM_ERR,'保存失败');
        }
        return $this->returnApi(Code::SUCCESS,'保存成功');
    }


}