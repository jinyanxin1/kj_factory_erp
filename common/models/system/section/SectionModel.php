<?php
/**
 * Created by cqj
 * User: cqj
 * Date: 2019/10/24
 * Time: 10:20
 *  部门设置表
 */
namespace common\models\system\section;

use common\models\BaseModel;
use Yii;
use yii\helpers\Json;

class SectionModel extends BaseModel
{
    public static function tableName()
    {
        return 'kj_staff_section';
    }

    const IS_COMPANY_YES = 1 ;
    const IS_COMPANY_NO = 0 ;

    public static $COMPANY_ENUM = [
        self::IS_COMPANY_NO => '部门',
        self::IS_COMPANY_YES => '公司',
    ];

    private static $queryColumn = [
        'sectionId',
        'name',
        'parentId',
        'isCompany',
        'leader',
        'tel',
    ];

    private static $infoColumn = [
        'sectionId',
        'name',
        'parentId',
        'leader',
        'tel',
        'isCompany'
    ];

    /**
     * @return array
     * 获得所有部门列表
     */
    public static function getList(){
        $list = self::getAllList();
        if(empty($list)){
            return [] ;
        }
        $data = self::Recursive(0 , $list);
        return $data;
    }


    /**
     * 获得所有部门不分组
     * @return array|\yii\db\ActiveRecord[]
     */
    public static function getAllList(){
        $sectionData = self::find()
            ->where(['isValid' => self::IS_VALID_OK])
            ->asArray()
            ->all();
        return $sectionData;
    }

    /**
     * @param $id
     * @return array|\yii\db\ActiveRecord|null
     * 通过id获取部门信息
     */
    public static function getInfo($id){
        $info = self::find()
            ->where(['sectionId' => $id , 'isValid' => self::IS_VALID_OK])
            ->one();
        return $info;
    }

    /**
     * @param $parentId
     * @param $children
     * @return array
     * 递归所有
     */
    public static function Recursive($parentId, $children)
    {
        $data = [];
        foreach ($children as $key => $value) {
            if ($value['parentId'] == $parentId) {
                array_push($data,
                    array('sectionId' => intval($value['sectionId']),
                        'title' => $value['name'],
                        'parentId' => $value['parentId'],
                        'staffId' => $value['staffId'],
                        'staff' => $value['staff'],
                        'isCompany' => intval($value['isCompany']),
                        'company' => isset(self::$COMPANY_ENUM[intval($value['isCompany'])]) ?
                            self::$COMPANY_ENUM[intval($value['isCompany'])] : ''
                    ,
                        'children' => self::Recursive($value['sectionId'], $children)));
            }
        }
        return $data;
    }

    public static function RecursiveTwo($parentId, $children,$staff) {
        $data = [];
        foreach ($children as $key => $value) {
            if ($value['parentId'] == $parentId) {
                unset($children[$key]);
                $list = [];
                foreach ($staff as $item){
                    if($value['sectionId'] == $item['sectionId']){
                        $title = $item['name'];
                        if(!empty($item['jobNumber'])){
                            $title .= '['.$item['jobNumber'].']' ;
                        }
                        $list[] = [
                            'staffId' => $item['staffId'],
                            'title' => $title ,
                            'phone' => $item['phone'] ,
                            'sectionId' => $value['sectionId'] . '',
                        ];
                    }
                }
                $child = self::RecursiveTwo($value['sectionId'], $children,$staff);
                foreach ($child as $v) {
                    $list[] = $v;
                }
                array_push($data,
                    array('sectionId' => $value['sectionId'],
                        'title' => $value['name'],
                        'parentId' => $value['parentId'],
                        'children' => $list));
            }
        }
        return $data;
    }

    public static function getSectionId($id) {
        $sectionId = [];
        $info = self::getInfo($id);
        if (isset($info->parentId) && $info->parentId != 0) {
            $list = self::find()
                ->where(['isValid' => self::IS_VALID_OK])
                ->orderBy('sectionId')
                ->asArray()
                ->all();
            $sectionId = self::getArrSectionId($id,$list);
        }else{
            $sectionId[] = $id;
        }
        return $sectionId;
    }

    public static function getArrSectionId($pid,$children){
        $arr = [$pid];
        $true = true;
        while ($true) {
            foreach ($children as $value) {
                if ($value['sectionId'] == $pid) {
                    if ($value['parentId'] == 0) {
                        $true = false;
                        break;
                    }
                    $pid = $value['parentId'];
                    array_unshift($arr,$pid);
                }

            }
        }
        return $arr;
    }
    /**
     * 获得校区
     * @return array|\yii\db\ActiveRecord[]
     */
    public static function getCampus() {
        $list = self::getAllList();
        if(empty($list)){
            return [];
        }
        $campus = [] ;
        foreach ($list as $value){
            if($value['isCompany'] == SectionModel::IS_COMPANY_YES){
                $campus[] = [
                    'sectionId' => $value['sectionId'] ,
                    'name' => $value['name'] ,
                    'isCampus' => $value['isCampus'] ,
                ];
            }
        }
        return $campus;
    }
}
