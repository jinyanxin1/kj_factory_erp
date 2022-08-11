<?php
namespace common\models;

use common\library\helper\Code;
use common\models\SmsLog;
use common\models\user\UserModel;
use Yii;
use yii\base\Model;
use common\models\User;

/**
 * Signup form
 */
class SignupForm extends Model
{
    public $userAccount;
    public $userPwd;
    public $userType;
    public $userName;
    public $tel;
    public $email;
    public $company;
    public $groupId;
    public $checkCode;
    public $jobId;
    public $staffId;


    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            ['checkCode','safe'],
            ['userAccount', 'trim'],
            ['userAccount', 'required','message'=>'账号不能为空'],
//            ['userAccount', 'unique', 'targetClass' => '\common\models\User', 'message' => '账号已存在'],
            ['userAccount', 'string', 'min' => 2, 'max' => 64,'message'=>'账号过长'],

            ['email', 'trim'],
//            ['email', 'required','message'=>'邮箱不能为空'],
            ['email', 'email'],
            ['email', 'string', 'max' => 255],
//            ['email', 'unique', 'targetClass' => '\common\models\User', 'message' => '邮箱已存在'],


            ['tel', 'trim'],
            ['tel', 'required','message'=>'手机号不能为空'],
            [['tel'],'match','not'=>false,'pattern'=>'/^1[345789]\d{9}$/','message'=>'手机号格式不正确'],
//            ['tel', 'unique', 'targetClass' => '\common\models\User', 'message' => '手机号已存在'],

            ['userPwd','trim'],
            ['userPwd', 'required','message'=>'密码不能为空'],
            ['userPwd', 'string', 'length' => [6,12],'message'=>'密码的长度为6-12个字符'],
//            ['userPwd','match',
//                'pattern'=>'/^(?![0-9]+$)(?![a-zA-Z]+$)(?![0-9a-zA-Z]+$)(?![0-9\\W]+$)(?![a-zA-Z\\W]+$)[0-9A-Za-z\_\\W]{6,12}$/',
//                'message'=>'密码中必须包含字母、数字和特殊字符'
//            ]
        ];
    }

    /**
     * Signs user up.
     *
     */
    public function signup()
    {
        if (!$this->validate()) {
            $firstItem = current($this->getErrors());
            return ['code'=>100, 'msg'=>$firstItem[0]];
        }

//        $existUserAccount = User::findByUserAccount($this->userAccount);
        $existUserAccount = User::find()
            ->where(['userAccount' => $this->userAccount, 'isValid' => User::IS_VALID_OK])
            ->one();
        if (!empty($existUserAccount)) {
            switch ($this->userType) {
                case UserModel::STAFF:
                    if (!empty($existUserAccount->staffId)) {
                        return ['code'=>Code::PARAM_ERR,'msg'=>'手机号已存在'];
                    }else{
                        $existUserAccount->staffId = $this->staffId;
                        $existUserAccount->save();
                    }
                    return ['code'=>Code::SUCCESS,'msg'=>'注册成功','userId' =>$existUserAccount->id];
                    break;
                case UserModel::JOB:
                    if (!empty($existUserAccount->jobId)) {
                        return ['code'=>Code::PARAM_ERR,'msg'=>'手机号已存在'];
                    }else{
                        $existUserAccount->jobId = $this->jobId;
                        $existUserAccount->save();
                    }
                    return ['code'=>Code::SUCCESS,'msg'=>'注册成功','userId' =>$existUserAccount->id];
                    break;
            }
        }



        $user = new User();
        $user->userAccount = $this->userAccount;
        $user->userName = $this->userName;
//        $user->userType = $this->userType;//用户类型，注册时默认0
        $user->tel = $this->tel;
        $user->jobId = $this->jobId;
        $user->staffId = $this->staffId;
        $user->email = $this->email;
        $user->groupId = $this->groupId;
        $user->creator = 'system';
        $user->setPassword($this->userPwd);
        $user->generateAuthKey();
//        $user->creator = $this->userAccount;
//        $user->updater = $this->userAccount;
//        var_dump($user);die();
        try{
            if(!$user->save()){
                throw new \Exception('注册失败');
            }
            //验证码状态改为验证
//            SmsLog::updateAll(['isCheck'=>SmsLog::IS_CHECK],['tel'=>$this->tel,'code'=>$this->checkCode]);
        }catch(\Exception $e){
            Yii::info('-----sign up error----'.$e->getMessage());
            return ['code'=>Code::PARAM_ERR,'msg'=>$e->getMessage()];
        }

        return ['code'=>Code::SUCCESS,'msg'=>'注册成功','userId' =>$user->id];
    }

    /**
     * Sends confirmation email to user
     * @param User $user user model to with email should be send
     * @return bool whether the email was sent
     */
/*    protected function sendEmail($user)
    {
        return Yii::$app
            ->mailer
            ->compose(
                ['html' => 'emailVerify-html', 'text' => 'emailVerify-text'],
                ['user' => $user]
            )
            ->setFrom([Yii::$app->params['supportEmail'] => Yii::$app->name . ' robot'])
            ->setTo($this->email)
            ->setSubject('Account registration at ' . Yii::$app->name)
            ->send();
    }*/
}
