<?php
/**
 * Created by PhpStorm.
 * User: zhouk
 * Date: 2019/7/31
 * Time: 17:48
 */

namespace common\models\admin;



use common\library\helper\Code;
use common\models\BaseModel;
use common\models\User;
use Yii;

class AdminMenuModel extends BaseModel
{
    //菜单类型
    const MENU_TYPE_NORMAl = 1 ;
    
    //默认排序
    const MENU_DEFAULT_SORT = 0 ;
    public static function tableName()
    {
        return 'kj_sys_admin_menu';
    }

    /*
     * 后台，根据当前登录用户id和groupId获取所能管理的菜单
     * type : school  不是查询学校的权限菜单，system 表示查询系统的
     * */
    public static function getMenuByLoginAdminIdAndGroupId($userId,$groupId,$type='system')
    {
        $adminInfo = User::find()->where(['id'=>$userId])->asArray()->one();
        if(empty($adminInfo)){
            return ['code'=>Code::PARAM_ERR,'msg'=>'用户未找到'];
        }
        $adminGroupId  = $adminInfo['groupId'];
        //获取当前登录用户的管理菜单
        $adminGroupMenuIds = AdminPowerModel::getMenuPower($adminGroupId,$type);
        //获取菜单
        $menuList = AdminMenuModel::getNormalMenu($adminGroupMenuIds,$type);
        $power = AdminPowerModel::getMenuPower($groupId,$type);
        $dataList = AdminMenuModel::formatPowerData($menuList, $power);
        return ['code'=>0,'msg'=>'ok','data'=>$dataList];
    }



