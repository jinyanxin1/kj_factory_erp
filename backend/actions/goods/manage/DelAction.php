<?php
/**
 *
 * author: jinyanxin
 * Date: 2020/11/16
 * Time: 16:17
 * PHP version 7
 */

namespace backend\actions\goods\manage;


use backend\actions\BaseAction;
use common\library\helper\Code;
use common\models\goods\GoodsMaterialModel;
use common\models\goods\GoodsModel;
use common\models\purchase\GoodsStockModel;
use common\models\purchase\StockRecordModel;

class DelAction extends BaseAction
{

    public function run()
    {
        $id = $this->request()->post('id');
        $count = GoodsMaterialModel::find()->where(['materialId'=>$id,'isValid'=>GoodsMaterialModel::IS_VALID_OK])->count();
        if($count> 0){
            return $this->returnApi(Code::PARAM_ERR,'物料有关联产品，不能删除');
        }
        $tran = \Yii::$app->db->beginTransaction();
        try{
            $time = date('Y-m-d H:i:s');
            GoodsModel::updateAll(['isValid'=>GoodsModel::IS_VALID_NO,'updateTime'=>$time],['id'=>$id]);
            GoodsStockModel::updateAll(['isValid'=>GoodsModel::IS_VALID_NO,'updateTime'=>$time],['goodsId'=>$id]);
            StockRecordModel::updateAll(['isValid'=>GoodsModel::IS_VALID_NO,'updateTime'=>$time],['goodsId'=>$id]);
            $tran->commit();
        }catch (\Exception $e){
            $tran->rollBack();
            \Yii::info('---del goods fail---'.$e->getMessage());
            return $this->returnApi(Code::PARAM_ERR,'删除失败');
        }
        return $this->returnApi(Code::SUCCESS,'删除成功');
    }

}