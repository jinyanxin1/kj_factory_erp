<?php
/**
 * @Author: jinyanxin
 * @Date: 2019/11/9
 * @Time: 14:30
 * 微信端存储openid的表
 */


namespace common\models\user;


use common\models\BaseModel;

class UserApiLoginModel extends BaseModel
{

    public static function tableName()
    {
        return 'kj_userapi_login';
    }

    /*
     * 根据useId得到openId
     *
     * */
    public static function getByUserId($userIds)
    {
        return self::find()
            ->where(array('loginUserId'=>$userIds,'isValid'=>self::IS_VALID_OK))->indexBy('loginUserId')->asArray()->all();
    }


    /**
     * @author zhouky
     * @duty 根据openId拿到用户信息
     * @param $openId
     * @return array|null|\yii\db\ActiveRecord
     */
    public static function getByOpenId($openId){
        return self::find()
            ->where(['loginName'=>$openId, 'isValid'=>self::IS_VALID_OK])->one();
    }

    /*
     * 数据处理获取最新添加的绑定记录
     * */

    public static function duplicateRemoval($userId){

        $data = self::find()
            ->where(array('loginUserId'=>$userId,'isValid'=>self::IS_VALID_OK))
            ->asArray()->all();

        $apiLogin = [];
        foreach ($data as $value) {

            //当出现多条数据的时候替换成修改时间最新的一条记录，没有则直接加入$apiLogin
            if (isset($apiLogin[$value['loginUserId']])) {

                //获取当前已存在apiLogin的用户时间（秒）
                $apiLoginSecond = strtotime($apiLogin[$value['loginUserId']]['updateTime']);
                //获取当前对比的用户时间（秒）
                $valueSecond = strtotime($value['updateTime']);
                if ($valueSecond > $apiLoginSecond) {
                    $apiLogin[$value['loginUserId']] = $value;
                }
            }else{
                $apiLogin[$value['loginUserId']] = $value;
            }
        }

        return $apiLogin;
    }
}