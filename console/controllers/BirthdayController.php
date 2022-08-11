<?php
/**
 * User: cqj
 * Date: 2020/8/31
 * Time: 11:28 上午
 */

namespace console\controllers;


use common\kjlib\Lunar;
use common\library\helper\Code;
use common\library\helper\Sms;
use common\models\jobInfo\JobInfoModel;
use yii\console\Controller;
use yii\helpers\Json;

class BirthdayController extends Controller
{
    public function actionIndex() {
        $sTime = time();
        \Yii::info("定时任务开始：发送人才-生日提醒");
        $lunar = new Lunar();
        //公立日期
        $day = date('m-d');
        //农历日期
//        $lDay = $lunar->S2L($day);
        //获取所有人才的信息
        $where = [] ;
        $where[] = [
            'like','birthday', $day,
        ];
        \Yii::info("获取所有生日的人才");
        $all = JobInfoModel::getAll(['jobId','name','phone'],$where,true,'','jobId');
        $job = $all['list'];
        \Yii::info("获取所有生日的人才");
        \Yii::info(Json::encode($job));
        \Yii::info("获取所有生日的人才");

        foreach ($job as $key =>$value) {
            $send = new Sms();
            $sign = '【诚展人力】' ;
            $jobName = isset($job[$key]['name']) ? $job[$key]['name'] : '' ;
            $msg = $send->getBirthday($jobName) ;
            $tel = $value['phone'] ;
            $sendSms = $send->sendSMS( $tel,$sign, $msg, $needstatus = 'true') ;
            if (isset($sendSms['code']) && $sendSms['code'] == Code::SUCCESS) {
                \Yii::info('人才:'.$jobName.'-手机号:'.$tel.'发送成功');
            }else{
                \Yii::info('人才:'.$jobName.'-手机号:'.$tel.'发送失败');
                \Yii::info(isset($sendSms['msg']) ? $sendSms['msg'] :'异常请查看日志');
            }
        }
        \Yii::info("定时任务结束：发送人才-生日提醒");
        \Yii::info('耗时:'.(time()-$sTime));
    }
}