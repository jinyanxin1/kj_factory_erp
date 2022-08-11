<?php
namespace common\kjlib\auth;

/**
 * Created by 周滨.
 * Date: 2017/3/14
 * Time: 16:28
 */
use common\models\RbacRelation;
use yii;
use common\models\User;

class KjRbac
{
    private static $instance = null;

    /*
     * 获取实例
     * */
    public static function getInstance()
    {
        if (self::$instance === null) {
            self::$instance = new self;
        }
        return self::$instance;
    }
    /*
     * 根据权限是否显示菜单
     * */
    public static function chkMenuByPermission(yii\web\User $user,$permissionName){
        if($user->identity->userRole == User::USER_TYPE_ADMIN){
            return true;
        }else{
           return $user->can($permissionName);
        }
    }
    /*
     * 创建角色
     * @return 返回角色对象
     *  */
    public function createRole($name, $desc)
    {
        $auth = Yii::$app->authManager;
        $role = $auth->createRole($name);
        $role->description = $desc;
        return $auth->add($role) ? $role : null;
    }

    public function getRoles()
    {
        $auth = Yii::$app->authManager;
        return $auth->getRoles();
    }

    public function getPermissionTree()
    {
        $relations = RbacRelation::getRelations();
        $auth = Yii::$app->authManager;
        $allPermission = $auth->getPermissions();
        return $this->bulidPerTreeByShip($relations, $allPermission);
    }

    private function bulidPerTreeByShip($relations, $allPermission)
    {
        $tree = array();
        foreach ($relations as $item) {
            if (isset($allPermission[$item['name']])) {
                $child['name'] = $item['name'];
                $child['lev'] = $item['lev'];
                $child['permission'] = $allPermission[$item['name']];
                if (isset($item['child'])) {
                    $child['child'] = $this->bulidPerTreeByShip($item['child'], $allPermission);
                }
                $tree[] = $child;
            }
        }
        return $tree;
    }

    /*
    * 删除角色
    * @return bool
    *  */
    public function remove($role)
    {
        $auth = Yii::$app->authManager;
        if (!$role instanceof \yii\rbac\Role) {
            $roleObj = $auth->createRole($role);
        } else {
            $roleObj = $role;
        }
        return $auth->remove($roleObj);
    }

    /*
     * 将权限赋给角色
     * */
    public function addPermissionForRole($role, $permission)
    {
        $auth = Yii::$app->authManager;
        if (!$role instanceof \yii\rbac\Role) {
            $roleObj = $auth->createRole($role);
        } else {
            $roleObj = $role;
        }
        if (!$permission instanceof \yii\rbac\Permission) {
            $permissionObj = $auth->createPermission($permission);
        } else {
            $permissionObj = $permission;
        }
        return $auth->addChild($roleObj, $permissionObj);                      //添加对应关系
    }

    /*
    * 为角色添加子角色
    * */
    public function addChildRole($parent, $child)
    {
        $auth = Yii::$app->authManager;
        if (!$parent instanceof \yii\rbac\Role) {
            $parentObj = $auth->createRole($parent);
        } else {
            $parentObj = $parent;
        }
        if (!$child instanceof \yii\rbac\Role) {
            $childObj = $auth->createRole($child);
        } else {
            $childObj = $child;
        }
        return $auth->addChild($parentObj, $childObj);
    }

    /*
     * 移除用户角色并分配新角色
     * */
    public function addRoleToUser($role, $userId)
    {
        $auth = Yii::$app->authManager;
        if (!$role instanceof \yii\rbac\Role) {
            $roleObj = $auth->createRole($role);
        } else {
            $roleObj = $role;
        }
        $auth->revokeAll($userId);
        $auth->assign($roleObj, $userId);                           //添加对应关系
    }

    /*
    * 删除角色权限
    * */
    public function removePermissionFromRole($role, $permission)
    {
        $auth = Yii::$app->authManager;
        if (!$role instanceof \yii\rbac\Role) {
            $roleObj = $auth->createRole($role);
        } else {
            $roleObj = $role;
        }
        if (!$permission instanceof \yii\rbac\Permission) {
            $permissionObj = $auth->createPermission($permission);
        } else {
            $permissionObj = $permission;
        }
        return $auth->removeChild($roleObj, $permissionObj);                      //添加对应关系
    }

    /*
     * 去掉角色前缀
     * */

    public function removeRolePrix($companyId, $roleName)
    {
        return preg_replace("/^{$companyId}_/", '', $roleName);
    }

    /*
    * 添加权限
    * */
    public function createPermission($name, $desc)
    {
        $auth = Yii::$app->authManager;
        $createPost = $auth->createPermission($name);
        $createPost->description = $desc;
        return $auth->add($createPost) ? $createPost : null;

    }

    /*
     * 将权限赋给父权限、子权限
     * */
    public function addChildForPermission($parent, $child)
    {
        $auth = Yii::$app->authManager;
        if (!$parent instanceof \yii\rbac\Permission) {
            $parentObj = $auth->createPermission($parent);
        } else {
            $parentObj = $parent;
        }
        if (!$child instanceof \yii\rbac\Permission) {
            $childObj = $auth->createPermission($child);
        } else {
            $childObj = $child;
        }
        return $auth->addChild($parentObj, $childObj);
    }
}
