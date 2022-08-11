<?php
/**
 * @Author: jinyanxin
 * @Date: 2020/1/7
 * @Time: 12:53
 */


namespace backend\actions\purchase\goods;


use backend\actions\BaseAction;
use common\library\helper\Code;
use common\models\adjustment\AdjustmentModel;
use common\models\goods\GoodsModel;

class DelGoodsAction extends BaseAction
{

    public function run()
    {
        $goodsIds = $this->request()->post('goodsIds');
        if((!is_array($goodsIds)) || (count($goodsIds)<=0)){
            return $this->returnApi(Code::PARAM_ERR,'请选择删除的商品');
        }
        $tran = \Yii::$app->db->beginTransaction();
        try{
            GoodsModel::updateAll(['isValid'=>GoodsModel::IS_VALID_NO],['goodsId'=>$goodsIds]);
            $tran->commit();
        }catch (\Exception $e){
            $tran->rollBack();
            return $this->returnApi(Code::PARAM_ERR,'删除失败');
        }
        return $this->returnApi(Code::SUCCESS,'删除成功');
    }

}