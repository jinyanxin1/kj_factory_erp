<?php
namespace common\kjlib\weixin;

use yii;
use yii\base\Exception;

/**
 * Created by 周滨.
 * Date: 2017/1/18
 * Time: 10:44
 * 微信用户管理
 */
class WxUser
{
    //为用户打标签
    public static function setUserTag($openIdList, $tagId)
    {
        if (!empty($openIdList)) {
            if (is_array($openIdList)) {
                $openList = $openIdList;
            } else {
                $openList = array($openIdList);
            }
            $data = array();
            $data['openid_list'] = $openList;
            $data['tagid'] = $tagId;
            return yii::$app->wechat->batSetUserTag($data);
        } else {
            throw new Exception('设置标签用户列表为空');
        }
    }

    //取消用户标签
    public static function delUserTag($openIdList, $tagId)
    {
        if (!empty($openIdList)) {
            if (is_array($openIdList)) {
                $openList = $openIdList;
            } else {
                $openList = array($openIdList);
            }
            $data = array();
            $data['openid_list'] = $openList;
            $data['tagid'] = $tagId;
            return yii::$app->wechat->batDelUserTag($data);
        } else {
            throw new Exception('取消标签用户列表为空');
        }
    }
    //获取用户信息
    public static function getUserInfo($openId){
        return yii::$app->wechat->getUserInfo($openId);
    }
}
