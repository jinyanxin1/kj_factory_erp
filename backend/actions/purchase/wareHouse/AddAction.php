<?php
/**
 * @Author: jinyanxin
 * @Date: 2020/1/7
 * @Time: 9:48
 * 新增仓库
 */


namespace backend\actions\purchase\wareHouse;


use backend\actions\BaseAction;
use backend\models\purchase\wareHouse\WareHouseForm;
use common\library\helper\Code;
use common\models\warehouse\WarehouseModel;

class AddAction extends BaseAction
{

    public function run()
    {
        $houseId = intval( $this->request()->post('houseId') );//仓库id
        $campusIds = $this->request()->post('campusIds');//关联校区
        $houseType = intval($this->request()->post('type'));//仓库类型
        $houseName = trim($this->request()->post('warehouseName'));//仓库名称
        $description = $this->request()->post('description');//仓库描述
        if( $houseType === WarehouseModel::BRANCH_HOUSE ){
            if((!is_array($campusIds)) || (count($campusIds)<=0)){
                return $this->returnApi(Code::PARAM_ERR,'请选择校区');
            }
            foreach ($campusIds as $id){
                if(empty($id)){
                    return $this->returnApi(Code::PARAM_ERR,'校区不能为空');
                }
            }
        }
        $houseForm = new WareHouseForm();
        $houseForm->addHouseId = $houseId;
        $houseForm->houseCampusIds = $campusIds;
        $houseForm->warehouseName = $houseName;
        $houseForm->type = $houseType;
        $houseForm->description = $description;
        $result = $houseForm->save();
        return $this->returnApi($result['code'],$result['msg']);
    }

}