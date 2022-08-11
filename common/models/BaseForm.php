<?php
/**
 * Created by PhpStorm.
 * User: zhouk
 * Date: 2019/10/26
 * Time: 11:33
 */

namespace common\models;


use common\kjlib\Lunar;
use yii\base\Model;
use \Yii;


class BaseForm extends Model
{
    const INT_MAX=2147483647;//int最大值
    
    public $groupId = 0;
    public $loginUserId = 0;

    public function init()
    {
//        $groupId = intval(Yii::$app->request->headers->get('groupId'));
//        $this->groupId = $groupId ? $groupId : (Yii::$app->user->getIsGuest() ? 0 : Yii::$app->user->identity['groupId']);
//        $this->groupId = Yii::$app->user->identity['groupId'];
        parent::init(); // TODO: Change the autogenerated stub
    }
    
    /**
     * @author  ziv
     * @duty 将金额转为分为单位
     * @param float $amount
     * @return integer
     */
    public static function amountToCent($amount){
        return intval(round(floatval($amount) * 100000));
    }
    
    /**
     * @author  ziv
     * @duty 将金额转为元为单位,并保留两位小数
     * @param integer $amount
     * @return float
     */
    public static function amountToYuan($amount){
        $float = sprintf("%.5f",$amount/100000);
        return  floatval($float);
    }

    /*
     * 将秒转化为小时，分钟
     * */
    public static function amountToHour($time)
    {
        $value = array("hours" => 0, "minutes" => 0, "seconds" => 0);
        if($time >= 3600){
            $value["hours"] = floor($time/3600);
            $time = ($time%3600);
        }
        if($time >= 60){
            $value["minutes"] = floor($time/60);
            $time = ($time%60);
        }
        $value["seconds"] = floor($time);
        return $value["hours"] ."时". $value["minutes"] ."分".$value["seconds"]."秒";
    }
    
    
    /**
     * @author  ziv
     * @duty 获取错误信息
     * @param object $model
     * @return string
     */
    public function getErrorResponse($model){
        $errors=$model->errors;
        $firstItem = current($errors);
        return $firstItem[0];
        
    }

    /**
     * 准备工作完毕 开始计算年龄函数
     * @param  $birthday 出生时间 uninx时间戳
     * @param  $time 当前时间
     **/
    function getAge($birthday,$isLunarCalendar){
        //格式化出生时间年月日
        $byear=date('Y',$birthday);
        $bmonth=date('m',$birthday);
        $bday=date('d',$birthday);
        switch ($isLunarCalendar) {
            case 0 :
                //格式化当前时间年月日
                $lunar = new Lunar();
                $sTime = $lunar->S2L(date('Y-m-d'));
                $time = strtotime($sTime);
                $tyear=date('Y',$time);
                $tmonth=date('m',$time);
                $tday=date('d',$time);
                break;
            case 1:
                //格式化当前时间年月日
                $tyear=date('Y');
                $tmonth=date('m');
                $tday=date('d');
                break;
        }

        //开始计算年龄
        $age=$tyear-$byear;
//        if($bmonth>$tmonth || $bmonth==$tmonth && $bday>$tday){
//            $age--;
//        }

         return $age;
    }


}