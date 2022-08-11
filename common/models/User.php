<?php
namespace common\models;

use Yii;
use yii\base\NotSupportedException;
use yii\web\IdentityInterface;

/**
 * User model
 * @package common\models\user
 * @property integer $id
 * @property String  $userAccount
 * @property integer $userPwd
 * @property integer $userType
 * @property integer $userName
 * @property integer $tel
 * @property integer $authKey
 * @property integer $groupId
 * @property integer $staffId
 * @property integer $jobId
 */
class User extends BaseModel implements IdentityInterface
{

    const USER_TYPE_C = 4;//C端
    const USER_TYPE_B_LOGISTICS = 2;//B端后勤
    const USER_TYPE_B_MANAGE = 1;//B端管理
    const USER_TYPE_B_WORK = 3;//B端工作

    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'kj_user';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        $r = [
            ['userName', 'trim'],
            ['userName', 'required','message'=>'姓名不能为空'],
            ['userName', 'string', 'max' => 32,'message'=>'姓名过长'],


            ['tel', 'trim'],
            ['tel', 'required','message'=>'手机号不能为空'],
            [['tel'],'match','not'=>false,'pattern'=>'/^1[345789]\d{9}$/','message'=>'手机号格式不正确'],

        ];
        return $r;
    }

    /**
     * 更具账号找到用户
     * @param  [type] $userAccount [description]
     * @return [type]           [description]
     */
    public static function findByUsername($userAccount) {
        return static::findOne(['userAccount' => $userAccount, 'isValid' => self::IS_VALID_OK]);
    }

    /**
     * 更具账号找到用户
     * @param  [type] $userAccount [description]
     * @return [type]           [description]
     */
    public static function findByUsernameType($userAccount) {
        return static::findOne(['userAccount' => $userAccount, 'isValid' => self::IS_VALID_OK]);
    }

    /**
     * 根据分组查询后台用户
     * @param $groupId
     * @return array|\yii\db\ActiveRecord[]
     */
    public static function getListByGroup($groupId)
    {
        $dataList = [];
        if (!empty($groupId)) {
            $dataList = static::find()->where(['isValid' => self::IS_VALID_OK, 'groupId' => $groupId])->all();
        }
        return $dataList;
    }

    /**
     * {@inheritdoc}
     */
    public static function findIdentity($id)
    {
        return static::findOne(['id' => $id, 'isValid' => self::IS_VALID_OK]);
    }

    /**
     * {@inheritdoc}
     */
    public static function findIdentityByAccessToken($token, $type = null)
    {
        throw new NotSupportedException('"findIdentityByAccessToken" is not implemented.');
    }

    public static function findByUserAccount($userAccount)
    {
        return static::findOne(['userAccount' => $userAccount, 'isValid' => self::IS_VALID_OK]);
    }



    /**
     * {@inheritdoc}
     */
    public function getId()
    {
        return $this->getPrimaryKey();
    }

    /**
     * {@inheritdoc}
     */
    public function getAuthKey()
    {
        return $this->authKey;
    }

    /**
     * {@inheritdoc}
     */
    public function validateAuthKey($authKey)
    {
        return $this->getAuthKey() === $authKey;
    }

    /**
     * Validates password
     *
     * @param string $password password to validate
     * @return bool if password provided is valid for current user
     */
    public function validatePassword($password)
    {
        return Yii::$app->security->validatePassword($password, $this->userPwd);
    }

    /**
     * Generates password hash from password and sets it to the model
     *
     * @param string $password
     */
    public function setPassword($password)
    {
        $this->userPwd = Yii::$app->security->generatePasswordHash($password);
    }

    /**
     * Generates "remember me" authentication key
     */
    public function generateAuthKey()
    {
        $this->authKey = Yii::$app->security->generateRandomString();
    }

}
