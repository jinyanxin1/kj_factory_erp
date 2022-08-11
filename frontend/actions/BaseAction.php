<?php
/**
 * User: pyj
 * Date: 2020/8/18
 * Time: 10:02
 */

namespace frontend\actions;


use common\kjlib\auth\AuthCode;
use common\kjlib\auth\WXUserAuth;
use common\library\helper\Code;
use common\models\User;
use yii\base\Action;
use yii\helpers\Json;
use yii\web\Response;
use Yii;

class BaseAction extends Action
{

    public $userId = null;
    public $loginGroupId = 0;
    public $jobId = null;
    public $staffId = null;
    public $token = NULL;
    public $tokenData = null;
    public $loginUserName;
    public function init()
    {
        parent::init();
        \Yii::$app->response->format = Response::FORMAT_JSON;
        $token = $this->request()->post('token');
        if (empty($token)) {
            $token = $this->request()->get('token');
        }

        $this->tokenData = \Yii::$app->cache->get($token);
        Yii::info('------- frontend wxaction info'.$this->tokenData);
        if(empty($this->tokenData)){
            echo Json::encode( $this->returnApi(Code::LOGIN_ERR, '请进行登录',
                ['imgUrl' => Yii::$app->params['imageUrl']]));
            exit();
        }else{
            $data = Json::decode($this->tokenData);
            $userInfo = $data['userInfo'] ?? '';
            $staff = $data['staffId'] ?? '';
            $job = $data['jobId'] ?? '';
            $userId = AuthCode::authcode($userInfo, 'DECODE', WXUserAuth::WEIXIN_COOKIE_KEY);
            $staffId = AuthCode::authcode($staff, 'DECODE', WXUserAuth::WEIXIN_COOKIE_KEY);
            $jobId = AuthCode::authcode($job, 'DECODE', WXUserAuth::WEIXIN_COOKIE_KEY);
            Yii::info('is Login userId:'.$userId);
            if (empty($userId) && empty($staffId)) {
                echo Json::encode( $this->returnApi(Code::LOGIN_ERR, '请进行登录',
                    ['imgUrl' => Yii::$app->params['imageUrl']]));
                exit();
            }
            $this->userId = $userId;
            $this->staffId = $staffId;
            $user = User::find()->where(['id'=>$this->userId,'isValid'=>User::IS_VALID_OK])->one();
            if(!empty($user)){
                Yii::$app->user->setIdentity($user);
            }
            $this->loginUserName = $user->userName;
            $this->loginGroupId = $user->groupId;
            Yii::$app->cache->set($token, $this->tokenData, 10 * 24 * 3600);
        }
    }

    public function returnApi($code = 0, $msg = '', $data = []){
        $result = [
            'ret' => $code,
            'msg' => $msg,
            'data' => $data,
        ];
        header('Content-type: application/json');
        return $result;
        \Yii::$app->end();
    }

    public function getErrorResponse($model){
        $errors=$model->errors;
        $firstItem = reset($errors);
        return $firstItem[0];

    }

    protected function request(){
        return \Yii::$app->request;
    }

    /**
     * 得到分页信息
     * @param $count
     * @param int $pageSize
     * @param int $page
     * @return array
     */
    protected function getPageInfo($count , $pageSize = 0, $page = 1 ){
        if(empty($pageSize)){
            $pageSize = \Yii::$app->params['pageSize'];
        }
        $pageSum = ceil($count/$pageSize);
        return [
            'page' => $page,
            'pageSum' => $pageSum,
            'pageSize' => $pageSize,
            'count' => $count
        ];
    }


    /**
     * @author  ziv
     * @duty 将金额转为分为单位
     * @param float $amount
     * @return integer
     */
    public static function amountToCent($amount){
        return  intval($amount*100000);
    }

    /**
     * @author  ziv
     * @duty 将金额转为元为单位,并保留两位小数
     * @param integer $amount
     * @return float
     */
    public static function amountToYuan($amount){
        return  sprintf("%.5f",$amount/100000);
    }

    public function getDay($date) {
        $datetime_start = new \DateTime($date);
        $datetime_end = new \DateTime(date('Y-m-d'));
        $days = $datetime_start->diff($datetime_end)->days;
        return $days;
    }
}