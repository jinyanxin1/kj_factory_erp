<?php
/**
 * Created by PhpStorm.
 * User: zhouk
 * Date: 2019/8/1
 * Time: 20:05
 */

namespace backend\actions\auth;


use backend\actions\BaseAction;
use common\library\helper\Code;
use common\models\admin\AdminMenuModel;
use yii\base\Exception;

class MenuOrderAction extends BaseAction
{
    public function run(){
        $menuList = $this->request()->post('menuList');

        if(empty($menuList)){
            return $this->returnApi(Code::PARAM_ERR, '请传递排序列表');
        }

        $tran = \Yii::$app->db->beginTransaction();
        try{
            $order = 1;
            //一级菜单
            foreach ($menuList as $item) {
                if(isset($item['menuId'])){
                    $menuInfo = AdminMenuModel::find()
                        ->where(['menuId' => $item['menuId'], 'isValid' => AdminMenuModel::IS_VALID_OK])->one();
                    if(!empty($menuInfo)){
                        $menuInfo->sort = $order;
                        $menuInfo->save();
                        $order++;
                    }
                }
                //二级菜单
                if(isset($item['children'])){
                    foreach ($item['children'] as $second) {
                        if(isset($second['menuId'])){
                            $menuInfo = AdminMenuModel::find()
                                ->where(['menuId' => $second['menuId'], 'isValid' => AdminMenuModel::IS_VALID_OK])->one();
                            if(!empty($menuInfo)){
                                $menuInfo->sort = $order;
                                $menuInfo->save();
                                $order++;
                            }
                        }
                        //三级菜单
                        if(isset($second['children'])){
                            foreach ($second['children'] as $third) {
                                if(isset($third['menuId'])){
                                    $menuInfo = AdminMenuModel::find()
                                        ->where(['menuId' => $third['menuId'], 'isValid' => AdminMenuModel::IS_VALID_OK])->one();
                                    if(!empty($menuInfo)){
                                        $menuInfo->sort = $order;
                                        $menuInfo->save();
                                        $order++;
                                    }
                                }
                            }
                        }
                    }
                }
            }
            $tran->commit();

        }catch (Exception $exception){
            $tran->rollBack();
            \Yii::info('排序失败：'. $exception->getMessage());
            return $this->returnApi(Code::SYSTEM_ERR, '接口错误');
        }
        return $this->returnApi(Code::SUCCESS, '修改成功');

    }

}