<?php
/**
 *
 * author: jinyanxin
 * Date: 2020/9/7
 * Time: 10:16
 * PHP version 7
 */

namespace common\models\purchase;


use common\library\helper\Code;

class WareHouseForm extends WarehouseModel
{
    public $pageSize;
    public $page;
    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id','page','pageSize'], 'safe'],
            [['number', 'name', 'keeper'], 'string', 'max' => 32],
            [['address'], 'string', 'max' => 225],
        ];
    }


    public function saveInfo()
    {
        if(!$this->validate()){
            $firstItem = current($this->getErrors());
            return ['code'=>Code::PARAM_ERR,'msg'=>$firstItem[0]];
        }

        if($this->id > 0){
            $info = WarehouseModel::getById($this->id,false);
            if(empty($info)){
                return ['code'=>Code::PARAM_ERR,'msg'=>'仓库不存在'];
            }
        }else{
            $exist = WarehouseModel::find()->select('id')->where(['name'=>$this->name,'isValid'=>self::IS_VALID_OK])->asArray()->one();
            if(!empty($exist)){
                return ['code'=>Code::PARAM_ERR,'msg'=>'仓库名称重复'];
            }
            $info = new WarehouseModel();
        }
        $info->number = $this->number;
        $info->name = $this->name;
        $info->address = $this->address;
        $info->keeper = $this->keeper;
        if(!$info->save()){
            return ['code'=>Code::PARAM_ERR,'msg'=>'保存失败'];
        }
        return ['code'=>Code::SUCCESS,'msg'=>'保存成功'];
    }


    public function getData()
    {
        $model = self::find()->where(['isValid'=>self::IS_VALID_OK]);
        if(!empty($this->keeper)){
            $model->andWhere(['like','keeper',$this->keeper]);
        }
        if(!empty($this->name)){
            $model->andWhere(['like','name',$this->name]);
        }
        if(!empty($this->number)){
            $model->andWhere(['like','number',$this->number]);
        }
        $count = $model->count();
        $data = $model->offset(($this->page - 1) * $this->pageSize)->limit($this->pageSize)->orderBy('createTime desc')->asArray()->all();
        return ['count'=>$count,'data'=>$data];
    }


    public function formatData($data)
    {
        $returnArr = [];
        if(count($data) > 0){
            foreach($data as $info){
                $returnArr[] = [
                    'id'=>intval($info['id']),
                    'name'=>$info['name'],
                    'number'=>$info['number'],
                    'keeper'=>$info['keeper'],
                    'address'=>$info['address'],
                ];
            }
        }
        return $returnArr;
    }


    public function getInfo()
    {
        $info = WarehouseModel::getById($this->id,true);
        if(empty($info)){
            return ['code'=>Code::PARAM_ERR,'msg'=>'详情不存在','info'=>[]];
        }
        return ['code'=>Code::SUCCESS,'msg'=>'ok','info'=>$info];
    }

}