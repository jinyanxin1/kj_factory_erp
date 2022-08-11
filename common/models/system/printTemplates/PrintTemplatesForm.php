<?php
/**
 *
 * author: jinyanxin
 * Date: 2020/11/23
 * Time: 10:18
 * PHP version 7
 */

namespace common\models\system\printTemplates;


use common\library\helper\Code;

class PrintTemplatesForm extends PrintTemplatesModel
{

    public function rules()
    {
        return [
            [['printTemplatesId','type','format','h5'],'safe']
        ];
    }



    public function saveInfo()
    {
        if($this->printTemplatesId > 0){
            $info = PrintTemplatesModel::find()->where(['printTemplatesId'=>$this->printTemplatesId,'isValid'=>PrintTemplatesModel::IS_VALID_OK])->one();
            if(empty($info)){
                return ['code'=>Code::PARAM_ERR,'msg'=>'数据不存在'];
            }
        }else{
            $info = new PrintTemplatesModel();
        }
        $info->type = $this->type;
        $info->format = $this->format;
        $info->h5 = $this->h5;
        if(!$info->save()){
            return ['code'=>Code::PARAM_ERR,'msg'=>'保存失败'];
        }
        return ['code'=>Code::SUCCESS,'msg'=>'保存成功'];

    }

    public function getInfo()
    {
        $info = PrintTemplatesModel::find()->where(['type'=>$this->type,'format'=>1,'isValid'=>PrintTemplatesModel::IS_VALID_OK])->asArray()->one();
        return $info;
    }


}