<?php
/**
 * @Author: jinyanxin
 * @Date: 2020/2/4
 * @Time: 9:33
 */


namespace backend\models\purchase\stock;


use common\models\BaseForm;
use common\models\stock\StockModel;
use common\models\warehouse\WarehouseModel;

class StockForm extends BaseForm
{

    public $goodsId;
    public $page;
    public $pageSize;


    public function getData()
    {
        //得到存在的仓库id
        $house = WarehouseModel::getAllHouse();
        $houseIds = array_column($house,'warehouseId');
        $model = StockModel::find()->where(['goodsId'=>$this->goodsId,'warehouseId'=>$houseIds,'isValid'=>StockModel::IS_VALID_OK]);
        $count = $model->count();
        $data = $model->offset(($this->page - 1) * $this->pageSize)->limit($this->pageSize)->asArray()->all();
        $showList = StockModel::format($data);
        return [
            'count'=>$count,
            'data'=>$showList
        ];
    }


}