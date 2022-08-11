<?php
/**
 * @Author: jinyanxin
 * @Date: 2020/1/7
 * @Time: 9:55
 */


namespace backend\models\purchase\wareHouse;


use common\library\helper\Code;
use common\models\BaseForm;
use common\models\warehouse\WarehouseModel;

class WareHouseForm extends BaseForm
{
    public $addHouseId;//新增仓库id
    public $houseSchoolId;//学校id
    public $houseCampusIds;//校区id
    public $type;//仓库类型
    public $warehouseName;//仓库名称
    public $description;//描述

    public function rules()
    {
       return [
           [['warehouseName'],'string','min'=>1,'max'=>32],
           [['description'],'string','min'=>1,'max'=>225],
       ];
    }
    public function attributeLabels()
    {
        return [
            'warehouseName'=>'仓库名称',
            'description'=>'仓库描述'
        ];
    }

    public function save()
    {
        if (!$this->validate()){
            $firstItem = current($this->getErrors());
            $msg=$firstItem[0];
            return ['code'=>Code::PARAM_ERR,'msg'=>$msg];
        }
        $existHouse = WarehouseModel::find()->where(['warehouseName'=>$this->warehouseName,'isValid'=>WarehouseModel::IS_VALID_OK])->one();
        if( $this->addHouseId > 0 ){
            $house = WarehouseModel::getById($this->addHouseId);
            if($house === null){
                return ['code'=>Code::PARAM_ERR,'msg'=>'该仓库不存在'];
            }
            if(!empty($existHouse)){
                if($this->addHouseId !== $existHouse->warehouseId){
                    return ['code'=>Code::PARAM_ERR,'msg'=>'名称已存在'];
                }
            }
        }else{
            if($existHouse !== null){
                return ['code'=>Code::PARAM_ERR,'msg'=>'仓库名称重复'];
            }
            $house = new WarehouseModel();
        }
        $house->schoolId = $this->houseSchoolId;
        $house->warehouseName = $this->warehouseName;
        $house->type = $this->type;
        $house->campusIds = empty($this->houseCampusIds) ? '' : implode(',',$this->houseCampusIds);
        $house->description = $this->description;
        if(!$house->save()){
            return ['code'=>Code::PARAM_ERR,'msg'=>'保存失败'];
        }
        return ['code'=>Code::SUCCESS,'msg'=>'保存成功'];
    }

}