<?php
/**
 *
 * author: jinyanxin
 * Date: 2020/11/16
 * Time: 10:45
 * PHP version 7
 */

namespace common\models\goods;


use common\library\helper\Code;

class GoodsMaterialForm extends GoodsMaterialModel
{

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [
                ['id','goodsId','materialId','number','describe'],
                'safe'
            ],
            [['describe'], 'string', 'max' => 225],
        ];
    }


    public function saveInfo()
    {
        if(!$this->validate()){
            $errorArr = current($this->getErrors());
            return ['code'=>Code::PARAM_ERR,'msg'=>$errorArr[0]];
        }
        if($this->id > 0){
            $info = GoodsMaterialModel::getById($this->id,false);
            if(empty($info)){
                return ['code'=>Code::PARAM_ERR,'msg'=>'关联信息不存在'];
            }
        }else{
            $info = GoodsMaterialModel::find()->where(['goodsId'=>$this->goodsId,'materialId'=>$this->materialId,'isValid'=>GoodsMaterialModel::IS_VALID_OK])->one();
            if(empty($info)){
                $info = new GoodsMaterialModel();
            }
        }
        $info->goodsId = $this->goodsId;
        $info->materialId = $this->materialId;
        $info->number = $this->number;
        $info->describe = $this->describe;
        if(!$info->save()){
            return ['code'=>Code::PARAM_ERR,'msg'=>'关联物料保存失败'];
        }
        return ['code'=>Code::SUCCESS,'msg'=>'关联物料保存成功'];
    }

}