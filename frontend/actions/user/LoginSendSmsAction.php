<?php
/**
 *
 * User: jinyanxin
 * Date: 2020/4/24
 * Time: 12:02
 */

namespace frontend\actions\user;

use common\library\helper\Code;
use common\library\helper\Sms;
use common\library\helper\uniPush;
use common\models\SmsLog;
use common\models\user\UserModel;
use Yii;
use yii\base\Action;

class LoginSendSmsAction extends Action
{
    /*
     * 发送短信
     * */
    public function run()
    {
        $tel = Yii::$app->request->post('tel');

        if(!preg_match("/^1[34578]\d{9}$/", $tel)){
            return $this->returnApi(Code::PARAM_ERR,'手机号格式不正确');
        }


        //短信每个手机号，每分钟只能发一次
        $redisKey = 'send:sms:tel:'.$tel.SmsLog::TYPE_TWO;
        $sendTime = Yii::$app->cache->get($redisKey);
        if(!empty($sendTime)){
            if((time() - strtotime($sendTime)) < 120){
                return $this->returnApi(Code::PARAM_ERR,'短信发送过于频繁');
            }
        }

        $send = new Sms();
        //签名
        $code = mt_rand(100000,999999);//验证码
        $sign = '【诚展人力】' ;
        $msg = $send->getCode($code);
        $sendSms = $send->sendSMS( $tel,$sign, $msg, $needstatus = 'true') ;
        if( intval($sendSms['code']) === 0 ){
            //保存发短信记录
            SmsLog::saveData($code,$tel,$tel,SmsLog::TYPE_TWO);
            Yii::$app->cache->set($redisKey,date('Y-m-d H:i:s'),60);
        }
        return $this->returnApi(0,'ok');
    }

    public function returnApi($code = 0, $msg = '', $data = []){
        $result = [
            'ret' => $code,
            'msg' => $msg,
            'data' => $data,
        ];
        header('Content-type: application/json');
        return $result;
    }
}