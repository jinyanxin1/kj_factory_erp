<?php
/**
 * Created by cqj
 * User: cqj
 * Date: 2019/10/25
 * Time: 16:14
 */

namespace backend\models\system;


use common\library\helper\Code;
use common\models\BaseForm;
use common\models\course\CoursePriceModel;
use common\models\system\BasicsModel;
use common\models\system\SectionModel;

class SectionForm extends BaseForm
{
    public $name;
    public $sectionId;
    public $isCampus;
    public $parentId;
    public function rules() {
        return [
            ['name','required'],
            ['isCampus','required'],
//            ['parentId','required'],
            ['name','string','max'=>30,'message' => '名称长度不能大于三十字符'],
            ['name',function($attr, $params){
                if( !isset($this->parentId) || empty($this->parentId)) {
                    if( $this->isCampus == SectionModel::IS_CAMPUS_NO ) {
                        $this->addError($attr, '请选择上级部门');
                        return;
                    }
                }
                if ( $this->isCampus == SectionModel::IS_CAMPUS_YES ) {
                    $name = SectionModel::find()
                        ->select(['sectionId','name'])
                        ->where(['isDelete' => SectionModel::IS_VALID_OK,
                            'isCampus' =>  SectionModel::IS_CAMPUS_YES])
                        ->asArray()
                        ->all();
                    if (empty($this->sectionId)) {
                        if (!empty($name) && in_array($this->name,array_column($name,'name'))) {
                            $this->addError($attr, '校区名称重复');
                            return;
                        }
                    }else{
                        if (!empty($name) && in_array($this->name,array_column($name,'name'))) {
                            foreach ($name as $key => $value ) {
                                if ( $value['name'] == $this->name && $value['sectionId'] != $this->sectionId ) {
                                    $this->addError($attr, '校区名称重复');
                                    return;
                                }
                            }
                        }
                    }

                } else {
                    $list = SectionModel::getAllList();
                    $data = [] ;

                    $checkName = $this->checkName($this->parentId ,$list , $data);

                    foreach ( $checkName as $key => $value ) {
                        $data[] = $value['name'];
                    }
                    if (empty($this->sectionId)) {
                        if (in_array($this->name,$data)) {
                            $this->addError($attr, '下级部门名称重复');
                            return;
                        }
                    }else{
                        foreach ($checkName as $value){
                            if ($value['name'] == $this->name && $value['id'] != $this->sectionId) {
                                $this->addError($attr, '下级部门名称重复');
                                return;
                            }
                        }
                    }

                }





//                $name = SectionModel::find()
//                    ->select(['sectionId'])
//                    ->where(['isDelete' => SectionModel::IS_VALID_OK,'name' =>  $this->name])
//                    ->one();
//                if(!empty($name)){
//                    if(empty($this->sectionId)){
//                        $this->addError($attr, '名称重复');
//                        return;
//                    }else{
//                        if($this->sectionId != $name ->sectionId){
//                            $this->addError($attr, '名称重复');
//                            return;
//                        }
//                    }
//
//                }
            }]
        ];
    }
    public function attributeLabels()
    {
        return [
            'name' => '名称' ,
        ];
    }
    public function getList(){
        //获得所有的部门
        $list = SectionModel::getAllList();
        //获得部门职能的基本参数
        $basicsName = BasicsModel::getList(BasicsModel::DEP_TYPE);
        $basicsName = array_combine(array_column($basicsName,'basicsId'),$basicsName);
        foreach ($list as $key => $value) {
            $list[$key]['basicsName']  = '' ;
            if(!empty($value['basicsId']) && isset($basicsName[$value['basicsId']])){
                $list[$key]['basicsName'] = $basicsName[$value['basicsId']]['name'] ;
            }
        }
        $data = SectionModel::Recursive(0,$list) ;
        return $data ;
    }

    public function checkName($parentId,$children,$data) {
        foreach ( $children as $key => $value) {
            if ($value['parentId'] == $parentId) {
                $data[] = ['name' => $value['name'] ,'id'=>$value['sectionId']];
                $data = $this->checkName($value['sectionId'], $children,$data);
            }
        }
        return $data;
    }

    public static function getChildrenId($parentId,$children,$data) {
        foreach ( $children as $key => $value) {
            if ($value['parentId'] == $parentId) {
                $data[] = $value['sectionId'] ;
                $data = self::getChildrenId($value['sectionId'], $children,$data);
            }
        }
        return $data;
    }
}