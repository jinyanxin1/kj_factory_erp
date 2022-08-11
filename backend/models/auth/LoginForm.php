<?php
namespace backend\models\auth;


use common\models\admin\AdminModel;
use common\models\User;
use Yii;
use yii\base\Model;

/**
 * Login form
 */
class LoginForm extends Model
{
    public $adminAccount;
    public $adminPwd;
    public $userType;
    public $rememberMe = true;
    private $_user;
    public $codeKey = false;

    /**
     * @inheritdoc
     */
    public function rules()
    {

        $arr =  [
            // 账号，密码非空
            [['adminAccount', 'adminPwd'], 'required'],
            // 是否记住
            ['rememberMe', 'boolean'],
            // 密码验证
            ['adminPwd', 'validatePassword'],
            //验证码

        ];
//        if ($this->codeKey) {
//            $arr[] = ['verifyCode', 'required'] ;
//            $arr[] = ['verifyCode', 'captcha','captchaAction'=>'site/captcha','message'=>'验证码不正确！'] ;
//        }
        return $arr;
    }

    /*
   * * @return array customized attribute labels
   */
    public function attributeLabels()
    {
        return [
            // 'verifyCode' => 'Verification Code',
//            'verifyCode' => '验证码',
            'adminAccount' => '用户名',
            'adminPwd' => '密码',
        ];
    }


    /**
     * Validates the password.
     * This method serves as the inline validation for password.
     *
     * @param string $attribute the attribute currently being validated
     * @param array $params the additional name-value pairs given in the rule
     */
    public function validatePassword($attribute, $params)
    {
        if (!$this->hasErrors()) {
            $user = $this->getUser();
            if(!$user){
                $this->addError($attribute,'用户名不存在');
            }else if (!$user->validatePassword($this->adminPwd)) {
                $this->addError($attribute, '密码错误');
            }
        }
    }



    /**
     * Logs in a user using the provided username and password.
     *
     * @return boolean whether the user is logged in successfully
     */
    public function login()
    {
        //$this->validate(); 检查数据是否合法  合法true；否则false；
        if ($this->validate()) {
            return Yii::$app->user->login($this->getUser(), $this->rememberMe ? 5 : 0);
        } else {
            return false;
        }
    }


    /**
     * Finds user by [[username]]
     *
     * @return AdminModel|null
     */
    protected function getUser()
    {
        if ($this->_user === null) {
            $this->_user = User::findByUsernameType($this->adminAccount);
        }

        return $this->_user;
    }
}
