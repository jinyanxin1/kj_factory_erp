<?php
/**
 *
 * User: jinyanxin
 * Date: 2020/4/24
 * Time: 11:21
 * 短信记录表
 */

namespace common\models;


use common\library\helper\Code;

class SmsLog extends BaseModel
{
    const IS_CHECK = 1;//已验证
    const NO_CHECK = 0;//未验证

    public static function tableName()
    {
        return 'kj_sms_log';
    }
    const TYPE_ONE = 1;
    const TYPE_TWO = 2;

    /*
     * 保存发送短信记录
     * */
    public static function saveData($code,$tel,$userAccount,$type)
    {
        $info = new self();
        $info->tel = $tel;
        $info->code = $code;
        $info->type = $type;
        $info->creator = $userAccount;
        $info->updater = $userAccount;
        if(!$info->save()){
            return false;
        }
        return true;
    }

    /*
     * 短信验证码验证
     * */
    public static function checkCode($tel,$code,$userAccount,$type)
    {
        $nowTime = date('Y-m-d H:i:s');
        $info = self::find()
            ->where(['tel'=>$tel,'code'=>$code,
                'isCheck'=>self::NO_CHECK,'isValid'=>self::IS_VALID_OK,
                'type' =>$type
            ])
            ->one();
        if(empty($info)){
            return ['code'=>Code::PARAM_ERR,'msg'=>'验证码未找到'];
        }
        //验证码有效时间3分钟
        $timeCha = strtotime($nowTime) - strtotime($info->createTime);
        if($timeCha > 120){
            return ['code'=>Code::PARAM_ERR,'msg'=>'验证码失效'];
        }

        $info->isCheck = self::IS_CHECK;
        $info->checkTime = date('Y-m-d H:i:s');
        $info->updater = $userAccount;
        if(!$info->save()){
            return ['code'=>100,'msg'=>'验证失败'];
        }
        return ['code'=>0,'msg'=>'验证成功'];
    }

}