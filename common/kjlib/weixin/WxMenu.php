<?php
namespace common\kjlib\weixin;

use yii;

/**
 * Created by 周滨.
 * Date: 2017/1/18
 * Time: 11:17
 * 微信菜单管理
 */
class WxMenu
{
    /*  $conditions 参数 参数详情，参见 个性化菜单
     * "matchrule":{
    "tag_id":"2",
    "sex":"1",
    "country":"中国",
    "province":"广东",
    "city":"广州",
    "client_platform_type":"2",
    "language":"zh_CN"
  }
    * return bool|mixed $conditions不为空，创建成功 返回 菜单Id,其他情况返回 bool
     * */
    public static function createMenu(array $buttons, $conditions = array())
    {
        if (count($conditions) > 0) {
            return yii::$app->wechat->createMenuConditional($buttons, $conditions);
        } else {
            return yii::$app->wechat->createMenu($buttons);
        }
    }

    //获取菜单详情
    public static function getMenu()
    {
        return yii::$app->wechat->getMenu();
    }

    //获取用户匹配的菜单
    public static function getUserMenuInfo($openId)
    {
        return yii::$app->wechat->getUserMenu($openId);
    }

    //删除菜单
    public static function delMenu()
    {
        return yii::$app->wechat->deleteMenu();
    }

}