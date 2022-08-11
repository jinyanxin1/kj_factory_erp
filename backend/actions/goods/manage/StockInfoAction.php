<?php
/**
 *
 * author: jinyanxin
 * Date: 2020/9/7
 * Time: 9:49
 * PHP version 7
 */

namespace backend\actions\goods\manage;


use backend\actions\BaseAction;
use common\library\helper\Code;
use common\models\goods\GoodsStockModel;
use common\models\warehouse\WarehouseModel;

class StockInfoAction extends BaseAction
{

    public function run()
    {
        $id = intval($this->request()->post('id'));
        if($id <= 0){
            return $this->returnApi(Code::PARAM_ERR,'请选择商品');
        }
        $data = GoodsStockModel::find()
            ->select('goodsId,wareHouseId,type,num')
            ->where(['goodsId'=>$id,'isValid'=>GoodsStockModel::IS_VALID_OK])
            ->groupBy('wareHouseId')->indexBy('wareHouseId')->asArray()->all();
        $returnArr = [];
        if(!empty($data)){
            $wareHouse = WarehouseModel::find()
                ->select('id,name')
                ->where(['id'=>array_column($data,'wareHouseId')])->indexBy('id')->asArray()->all();
            foreach($data as &$info){
                $info['wareHouseName'] = isset($wareHouse[$info['wareHouseId']]) ? $wareHouse[$info['wareHouseId']]['name'] : '';
            }
            $returnArr = $data;
        }
        return $this->returnApi(Code::SUCCESS,'ok',['list'=>$returnArr]);
    }

}