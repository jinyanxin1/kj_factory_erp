<?php

namespace frontend\actions\staffInfo;

/**
* Created by cqj
* User: cqj
* Date: 2020-07-07
* Time: 14:22
* 新增
*/
use common\models\staffInfo\StaffInfoForm;
use common\library\helper\Code;
use frontend\actions\WxAction;

class AddAction extends WxAction
{
	public function run() {
		$model = new StaffInfoForm() ;
		//TODO 具体情况接收参数
		$model->attributes = $this->request()->post() ;
		$model->groupId = $this->request()->post('groupId',0) ;
		$model->jobNumber = $this->request()->post('jobNumber') ;
		$model->phone = $this->request()->post('phone') ;
		$model->sectionId = $this->request()->post('sectionId') ;
		$model->positionId = $this->request()->post('positionId') ;
		$model->entryTime = $this->request()->post('entryTime') ;
		$model->seniority = $this->request()->post('seniority') ;
		$model->probation = $this->request()->post('probation') ;
		$model->startTime = $this->request()->post('startTime') ;
		$model->endTime = $this->request()->post('endTime') ;
		$model->trainTime = $this->request()->post('trainTime') ;
		$model->idName = $this->request()->post('idName') ;
		$model->idCard = $this->request()->post('idCard') ;
		$model->birthday = $this->request()->post('birthday') ;
		$model->isLunarCalendar = $this->request()->post('isLunarCalendar') ;
		$model->nation = $this->request()->post('nation') ;
		$model->maritalStatus = $this->request()->post('maritalStatus') ;
		$model->address = $this->request()->post('address') ;
		$model->politicalStatus = $this->request()->post('politicalStatus') ;
		$model->socialSecurityAccount = $this->request()->post('socialSecurityAccount') ;
		$model->providentFundAccount = $this->request()->post('providentFundAccount') ;
		$model->first = $this->request()->post('first') ;
		$model->commercialInsurance = $this->request()->post('commercialInsurance') ;
		$model->bank = $this->request()->post('bank') ;
		$model->bankCard = $this->request()->post('bankCard') ;
		$model->education = $this->request()->post('education') ;
		$model->profession = $this->request()->post('profession') ;
		$model->finishSchool = $this->request()->post('finishSchool') ;
		$model->finishTime = $this->request()->post('finishTime') ;
		$model->personName = $this->request()->post('personName') ;
		$model->personType = $this->request()->post('personType') ;
		$model->personTell = $this->request()->post('personTell') ;
		$model->idCardPositivePic = $this->request()->post('idCardPositivePic') ;
		$model->idCardReversePic = $this->request()->post('idCardReversePic') ;
		$model->educationPic = $this->request()->post('educationPic') ;
		$model->academicDegreePic = $this->request()->post('academicDegreePic') ;
		$model->Referrer = $this->request()->post('Referrer') ;
		$model->channelId = $this->request()->post('channelId') ;
        $model->remark = $this->request()->post('remark') ;
        $model->sex = $this->request()->post('sex') ;
        $model->name = $this->request()->post('name') ;
        $model->socialSecurity = $this->request()->post('socialSecurity') ;

        $model->attributes = $this->request()->post() ;
		$ret = $model->add() ;
		return $this->returnApi($ret['code'], $ret['msg']) ;
	}
}