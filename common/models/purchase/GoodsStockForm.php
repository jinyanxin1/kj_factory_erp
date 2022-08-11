<?php
/**
 *
 * author: jinyanxin
 * Date: 2020/9/7
 * Time: 9:12
 * PHP version 7
 */

namespace common\models\purchase;


class GoodsStockForm extends GoodsStockModel
{
    public $page;
    public $pageSize;
    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id','goodsId', 'wareHouseId', 'num','page','pageSize'], 'safe'],
        ];
    }


    public function getData()
    {
        $house = WarehouseModel::getAllHouse();
        $houseIds = array_column($house,'id');
        $model = GoodsStockModel::find()->where(['goodsId'=>$this->goodsId,'warehouseId'=>$houseIds,'isValid'=>GoodsStockModel::IS_VALID_OK]);
        $count = $model->count();
        $data = $model->offset(($this->page - 1) * $this->pageSize)->limit($this->pageSize)->asArray()->all();
        return [
            'count'=>$count,
            'data'=>$data
        ];
    }

    public function formatData($data)
    {
        $returnArr = [];
        if(count($data) > 0){
            $houseIds = array_unique(array_column($data,'wareHouseId'));
            $house = WarehouseModel::getByIdList($houseIds);
            foreach ($data as $info) {
                $dataInfo = [];
                $dataInfo['stockNum'] = $info['num'];
                $dataInfo['wareHouseId'] = intval($info['wareHouseId']);
                $dataInfo['goodsId'] = intval($info['goodsId']);
                if(isset($house[$info['wareHouseId']])){
                    $dataInfo['houseName'] = $house[$info['wareHouseId']]['name'];
                }
                $returnArr[] = $dataInfo;
            }
        }
        return $returnArr;
    }

}