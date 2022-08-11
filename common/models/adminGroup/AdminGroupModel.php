<?php
/**
 * Created by PhpStorm.
 * User: zhouk
 * Date: 2019/7/31
 * Time: 17:48
 */

namespace common\models\adminGroup;


use common\models\BaseModel;

class AdminGroupModel extends BaseModel
{
    const ROLE_TYPE_ONE = 1;
    const ROLE_TYPE_TWO = 2;
    const ROLE_TYPE_THREE = 3;

    public static  $ROLE_TYPE =  [
        self::ROLE_TYPE_ONE => '员工',
        self::ROLE_TYPE_TWO => '部门主管',
        self::ROLE_TYPE_THREE => '超级管理员',
    ];

    public static function tableName()
    {
        return 'kj_sys_admin_group';
    }


    public static function getGroupList($schoolId)
    {
        return static::find()->where(['isValid' => self::IS_VALID_OK, 'schoolId' => $schoolId])->asArray()->all();
    }


    //获取生产岗位id
    public static function getProduction()
    {
        $returnIds = [];
        $group = self::find()->where(['groupName'=>'生产','isValid'=>self::IS_VALID_OK])->asArray()->one();
        if(!empty($group)){
            $all = self::find()->where(['isValid'=>self::IS_VALID_OK])->asArray()->all();
            $returnIds = self::get_all_child($all,$group['groupId']);
            $returnIds[] = $group['groupId'];
        }
        return $returnIds;
    }

    public static function get_all_child($array,$id){
        $arr = array();
        foreach($array as $v){
            if($v['parentId'] == $id){
                $arr[] = $v['groupId'];
                $arr = array_merge($arr,self::get_all_child($array,$v['groupId']));
            };
        };
        return $arr;
    }

}