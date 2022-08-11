<?php
/**
 * User: pyj
 * Date: 2020/8/11
 * Time: 20:54
 * 报名列表
 */

namespace backend\actions\recruitment;


use backend\actions\BaseAction;
use common\kjlib\Lunar;
use common\library\helper\Code;
use common\models\clientInfo\ClientInfoModel;
use common\models\jobInfo\JobInfoModel;
use common\models\jobRegistra\JobRegistraModel;
use common\models\recruitment\RecruitmentModel;
use common\models\staffInfo\StaffInfoModel;

class SignupListAction extends BaseAction
{
    public function run(){
        //接收参数
        $page = intval($this->request()->post('page',1));
        $pageSize = intval($this->request()->post('pageSize',10));
        $invite = $this->request()->post('invite');
        $minTime = $this->request()->post('minTime');
        $maxTime = $this->request()->post('maxTime');

        if(!empty($minTime) || !empty($maxTime)){
            $minTime = $minTime.' 00:00:00';
            $maxTime = $maxTime.' 23:59:59';
        }

        //判断参数
        if(empty($page) || empty($pageSize)){
            return $this->returnApi(Code::PARAM_ERR,'页数和页码不能为空');
        }

        //查询模型
        $model = JobRegistraModel::find()
            ->select('registraId,jobId,recruitmentId,clientId,creator,createTime,invite')
            ->where(['isValid' => JobRegistraModel::IS_VALID_OK])
            ->andFilterWhere(['invite' => $invite])
            ->andFilterWhere(['between','createTime',$minTime,$maxTime]);
        //判断查询结果
        if(empty($model)){
            return $this->returnApi(Code::PARAM_ERR,'查询结果为空');
        }

        //分页

        $count = $model->count();
        $offset = intval(($page-1)*$pageSize);
        $list = $model->offset($offset)->limit($pageSize)->orderBy('createTime desc')->asArray()->all();

        //格式化数据
        if(!empty($list)){
            $jid = array_column($list,'jobId');
            $rid = array_column($list,'recruitmentId');
            $cid = array_column($list,'clientId');
            $sid = array_column($list,'creator');
            $job_model = JobInfoModel::find()
                ->select('jobId,name,age,phone,isLunarCalendar,birthday')
                ->where(['jobId' => $jid])
                ->indexBy('jobId')
                ->asArray()
                ->all();
            $recruitment_model = RecruitmentModel::find()
                ->select('recruitmentId,post')
                ->where(['recruitmentId' => $rid])
                ->indexBy('recruitmentId')
                ->asArray()
                ->all();
            $client_model = ClientInfoModel::find()
                ->select('clientId,name')
                ->where(['clientId' => $cid])
                ->indexBy('clientId')
                ->asArray()
                ->all();
            $staff_model = StaffInfoModel::find()
                ->select('staffId,name')
                ->where(['staffId' => $sid])
                ->indexBy('staffId')
                ->asArray()
                ->all();

            foreach ($list as $key => $value){
                $list[$key]['jobName'] = isset($job_model[$value['jobId']]['name']) ?
                    $job_model[$value['jobId']]['name'] : "";
                $list[$key]['jobAge'] = isset($job_model[$value['jobId']]['age']) ?
                    $job_model[$value['jobId']]['age'] : "";
                $list[$key]['jobPhone'] = isset($job_model[$value['jobId']]['phone']) ?
                    $job_model[$value['jobId']]['phone'] : "";
                $list[$key]['recruitmentPost'] = isset($recruitment_model[$value['recruitmentId']]['post']) ?
                    $recruitment_model[$value['recruitmentId']]['post'] : "";
                $list[$key]['clientName'] = isset($client_model[$value['clientId']]['name']) ?
                    $client_model[$value['clientId']]['name'] : "";
                $list[$key]['staffName'] = isset($staff_model[$value['creator']]['name'])?
                    $staff_model[$value['creator']]['name'] : "";
                $list[$key]['birthday'] = isset($job_model[$value['jobId']]['birthday']) ?
                    $job_model[$value['jobId']]['birthday'] : "";
                $list[$key]['isLunarCalendar'] = isset($job_model[$value['jobId']]['isLunarCalendar']) ?
                    $job_model[$value['jobId']]['isLunarCalendar'] : "";
                if (!empty($list[$key]['birthday'])) {
                    $bTime = strtotime($list[$key]['birthday']);
                    $list[$key]['jobAge'] = $this->getAge($bTime, $list[$key]['isLunarCalendar']);
                }
                $list[$key]['inviteName'] = isset(JobRegistraModel::$INVITE_ENUM[$value['invite']]) ?
                    JobRegistraModel::$INVITE_ENUM[$value['invite']]  : '';

            }
        }

        //返回结果
        return  $this->returnApi(Code::SUCCESS,'OK',
            ['list' => $list,'pageInfo' => $this->getPageInfo($count,$pageSize,$page)]);
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
        if($bmonth>$tmonth || $bmonth==$tmonth && $bday>$tday){
            $age--;
        }

        return $age;
    }
}