    /**
     * 获取菜单数据
     * @param $menuIds
     * @return array
     */
    public static function getMenuList($menuIds,$type = 0)
    {
        $dataList = [];
        if (!empty($menuIds)) {
            $query = self::find()
                ->select('menuId,parentId,menuName,menuUrl,menuIcon,
                btnTitle,btnClass,btnType,btnHandle,interface,btnHandleParams,btnIsTable')
                ->where(['isValid' => self::IS_VALID_OK])
                ->andWhere(['type' => $type]);
            if (is_array($menuIds)) {
                $query->andWhere(['in', 'menuId', $menuIds]);
            } else {
                $query->andWhere(['menuId' => $menuIds]);
            }
            //$isSuperAdmin = Yii::$app->user->identity->isSuperAdmin;
//            if($isSuperAdmin == AdminModel::NO_SUPER_ADMIN) {
//                $query->andWhere(['isSuperAdmin' => $isSuperAdmin]);
//            }
            $query = $query->orderBy('parentId,menuId asc')->asArray()->all();
            if (!empty($query)) {
                foreach ($query as $key => $value) {
                    $value['expand'] = true;
                    $level = [];
                    if (empty($value['parentId'])) {
                        //一级菜单
                        $value['children'] = [];
                        $dataList[$value['menuId']] = $value;
                    } else {
                        if (isset($dataList[$value['parentId']])) {
                            //二级菜单
                            $dataList[$value['parentId']]['children'][$value['menuId']] = $value;
                            $level[$value['menuId']] = $value['parentId'];
                        } else {
                            //三级菜单
                            if (!empty($level[$value['parentId']])) {
                                $dataList[$level[$value['parentId']]]['children'][$value['parentId']]['children'][$value['menuId']] = $value;
                            } else {
                                $parentInfo = self::getParentByidFromList($query,$value['parentId']) ;
                                //$parentInfo = self::find()->select('menuId,parentId')->where(['isValid' => self::IS_VALID_OK, 'menuId' => $value['parentId']])->one();
                                if (!empty($parentInfo)) {
                                    $dataList[$parentInfo['parentId']]['children'][$value['parentId']]['children'][] = $value;
                                }
                            }
                        }
                    }
                }
            }
        }
        return self::resetList($dataList);
    }


    /**
     * 获取所有菜单数据
     */
    public static function getAllMenu($type = 0)
    {
        $dataList = [];
        $query = self::find()->select('menuId,parentId,menuName,menuUrl,menuType,menuLevel,menuIcon,
            interface,btnTitle,btnClass,btnType,btnHandle,btnHandleParams,btnIsTable,sort')
            ->where(['isValid' => self::IS_VALID_OK])
            ->andWhere(['type' => $type]);


        $query = $query->orderBy('menuLevel asc,sort desc,menuId asc')->asArray()->all();
        if (!empty($query)) {
            foreach ($query as $key => $value) {
                $value['expand'] = false;
                $value['title'] = $value['menuName'];
                $level = [];
                if (empty($value['parentId'])) {
                    //一级菜单
                    $value['children'] = [] ;
                    $dataList[$value['menuId']] = $value ;
                } else {
                    if (isset($dataList[$value['parentId']])) {
                        //二级菜单
                        $dataList[$value['parentId']]['children'][$value['menuId']] = $value ;
                        $level[$value['menuId']] = $value['parentId'] ;
                    } else {
                        //三级菜单 todo 优化，已经把数据全部查出来了，为什么还要查询一次。
                        if (!empty($level[$value['parentId']])) {
                            $dataList[$level[$value['parentId']]]['children'][$value['parentId']]['children'][$value['menuId']] = $value ;
                        } else {
                            //$parentInfo = self::find()->select('menuId,parentId')->where(['isValid' => self::IS_VALID_OK, 'menuId' => $value['parentId']])->one() ;
                            $parentInfo = self::getParentByidFromList($query,$value['parentId']) ;
                            if (!empty($parentInfo)) {
                                $dataList[$parentInfo['parentId']]['children'][$value['parentId']]['children'][] = $value ;
                            }
                        }
                    }
                }
            }
        }
        return self::resetList($dataList);
    }

    /**
     * 获取父级数据
     * @return array
     */
    public static function getParentByidFromList($dataList,$parentId) {
        $returnArray = array() ;
        if( !empty($dataList) ) {
            foreach ($dataList as $key => $value) {
                if( $parentId==$value['menuId']  ) {
                    $returnArray = $value ;
                    break ;
                }
            }
        }
        return $returnArray ;
    }

    /**
     * 获取菜单数据
     * @return array|\yii\db\ActiveRecord[]
     * type: system 查询系统的所有菜单；system查询处平台管理外的菜单
     */
    public static function getNormalMenu($menuIds = [],$type = 0)
    {
        $dataList = self::find()->select('menuId,parentId,menuName,menuUrl,menuType,menuLevel,menuIcon,
                interface,btnTitle,btnClass,btnType,btnHandle,btnHandleParams,btnIsTable')
            ->where(['isValid' => self::IS_VALID_OK]);
//        if(count($menuIds) > 0){
//            $dataList->andWhere(['menuId'=>$menuIds]);
//        }
        $dataList->andWhere(['type'=>$type]);

         return  $dataList->orderBy('parentId,menuLevel,sort')->indexBy('menuId')->asArray()->all();//
    }


    /**
     * 格式化菜单权限数据
     * @param $menuList
     * @param $power
     * @return array
     */
    public static function formatPowerData($menuList, $power)
    {
        $dataList = [];
        foreach ($menuList as $key => $value) {
            if (!empty($power) && in_array($key, $power)) {
                $value['checked'] = AdminPowerModel::SELECT_TRUE;
                $value['isChecked'] = AdminPowerModel::SELECT_TRUE;
            } else {
                $value['checked'] = AdminPowerModel::SELECT_FALSE;
                $value['isChecked'] = AdminPowerModel::SELECT_FALSE;
            }
            $value['expand'] = true;
            $value['title'] = $value['menuName'];
            $level = [];
            if (empty($value['parentId'])) {
                //一级菜单
                $value['children'] = [];
                $dataList[$value['menuId']] = $value;
            } else {
                if (isset($dataList[$value['parentId']])) {
                    //二级菜单
                    $dataList[$value['parentId']]['children'][$value['menuId']] = $value;
                    $level[$value['menuId']] = $value['parentId'];
                    if($value['isChecked'] == AdminPowerModel::SELECT_FALSE){
                        $dataList[$value['parentId']]['checked'] = AdminPowerModel::SELECT_FALSE;
                    }
                } else {
                    //三级菜单
                    if (!empty($level[$value['parentId']])) {
                        $dataList[$level[$value['parentId']]]['children'][$value['parentId']]['children'][$value['menuId']] = $value;
                        if($value['isChecked'] == AdminPowerModel::SELECT_FALSE){
                            $dataList[$level[$value['parentId']]]['children'][$value['parentId']]['checked'] = AdminPowerModel::SELECT_FALSE;
                        }
                    } else {
                        $parentInfo = self::getParentByidFromList($menuList,$value['parentId']) ;
                        //$parentInfo = self::find()->select('menuId,parentId')->where(['isValid' => self::IS_VALID_OK, 'menuId' => $value['parentId']])->one();
                        if (!empty($parentInfo)) {
                            $dataList[$parentInfo['parentId']]['children'][$value['parentId']]['children'][] = $value;
                            if($value['isChecked'] == AdminPowerModel::SELECT_FALSE){
                                $dataList[$parentInfo['parentId']]['children'][$value['parentId']]['checked'] = AdminPowerModel::SELECT_FALSE;
                            }
                        }
                    }
                }
            }
        }

        return self::resetList($dataList);
    }


    /**
     * 添加菜单子节点
     * @param $menuId
     * @param $menuName
     * @param $menuLevel
     * @return array
     */
    public static function saveSonList($menuId, $menuName, $menuLevel)
    {
        $idList = [];

        for ($i = 0; $i < 3; $i++) {
            if ($i == 0) {
                $name = $menuName . '新增';
            } else if ($i == 1) {
                $name = $menuName . '修改';
            } else {
                $name = $menuName . '删除';
            }

            $menu = new AdminMenuModel();
            $menu->parentId = $menuId;
            $menu->menuLevel = $menuLevel;
            $menu->menuName = $name;
            $menu->isValid = AdminMenuModel::IS_VALID_OK;
            $menu->save();

            $power = new AdminPowerModel();
            $power->groupId = 1;
            $power->menuId = $menu->menuId;
            $power->isValid = AdminPowerModel::IS_VALID_OK;
            $power->save();
        }
        return $idList;
    }

    public static function resetList($dataList)
    {
        $result = [];
        if (!empty($dataList)) {
            foreach ($dataList as $key => $value) {
                $children = [];
                foreach ($value['children'] as $k => $val) {
                    $children = array_reverse($value['children']);
                }
                $value['children'] = array_reverse($children);
                $result[] = $value;
            }
        }

        return $result;
    }


    /**
     * @author  zhouky
     * @duty 根据接口名查询菜单
     * @param $interface
     * @param bool $asArray
     * @return array|null|\yii\db\ActiveQuery|\yii\db\ActiveRecord
     */
    public static function getMenuByInterface($interface, $asArray = false){
        $info = static::find()->where(['interface' => $interface, 'isValid' => self::IS_VALID_OK]);
        if($asArray){
            $info->asArray();
        }

        $info = $info->one();
        return $info;
    }
}