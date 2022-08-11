<?php
/**
 * Created by PhpStorm.
 * User: zhouk
 * Date: 2019/7/31
 * Time: 17:49
 */

namespace common\models\adminGroup;


class AdminGroupBackend extends AdminGroupModel
{

    /**
     * 根据id 查询用户组信息
     * @param $id
     * @return array|null|\yii\db\ActiveRecord
     */
    public static function getInfo($id) {
        $arrWhere = ['groupId' => $id, 'isValid' => self::IS_VALID_OK] ;

        return static::find()->where($arrWhere)->one() ;
    }

    /**
     *格式化所有数据
     * @return array
     */
    public static function formatSelect($dataList) {
        //TODO 按照需求格式化数据
        $formatData = [] ;
        if (empty($dataList)) {
            return [] ;
        }
        $formatData = self::cation($dataList,0,[]);
        return $formatData ;
    }


    /**
     * 递归三级
     * @param $arr
     * @param int $num
     * @return array
     */
    static  function cation($arr,$num=0,$pidArr = [])
    {
        $list = [];
        foreach ($arr as $k => $v) {
            if($v['parentId'] == $num){
                if ($num != 0 ) {
                    $pidArr[] = $v['parentId'];
                }
                $item['pidArr'] = $pidArr;
                $item['value'] = $v['groupId'];
                $item['title'] = $v['groupName'];
                $item['parentId'] = $v['parentId'];
                $item['roleType'] = $v['roleType'];
                $item['roleTypeName'] = $v['roleTypeName'];
                $item['children'] = self::cation($arr,$v['groupId'],$pidArr);
                $list[] = $item;
            }
        }
        return $list;
    }

    public static function getPositionId($id) {
        $positionId = [];
        $info = self::find()
            ->where(['groupId' => $id , 'isValid' => self::IS_VALID_OK])
            ->one();
        if (isset($info->parentId) && $info->parentId != 0) {
            $list = self::find()
                ->where(['isValid' => self::IS_VALID_OK])
                ->orderBy('groupId')
                ->asArray()
                ->all();
            $positionId = self::getArrParentId($id,$list);
        }else{
            $positionId[] = $id;
        }
        return $positionId;
    }

    public static function getArrParentId($pid,$children){
        $arr = [$pid];
        $true = true;
        while ($true) {
            foreach ($children as $value) {
                if ($value['groupId'] == $pid) {
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

}