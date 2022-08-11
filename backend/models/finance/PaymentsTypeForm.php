<?php
/**
 *
 * author: jinyanxin
 * Date: 2020/9/9
 * Time: 9:53
 * PHP version 7
 * 收支类型
 */

namespace backend\models\finance;


use common\library\helper\Code;
use common\models\finance\PaymentsTypeModel;

class PaymentsTypeForm extends PaymentsTypeModel
{
    public $page = 1;
    public $pageSize = 10;

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['type'], 'integer'],
            [['name'], 'required','message'=>'{attribute}必填'],
            [['name'],'string','max'=>32,'message'=>'{attribute}32字符内'],
            [['id','page','pageSize'], 'safe'],
        ];
    }



    public function saveInfo()
    {
        if(!$this->validate()){
            $firstItem = current($this->getErrors());
            return ['code'=>Code::PARAM_ERR,'msg'=>$firstItem[0]];
        }

        if($this->id > 0){
            $info = self::getById($this->id,false);
            if(empty($info)){
                return ['code'=>Code::PARAM_ERR,'msg'=>'详情不存在'];
            }
        }else{
            $info = new self();
        }
        $info->attributes = $this->attributes;
        if(!$info->save()){
            return ['code'=>Code::PARAM_ERR,'msg'=>'保存失败'];
        }
        return ['code'=>Code::SUCCESS,'msg'=>'保存成功'];
    }


    public function getData()
    {
        $model = self::find()->where(['isValid'=>self::IS_VALID_OK]);
        if($this->type > 0){
            $model->andWhere(['type'=>$this->type]);
        }
        $count = $model->count();
        $data = $model->offset(($this->page - 1) * $this->pageSize)->limit($this->pageSize)->asArray()->all();
        return ['count'=>$count,'data'=>$data];
    }


    public function formatData($data)
    {
        $returnArr = [];
        if(count($data) > 0){
            $typeList = self::$typeList;
            foreach($data as $info){
                $returnArr[] = [
                    'id'=>intval($info['id']),
                    'name'=>$info['name'],
                    'typeName'=>isset($typeList[intval($info['type'])]) ? $typeList[intval($info['type'])] : ''
                ];
            }
        }
        return $returnArr;
    }

}