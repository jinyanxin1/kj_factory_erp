<?php
/**
 * Created by cqj
 * User: cqj
 * Date: 2019/10/25
 * Time: 16:17
 */

namespace common\models\system\basis;


use common\library\helper\Code;
use common\models\BaseForm;
use Yii;

class BasisForm extends BaseForm
{
    public $name;
    public $type;
    public $basisId;

    public function rules() {
        return [
            ['name','required','message'=>'名称不能为空'],
            ['type','required','message'=>'类型不能为空'],
            ['type', 'in', 'range' => array_column(BasisModel::getTypeList(),'type') ,'message'=>'无效类型'],
            ['name','string','max'=>30,'message' => '名称长度不能大于三十字符'],
        ];
    }

    /**
     * 新增
     * @return array
     */
    public function insert(){
        if(!$this->validate()){
            $firstItem = $this->getErrors();
            foreach ($firstItem as $value) {
                return ['code' => Code::PARAM_ERR ,'msg'=>$value[0]];
            }
        }
        $type = $this->type;
        $name = $this->name;
        if(empty($name)){
            return ['code' => Code::PARAM_ERR ,'msg'=>'名称不能为空'];
        }

        //判断重名
        $basics = BasisModel::find()->select(['basisId'])
            ->where(['name' => $name , 'type' => $type ,'isValid' => BasisModel::IS_VALID_OK])
            ->all();
        if(!empty($basics)){
            return ['code' => Code::PARAM_ERR ,'msg'=>'项目名已存在'];
        }
        //新增
        $basics = new BasisModel();
        $basics->name = $name;
        $basics->type = $type;
        if(!$basics->save()){
            return ['code' => Code::PARAM_ERR ,'msg'=>'新增失败'];
        }
        return ['code' => Code::SUCCESS ,'msg'=>'新增成功','data'=>$basics];
    }

    /**
     * 删除
     * @return array
     */
    public function del() {
        $basisId = $this->basisId;
        $type = $this->type;

        if(empty($basisId)){
            return ['code' => Code::PARAM_ERR ,'msg'=>'参数编号不能为空'];
        }
        $basics = BasisModel::find()
            ->where(['basisId' => $basisId , 'isValid' => BasisModel::IS_VALID_OK])
            ->one();

        if(empty($basics)){
            return ['code' => Code::PARAM_ERR ,'msg'=>'未知参数无法删除'];
        }

        $basics->isValid = BasisModel::IS_VALID_NO ;

        if(!$basics->save()){
            return ['code' => Code::PARAM_ERR ,'msg'=>'删除失败'];

        }
        return ['code' => Code::SUCCESS ,'msg'=>'删除成功'];
    }

    /**
     * 编辑
     * @return array
     */
    public function update() {
        if(!$this->validate()){
            $firstItem = $this->getErrors();
            foreach ($firstItem as $value) {
                return ['code' => Code::PARAM_ERR ,'msg'=>$value[0]];
            }
        }
        $basisId = $this->basisId;
        $type = $this->type;

        if(empty($basisId)){
            return ['code' => Code::PARAM_ERR ,'msg'=>'参数编号不能为空'];
        }
        $basics = BasisModel::find()
            ->where(['basisId' => $basisId , 'type' => $type , 'isValid' => BasisModel::IS_VALID_OK])
            ->one();

        if(empty($basics)){
            return ['code' => Code::PARAM_ERR ,'msg'=>'无效数据'];
        }

        $name = $this->name;
        //判断重名
        $basicsName = BasisModel::find()->select(['basisId'])
            ->where(['name' => $name , 'type' => $type ,'isValid' => BasisModel::IS_VALID_OK])
            ->asArray()
            ->indexBy('basisId')
            ->all();
        if(!empty($basicsName)){
            if(!in_array($basisId , array_keys($basicsName))){
                return ['code' => Code::PARAM_ERR ,'msg'=>'重命名'];
            }
        }
        //修改
        $basics->name = $name;

        if(!$basics->save()){
            return ['code' => Code::PARAM_ERR ,'msg'=>'参数编号不能为空'];
        }

        return ['code' => Code::SUCCESS ,'msg'=>'修改成功'];

    }
}