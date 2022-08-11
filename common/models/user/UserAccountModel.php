<?php
/**
 * @Author: jinyanxin
 * @Date: 2019/11/7
 * @Time: 14:30
 * 登录账号表
 */


namespace common\models\user;


use common\models\BaseModel;

class UserAccountModel extends BaseModel
{

    const STATUS_NORMAL = 1;    //正常
    const STATUS_DISABLED = 2;  //禁用

    public static function tableName()
    {
        return 'kj_user';
    }
    /*
     * 根据userId得到记录
     * */
    public static function getByUserId($userId)
    {
        return self::find()->where(array('userId'=>$userId,'isValid'=>self::IS_VALID_OK))->one();
    }
    /*
     * 根据账号找记录
     * */
    public static function getByUserName($userName)
    {
        return self::find()->where(array('userName'=>$userName,'isValid'=>self::IS_VALID_OK))->one();
    }

    /*
     * 新增学员时，账号密码表也需要新增一条记录
     * */
    public static function insertBySaveStudent($studentInfo)
    {
        if( empty($studentInfo) ){
            return false;
        }
        $info = self::getByUserId($studentInfo['userId']);
        if( empty($info) ){
            $info = new self();
            $info->userStatus = self::STATUS_NORMAL;
        }
        $info->userName = $studentInfo['loginAccount'];
        // 设置密码 初始密码 888888
        $info->userPwd = \Yii::$app->security->generatePasswordHash('888888');
        $info->userId = $studentInfo['userId'];
        $info->schoolId = $studentInfo['schoolId'];
        if( !$info->save() ){
            return false;
        }
        return true;
    }

    /*
     * 组织批量新增的数据
     * */
    public static function formatBatchSave($data)
    {
        $returnArr = array();
        $columnChar = '';
        if( count($data) > 0 ){
            $userPwd = \Yii::$app->security->generatePasswordHash('888888');
            foreach( $data as $info ){
                $publicColumn = self::setPublicColumn();
                $column = array(
                    'userType'=>1,
                    'userName'=>$info['loginAccount'],
//                    'userPwd'=>\Yii::$app->security->generatePasswordHash('888888'),//todo  设置密码
                    'userPwd'=>$userPwd,
                    'userId'=>$info['userId'],
                    'userStatus'=>self::STATUS_NORMAL,
                    'schoolId'=>$info['schoolId']
                );
                $userInfo = array_merge($column,$publicColumn);
                if( empty($columnChar) ){
                    $columnChar = array_keys($userInfo);
                }
                $returnArr[] = array_values($userInfo);
            }
        }
        return [
            'column'=>$columnChar,
            'data'=>$returnArr
        ];
    }

}