<?php
/**
 * @Author: jinyanxin
 * @Date: 2020/1/7
 * @Time: 10:44
 * 删除仓库
 */


namespace frontend\actions\purchase\wareHouse;


use frontend\actions\WxAction;
use common\library\helper\Code;
use common\models\warehouse\WarehouseModel;

class DelAction extends WxAction
{

    public function run()
    {
        $houseIds = $this->request()->post('houseIds');
        if((!is_array($houseIds)) || (count($houseIds)<=0)){
            return $this->returnApi(Code::PARAM_ERR,'请选择删除的仓库');
        }
        WarehouseModel::updateAll(['isValid'=>WarehouseModel::IS_VALID_NO],['warehouseId'=>$houseIds]);
        return $this->returnApi(Code::SUCCESS,'删除成功');
    }

}