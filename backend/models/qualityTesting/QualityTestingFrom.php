<?php
/**
 *
 * author: jinyanxin
 * Date: 2020/9/8
 * Time: 10:12
 * PHP version 7
 */

namespace backend\models\qualityTesting;


use common\library\helper\Code;
use common\models\qualityTesting\QualityTestingLogModel;

class QualityTestingFrom extends QualityTestingLogModel
{

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['salesOrderId'], 'required','message'=>'{attribute}必填'],
            [['salesOrderId', 'status'], 'integer'],
            [['id'], 'safe'],
            [['describe'], 'string', 'max' => 500],
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
                return ['code'=>Code::PARAM_ERR,'msg'=>'质检记录不存在'];
            }
        }else{
            $info = new self();
        }
        $info->attributes = $this->attributes;
        if(!$info->save()){
            return ['code'=>Code::PARAM_ERR,'msg'=>'质检记录保存失败'];
        }
        return ['code'=>Code::SUCCESS,'msg'=>'质检记录保存成功'];
    }

}