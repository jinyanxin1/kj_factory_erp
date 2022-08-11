<?php
/**
 * Created by PhpStorm.
 * User: zhouk
 * Date: 2019/7/31
 * Time: 17:48
 */

namespace common\models\admin;



use common\models\BaseModel;

class AdminPowerModel extends BaseModel
{

    const SELECT_TRUE = true;     //菜单按钮有权限
    const SELECT_FALSE = false;     //菜单无权限

    public static function tableName()
    {
        return 'kj_sys_admin_power';
    }

    /**
     * 获取用户组菜单权限数据
     * @param $groupId
     * @return array
     */
    public static function getMenuList($groupId,$type){
        $menuList = array();
        if(empty($groupId)){
            return $menuList;
        }

        $power = self::find()->select('menuId')->where(['groupId' => $groupId, 'isValid' => self::IS_VALID_OK])->asArray()->all();
        if(!empty($power)){
            $menuIds = array_column($power, 'menuId');
            $menuList = AdminMenuModel::getMenuList($menuIds,$type);
        }
//print_r($menuList);exit;
        return $menuList;
    }


    /**
     * 获取用户组权限菜单ids
     * @param $groupId
     * @return array|\yii\db\ActiveRecord[]
     */
    public static function getMenuPower($groupId,$type){
        $menuList = array();
        if(empty($groupId)){
            return $menuList;
        }

        $menuList = self::find()->select('menuId')
            ->where(['groupId' => $groupId, 'isValid' => self::IS_VALID_OK])
            ->andWhere(['type' => $type])
            ->asArray()->all();
        return array_column($menuList, 'menuId');
    }


    public static function savePowerInfo($power, $groupId,$type = 0){
        if(!empty($power)) {
            //处理选择的菜单id
            $selectIds = [];
            foreach ($power as $key => $value) {
                if (isset($value['isChecked']) && $value['isChecked'] == 'true') {
                    $selectIds[] = $value['menuId'];
                }
                if (isset($value['children']) && !empty($value['children'])) {
                    foreach ($value['children'] as $k => $val) {
                        if (isset($val['checked']) && $val['checked'] == 'true') {
                            $selectIds[] = $val['menuId'];
                        }
                        if (isset($val['children']) && !empty($val['children'])) {
                            foreach ($val['children'] as $v) {
                                if (isset($v['checked']) && $v['checked'] == 'true') {
                                    $selectIds[] = $v['menuId'];
                                }
                            }
                        }
                    }
                }
            }
            \Yii::info('选中数据:'. json_encode($selectIds));
            //得到现有的权限数据
            $powerNow = self::getMenuPower($groupId,$type);
            \Yii::info('现有数据:'. json_encode($powerNow));

            //对比得到中间值
            $same = array_intersect($selectIds, $powerNow);
            \Yii::info('相同数据:'. json_encode($same));

            //根据相同值对比现有数据得到需要删除的数据
            $delList = array_diff($powerNow, $same);
            \Yii::info('需删除数据:'. json_encode($delList));
            self::updateAll(['isValid' => self::IS_VALID_NO], ['and', ['in', 'menuId', $delList],['type' => $type], ['groupId' => $groupId]]);

            //根据相同值对比选择的数据，得到添加数据
            $insterList = array_diff($selectIds, $same);
            \Yii::info('添加数据:'. json_encode($insterList));
            //先查询现有删除数据
            $deleteIds = [];
            $selectList = self::find()->select('menuId,isValid')
                ->where(['groupId' => $groupId])
                ->andWhere(['type' => $type])
                ->andWhere(['in', 'menuId', $insterList])->asArray()->all();
            \Yii::info('更新数据:'. json_encode($selectList));
            if(!empty($selectList)){
                foreach ($selectList as $item) {
                    self::updateAll(['isValid' => self::IS_VALID_OK, 'updateTime' => date('Y-m-d H:i:s'), 'updater' => '管理员'],
                        ['groupId' => $groupId, 'menuId' => $item['menuId']]);
                    $deleteIds[] = $item['menuId'];
                }
            }

            $saveList = array_diff($insterList, $deleteIds);
            \Yii::info('新增数据:'. json_encode($saveList));
            if(!empty($saveList)) {
                foreach ($saveList as $item) {
                    $power = new AdminPowerModel();
                    $power->groupId = $groupId;
                    $power->menuId = $item;
                    $power->type = $type;
                    $power->isValid = self::IS_VALID_OK;
                    $power->save();
                }
            }
        }
    }

    /**
     * 获取用户组菜单权限
     * @param $groupId
     * @param $menuId
     * @param int $schoolId
     * @return array|null|\yii\db\ActiveRecord
     */
    public static function getGroupPower($groupId, $menuId, $schoolId = 0){
        return static::find()->where(['groupId' => $groupId, 'menuId' => $menuId, 'schoolId' => $schoolId])->one();

    }
}