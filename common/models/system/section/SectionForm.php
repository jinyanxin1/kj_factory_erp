<?php
/**
 * Created by cqj
 * User: cqj
 * Date: 2019/10/25
 * Time: 16:14
 */

namespace common\models\system\section;


use common\library\helper\Code;
use common\models\BaseForm;
use common\models\staffInfo\StaffInfoModel;

class SectionForm extends BaseForm
{
    public $name;
    public $sectionId;
    public $parentId;
    public $staffId;
    public $abbreviation;
    public $isCompany;
    public $startTime;
    public $code;

    public function rules() {
        return [
            ['name','required'],
            ['name','string','max'=>30,'message' => '名称长度不能大于三十字符'],
            ['name',function($attr, $params){
                $list = SectionModel::getAllList();
                $data = [] ;
                $checkName = $this->checkName($this->parentId ,$list , $data);
                foreach ( $checkName as $key => $value ) {
                    $data[] = $value['name'];
                }
                if (empty($this->sectionId)) {
                    if (in_array($this->name,$data)) {
                        $this->addError($attr, '下级组织名称重复');
                        return;
                    }
                }else{
                    foreach ($checkName as $value){
                        if ($value['name'] == $this->name && $value['id'] != $this->sectionId) {
                            $this->addError($attr, '下级组织名称重复');
                            return;
                        }
                    }
                }

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
        $staffIds = array_column($list,'staffId') ;
        $staffList = StaffInfoModel::find()->where(['staffId' => $staffIds])
            ->asArray()
            ->indexBy('staffId')
            ->all();

        foreach ( $list as $key => $value) {
            $list[$key]['staff'] = isset($staffList[$value['staffId']]) ?
                $staffList[$value['staffId']]['name'] : '';
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