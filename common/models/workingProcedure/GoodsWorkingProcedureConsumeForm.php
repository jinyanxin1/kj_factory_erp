<?php
/**
 *
 * author: jinyanxin
 * Date: 2021/7/27
 * Time: 14:19
 * PHP version 7
 */

namespace common\models\workingProcedure;


use common\library\helper\Code;

class GoodsWorkingProcedureConsumeForm extends GoodsWorkingProcedureConsumeModel
{
    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['workingId', 'goodsId', 'type', 'consume', 'id'], 'safe'],
        ];
    }


    /*
     * 删除某个关联
     * */
    public function del()
    {
        if($this->id > 0){
            $info = GoodsWorkingProcedureConsumeModel::find()->where(['id'=>$this->id,'isValid'=>GoodsWorkingProcedureConsumeModel::IS_VALID_OK])->one();
            if(!empty($info)){
                $info->isValid = GoodsWorkingProcedureConsumeModel::IS_VALID_NO;
                if(!$info->save()){
                    return ['code'=>Code::PARAM_ERR,'msg'=>'删除失败'];
                }
            }
        }
        return ['code'=>Code::SUCCESS,'msg'=>'删除成功'];
    }


}