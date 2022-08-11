<?php
/**
 * Created by cqj
 * User: cqj
 * Date: 2019/10/25
 * Time: 16:16
 */

namespace backend\models\system;


use common\library\helper\Code;
use common\models\BaseForm;
use common\models\system\BasicsModel;
use common\models\system\BasicsGroupModel;

class BasicsGroupForm extends BaseForm
{
    public $name;
    public $type;
    public $basicsGroupId;
    public $describe;

    public function rules() {
        return [
            ['name','required'],
            ['type','required'],
            ['type', 'in', 'range' => [BasicsModel::SALE_MODE]],
            ['name','string','max'=>30],
        ];
    }

    public static $listColumn = [
        'basicsGroupId',
        'name',
        'describe',
        'type',
        'schoolId',
        'campusId'];

    public function attributeLabels()
    {
        return [
            'name' => '名称' ,
            'type' => '类型' ,
            ];
    }

    /**
     * 更新
     * @return array
     */
    public function update() {
        if(!$this->validate()){
            $firstItem = $this->getErrors();
            foreach ($firstItem as $value) {
                return ['code' => Code::PARAM_ERR , 'msg' => $value[0]];
            }
        }

        $name = trim($this->attributes['name']);
        $type = $this->attributes['type'];
        $describe = $this->attributes['describe'];
        $basicsGroupId = $this->attributes['basicsGroupId'];

        if(empty($basicsGroupId)){
            return ['code' => Code::PARAM_ERR , 'msg' => '编号不能为空'];
        }
        $basicsGroup = BasicsGroupModel::find()
            ->where(['basicsGroupId' => $basicsGroupId,'isDelete' => BasicsGroupModel::IS_VALID_OK])
            ->one();
        if(empty($basicsGroup)){
            return ['code' => Code::PARAM_ERR , 'msg' => '编号错误'];
        }
        $groupName = BasicsGroupModel::find()->select(['basicsGroupId'])
            ->where(['name' => $name , 'isDelete' => BasicsGroupModel::IS_VALID_OK])
            ->asArray()
            ->indexBy('basicsGroupId')
            ->all();
        if(!empty($groupName)){
            if(!in_array($basicsGroupId  , array_keys($groupName))){
                return ['code' => Code::PARAM_ERR , 'msg' => '重复名称'];
            }
        }

        $basicsGroup->name = $name;
        $basicsGroup->type = $type;
        $basicsGroup->describe = $describe;
        if(!$basicsGroup->save()){
            return ['code' => Code::SUCCESS ,'msg'=>'修改失败'];
        }
        return ['code' => Code::SUCCESS ,'msg'=>'修改成功'];
    }

    /**
     * 新增
     * @return array
     */
    public function insert () {
        if(!$this->validate()){
            $firstItem = $this->getErrors();
            foreach ($firstItem as $value) {
                return ['code' => Code::PARAM_ERR ,'msg'=>$value[0]];
            }
        }
        $name = trim($this->attributes['name']);
        $type = $this->attributes['type'];
        $describe = $this->attributes['describe'];

        $groupName = BasicsGroupModel::find()->select(['basicsGroupId'])
            ->where(['name' => $name , 'isDelete' => BasicsGroupModel::IS_VALID_OK])
            ->count();
        if(0 < $groupName){
            return ['code' => Code::PARAM_ERR ,'msg'=>'重复名称'];

        }

        $basicsGroup = new BasicsGroupModel();
        $basicsGroup->name = $name;
        $basicsGroup->type = $type;
        $basicsGroup->describe = $describe;

        if(!$basicsGroup->save()){
            return ['code' => Code::PARAM_ERR ,'msg'=>'新增失败'];
        }
        return ['code' => Code::SUCCESS ,'msg'=>'新增成功'];
    }

    /**
     * 删除
     * @return array
     */
    public function del(){
        $basicsGroupId = $this->attributes['basicsGroupId'];

        if(empty($basicsGroupId)){
            return ['code' => Code::PARAM_ERR , 'msg' => '编号不能为空'];
        }
        $basicsGroup = BasicsGroupModel::find()
            ->where(['basicsGroupId' => $basicsGroupId])
            ->one();
        if(empty($basicsGroup)){
            return ['code' => Code::PARAM_ERR , 'msg' => '编号错误'];
        }
        $basicsGroup->isDelete = BasicsGroupModel::IS_VALID_NO;
        if(!$basicsGroup->save()){
            return ['code' => Code::SUCCESS ,'msg'=>'删除失败'];
        }
        return ['code' => Code::SUCCESS ,'msg'=>'删除成功'];

    }

    /**
     * 获得列表
     * @return array
     */
    public function getList () {
        $list = BasicsGroupModel::find()
            ->select(self::$listColumn)
            ->where(['type' => $this->type , 'isDelete' => BasicsGroupModel::IS_VALID_OK])
            ->asArray()
            ->all();
        return ['code' => Code::SUCCESS,'msg' => 'ok', 'data' => $list];
    }
}