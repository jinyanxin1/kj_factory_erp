<?php
/**
 *
 * author: jinyanxin
 * Date: 2020/9/15
 * Time: 11:03
 * PHP version 7
 * 财务-账户
 */

namespace backend\models\finance;


use common\library\helper\Code;
use common\models\finance\PaymentsAccountModel;

class PaymentsAccountForm extends PaymentsAccountModel
{
    public $page = 1;
    public $pageSize = 10;

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id','page','pageSize','incomeAmount','expenditureAmount'], 'safe'],
            [['name'], 'required','message'=>'{attribute}必填'],
            [['name'], 'string', 'max' => 32],
            [['accountNumber'], 'string', 'max' => 50],
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

        $count = $model->count();
        $data = $model->offset(($this->page - 1) * $this->pageSize)->limit($this->pageSize)->asArray()->all();
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
                    'accountNumber'=>$info['accountNumber'],
                    'incomeAmount'=>self::amountToYuan(intval($info['incomeAmount'])),
                    'expenditureAmount'=>self::amountToYuan(intval($info['expenditureAmount'])),
                ];
            }
        }
        return $returnArr;
    }
}