<?php
/**
 * User: cqj
 * Date: 2020/7/7
 * Time: 4:15 下午
 * 入职
 */

namespace frontend\actions\job;


use backend\actions\BaseAction;
use common\library\helper\Code;
use common\models\jobCareerRecord\JobCareerRecordForm;
use common\models\jobInfo\JobInfoForm;

class AddEntryAction extends BaseAction
{
    public function run() {
        $model = new JobInfoForm() ;
        //TODO 具体情况接收参数
        $model->attributes = $this->request()->post() ;
        $model->clientId = $this->request()->post('clientId') ;
        $model->staffId = $this->request()->post('staffId') ;
        $model->supplierId = $this->request()->post('supplierId') ;
        $model->name = $this->request()->post('name') ;
        $model->sex = $this->request()->post('sex') ;
        $model->phone = $this->request()->post('phone') ;
        $model->birthday = $this->request()->post('birthday') ;
        $model->education = $this->request()->post('education') ;
        $model->channelId = $this->request()->post('channelId') ;
        $model->remark = $this->request()->post('remark') ;
        $model->age = intval($this->request()->post('age')) ;
        $model->address = $this->request()->post('address') ;
        $model->isLunarCalendar = $this->request()->post('isLunarCalendar') ;
        $model->idCard = $this->request()->post('idCard') ;
        $model->skillId = $this->request()->post('skillId') ;
        $model->graduatedSchool = $this->request()->post('graduatedSchool') ;
        $model->major = $this->request()->post('major') ;
        $model->graduationTime = $this->request()->post('graduationTime') ;
        $model->nation = $this->request()->post('nation') ;
        $model->accountType = $this->request()->post('accountType') ;
        $model->attributes = $this->request()->post() ;
        $ret = $model->add() ;

        if ($ret['code'] == Code::SUCCESS && !empty($this->request()->post('clientId'))) {
            $model = new JobCareerRecordForm() ;
            //TODO 具体情况接收参数
            $model->attributes = $this->request()->post() ;
            $model->jobId = $ret['jobId'] ;
            $model->staffId = $this->request()->post('staffId') ;
            $model->clientId = $this->request()->post('clientId') ;
            $model->supplierId = $this->request()->post('supplierId') ;
            $model->department = $this->request()->post('department') ;
            $model->startTime = $this->request()->post('startTime') ;
            $model->endTime = $this->request()->post('endTime') ;
            $model->idCard = $this->request()->post('idCard') ;
            $model->position = $this->request()->post('position') ;
            $model->interviewTime = $this->request()->post('interviewTime') ;
            $model->trainTime = $this->request()->post('trainTime') ;
            $model->politicalStatus = $this->request()->post('politicalStatus') ;
            $model->bank = $this->request()->post('bank') ;
            $model->bankCard = $this->request()->post('bankCard') ;
            $model->address = $this->request()->post('address') ;
            $model->emergency = $this->request()->post('emergency') ;
            $model->first = $this->request()->post('first') ;
            $model->laborContractPic = $this->request()->post('laborContractPic') ;
            $model->cedicalReportPic = $this->request()->post('cedicalReportPic') ;
            $model->socialSecurity = $this->request()->post('socialSecurity') ;
            $model->remark = $this->request()->post('entry_remark') ;
            $model->time = $this->request()->post('time') ;
            $model->idCardReversePic = $this->request()->post('idCardReversePic') ;
            $model->idCardPositivePic = $this->request()->post('idCardPositivePic');
            $model->bankReversePic = $this->request()->post('bankReversePic') ;
            $model->bankPositivePic = $this->request()->post('bankPositivePic');
            $model->jobNumber = $this->request()->post('jobNumber');
            $model->team = $this->request()->post('team');//班组
            $model->oldSocialArea = $this->request()->post('oldSocialArea');//原社保购买地
            $model->isAccumulation = $this->request()->post('isAccumulation');//是否公积金缴纳
            $model->otherBank = $this->request()->post('otherBank');//其他银行卡开户信息
            $model->userNature = $this->request()->post('userNature');//用工性质
            $model->dateOfAdmission = $this->request()->post('dateOfAdmission');//入株所日期
            $model->assignedWindPowerTime = $this->request()->post('assignedWindPowerTime');//委派风电时间
            $model->clientAddress = $this->request()->post('clientAddress');//工作所在地
            $model->skillLevel = $this->request()->post('skillLevel');//技能等级
            $model->isSoldier = $this->request()->post('isSoldier');//军人登记
            $model->entryRegistration = $this->request()->post('entryRegistration');
            $model->noCriminalPic = $this->request()->post('noCriminalPic');
            $model->photo = $this->request()->post('photo');
            $model->deployDate = $this->request()->post('deployDate');
            $model->attributes = $this->request()->post() ;
            $ret = $model->entry() ;
            return $this->returnApi($ret['code'], $ret['msg']) ;

        } else {
            return $this->returnApi($ret['code'], $ret['msg']) ;
        }
    }
}