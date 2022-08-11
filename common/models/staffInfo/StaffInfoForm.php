<?php

namespace common\models\staffInfo;

/**
* Created by cqj
* User: cqj
* Date: 2020-07-07
* Time: 14:22
*/

use common\models\adminGroup\AdminGroupBackend;
use common\models\adminGroup\AdminGroupModel;
use common\models\BaseForm;
use common\library\helper\Code;
use common\models\BaseModel;
use common\models\clientInfo\ClientInfoModel;
use common\models\jobInfo\JobInfoModel;
use common\models\SignupForm;
use common\models\staffPosition\StaffPositionModel;
use common\models\supplierInfo\SupplierInfoModel;
use common\models\system\section\SectionModel;
use common\models\User;
use common\models\user\UserModel;
use common\models\workRecord\WorkRecordModel;
use Faker\Provider\Base;
use yii\helpers\Json;

class StaffInfoForm extends BaseForm
{
	//TODO 根据表情况新增字段变量
	public $page ;
	public $pageSize ;
	public $info ;
	public $list ;

	public $staffId ;
	public $creator ;
	public $createTime ;
	public $updater ;
	public $updateTime ;
	public $isValid ;
	public $jobNumber ;
	public $phone ;
	public $sectionId ;
	public $positionId ;
	public $entryTime ;
	public $seniority ;
	public $probation ;
	public $startTime ;
	public $endTime ;
	public $trainTime ;
	public $idName ;
	public $idCard ;
	public $birthday ;
	public $isLunarCalendar ;
	public $nation ;
	public $maritalStatus ;
	public $address ;
	public $politicalStatus ;
	public $socialSecurityAccount ;
	public $providentFundAccount ;
	public $first ;
	public $commercialInsurance ;
	public $bank ;
	public $bankCard ;
	public $education ;
	public $profession ;
	public $finishSchool ;
	public $finishTime ;
	public $personName ;
	public $personType ;
	public $personTell ;
	public $idCardPositivePic ;
	public $idCardReversePic ;
	public $educationPic ;
	public $academicDegreePic ;
	public $Referrer ;
	public $channelId ;
    public $remark ;
    public $status ;
    public $sex ;
    public $name ;
    public $socialSecurity;
    public $wages;//工价
	/**
	*新增
	* @return array
	*/
	public function add() {
        $tran = \Yii::$app->db->beginTransaction();
        try {
            $model = new StaffInfoModel() ;
            //TODO 具体情况判断重命名
            //TODO 具体情况赋值参数
            $model->jobNumber = $this->jobNumber ;
            $model->phone = $this->phone ;
            $model->sectionId = $this->sectionId ;
            $model->positionId = $this->positionId ;
            $model->entryTime = $this->entryTime ;
            $model->seniority = $this->seniority ;
            $model->probation = $this->probation ;
            $model->startTime = $this->startTime ;
            $model->endTime = $this->endTime ;
            $model->trainTime = $this->trainTime ;
            $model->idName = $this->idName ;
            $model->idCard = $this->idCard ;
            $model->birthday = $this->birthday ;
            $model->isLunarCalendar = $this->isLunarCalendar ;
            $model->nation = $this->nation ;
            $model->maritalStatus = $this->maritalStatus ;
            $model->address = $this->address ;
            $model->politicalStatus = $this->politicalStatus ;
            $model->socialSecurityAccount = $this->socialSecurityAccount ;
            $model->providentFundAccount = $this->providentFundAccount ;
            $model->first = $this->first ;
            $model->commercialInsurance = $this->commercialInsurance ;
            $model->bank = $this->bank ;
            $model->bankCard = $this->bankCard ;
            $model->education = $this->education ;
            $model->profession = $this->profession ;
            $model->finishSchool = $this->finishSchool ;
            $model->finishTime = $this->finishTime ;
            $model->personName = $this->personName ;
            $model->personType = $this->personType ;
            $model->personTell = $this->personTell ;
            $model->idCardPositivePic = Json::encode($this->idCardPositivePic) ;
            $model->idCardReversePic = Json::encode($this->idCardReversePic) ;
            $model->educationPic = Json::encode($this->educationPic) ;
            $model->academicDegreePic = Json::encode($this->academicDegreePic) ;
            $model->socialSecurity = Json::encode($this->socialSecurity) ;
            $model->Referrer = $this->Referrer ;
            $model->channelId = $this->channelId ;
            $model->remark = $this->remark ;
            $model->sex = $this->sex ;
            $model->name = $this->name ;
            //工价
            $model->wages = BaseModel::amountToCent($this->wages);
            $model->status = StaffInfoModel::STATUS_ENTRY ;
            if ( !$model->save() ) {
                $tran->rollBack();
                return ['code' => Code::PARAM_ERR ,'msg'=>$this->getErrorResponse($model)] ;
            }
            //新建登陆用户
            $signUp = new SignupForm();
            $signUp->userAccount = $this->phone;
            $signUp->userPwd = substr($this->phone,-6);
            $signUp->userName = $this->name;
            $signUp->tel = $this->phone;
            $signUp->staffId = $model->staffId;
            $signUp->groupId = $model->positionId;
            $signUp->userType = UserModel::STAFF;
            $result = $signUp->signup();
            if ($result['code'] != 0) {
                $tran->rollBack();
                return ['code' => Code::PARAM_ERR ,'msg'=>$result['msg']] ;
            }
            $model->userId = $result['userId'];
            $model->save();

            $tran->commit();
        }catch (\Exception $exception) {
            $tran->rollBack();
            return ['code' => Code::PARAM_ERR ,'msg'=>$exception->getMessage()] ;
        }

		return ['code' => Code::SUCCESS ,'msg'=>'新增成功'] ;
	}

	/**
	*编辑
	* @return array
	*/
	public function update() {
		$model = StaffInfoModel::getById($this->staffId) ;
		if ( empty($model) ) {
			return ['code' => Code::PARAM_ERR ,'msg'=>'编号错误'] ;
		}
        $tran = \Yii::$app->db->beginTransaction();
        try {

            //判断新手机号是否被录入
            $count = User::find()
                ->where(['isValid' => User::IS_VALID_OK,'userAccount' => $this->phone])
                ->andWhere(['!=','staffId',$model->staffId])
                ->count();
            if ($count > 0) {
                \Yii::info('添加失败:该手机号已存在');
                throw new \Exception('添加失败:该手机号已存在');

            }

            $userAccount = $model->phone ;
            $model->jobNumber = $this->jobNumber ;
            $model->phone = $this->phone ;
            $model->sectionId = $this->sectionId ;
            $model->positionId = $this->positionId ;
            $model->entryTime = $this->entryTime ;
            $model->seniority = $this->seniority ;
            $model->probation = $this->probation ;
            $model->startTime = $this->startTime ;
            $model->endTime = $this->endTime ;
            $model->trainTime = $this->trainTime ;
            $model->idName = $this->idName ;
            $model->idCard = $this->idCard ;
            $model->birthday = $this->birthday ;
            $model->isLunarCalendar = $this->isLunarCalendar ;
            $model->nation = $this->nation ;
            $model->maritalStatus = $this->maritalStatus ;
            $model->address = $this->address ;
            $model->politicalStatus = $this->politicalStatus ;
            $model->socialSecurityAccount = $this->socialSecurityAccount ;
            $model->providentFundAccount = $this->providentFundAccount ;
            $model->first = $this->first ;
            $model->commercialInsurance = $this->commercialInsurance ;
            $model->bank = $this->bank ;
            $model->bankCard = $this->bankCard ;
            $model->education = $this->education ;
            $model->profession = $this->profession ;
            $model->finishSchool = $this->finishSchool ;
            $model->finishTime = $this->finishTime ;
            $model->personName = $this->personName ;
            $model->personType = $this->personType ;
            $model->personTell = $this->personTell ;
            $model->idCardPositivePic = Json::encode($this->idCardPositivePic) ;
            $model->idCardReversePic = Json::encode($this->idCardReversePic) ;
            $model->educationPic = Json::encode($this->educationPic) ;
            $model->academicDegreePic = Json::encode($this->academicDegreePic) ;
            $model->socialSecurity = Json::encode($this->socialSecurity,true) ;
            //工价
            $model->wages = BaseModel::amountToCent($this->wages);
            $model->Referrer = $this->Referrer ;
            $model->channelId = $this->channelId ;
            $model->remark = $this->remark ;
            $model->sex = $this->sex ;
            $model->name = $this->name ;
            if ( !$model->save() ) {
                $tran->rollBack();
                return ['code' => Code::PARAM_ERR ,'msg'=>$this->getErrorResponse($model)] ;
            }
            //同时修改登陆账号
            $user = User::findByUserAccount($userAccount);
            if (!empty($user)) {
                $user->userAccount = $model->phone ;
                $user->userName = $model->name ;
                $user->tel = $model->phone ;
                $user->groupId = $model->positionId ;
                $user->save();
            }
            //判断是否存在关联的人才休息
            if (!empty($user->jobId)) {
                $job = JobInfoModel::getById($user->jobId);
                $job->phone = $model->phone;
                $job->name = $model->name;
                $job->sex = $model->sex;
                $job->birthday = $model->birthday;
                $job->save();
            }
            //如果工价大于0
            if($model->wages > 0){
                $workRecord = WorkRecordModel::find()->where(
                    ["staffId"=>$this->staffId,"type"=>WorkRecordModel::TYPE_TIME,"isValid"=>WorkRecordModel::IS_VALID_OK]
                )->all();
                if(count($workRecord) > 0){
                    foreach ($workRecord as $item) {
                        if(intval($item->price) <= 0){
                            $item->price = $model->wages;
                            $item->save();
                        }
                    }
                }
            }
            $tran->commit();
        }catch (\Exception $exception) {
            $tran->rollBack();
            return ['code' => Code::PARAM_ERR ,'msg'=>$exception->getMessage()] ;
        }
		return ['code' => Code::SUCCESS ,'msg'=>'编辑成功'] ;
	}

	/**
	*详情
	* @return array
	*/
	public function getInfo() {
		$this->info = StaffInfoModel::getById($this->staffId,['*'],true) ;
		return $this->info ;
	}

	public function entry() {
        $model = StaffInfoModel::getById($this->staffId);
        if ( empty($model) ) {
            return ['code' => Code::PARAM_ERR ,'msg'=>'编号错误'] ;
        }
        $model->status = StaffInfoModel::STATUS_ENTRY;
        if ( !$model->save() ) {
            return ['code' => Code::PARAM_ERR ,'msg'=>$this->getErrorResponse($model)] ;
        }
        $user = UserModel::find()->where(['staffId' => $this->staffId])->one();
        $user->checkStatus = 0;
        $user->save();

        return ['code' => Code::SUCCESS ,'msg'=>'复职成功'] ;
    }

	/**
	*删除
	*/
	public function del() {
	    $ret = self::getRelated($this->staffId);
	    if($ret['code'] != Code::SUCCESS) {
            return $ret;
        }
	    $tran = \Yii::$app->db->beginTransaction();
	    try{
            $user = UserModel::find()->where(['staffId' => $this->staffId])->one();
            $user->staffId = 0;
            $user->save();
            $model = StaffInfoModel::find()
                ->Where([ 'staffId' => $this->staffId , 'isValid' => StaffInfoModel::IS_VALID_OK ])
                ->limit(1)
                ->one() ;
            if(!empty($model)){
                $model->isValid = StaffInfoModel::IS_VALID_NO ;
                $model->save();
            }
            $tran->commit();
        }catch (\Exception $e){
	        $tran->rollBack();
            return ['code' => Code::PARAM_ERR ,'msg'=>'操作失败'] ;
        }
        return ['code' => Code::SUCCESS ,'msg'=>'操作成功'] ;
	}

	/**
	*批量删除
	*/
	public function delBatch() {
		StaffInfoModel::delByIds($this->staffId) ;
		return ['code' => Code::SUCCESS ,'msg'=>'操作成功'] ;
	}

	/**
	*分页查询
	* @return array
	*/
	public function getPage($andWhere = []) {
		$select = ['*'] ;
		$ret = StaffInfoModel::getPage($this->page, $this->pageSize, $select, $andWhere,true) ;
		$this->list = isset($ret['list']) ? $ret['list'] : [] ;
		$count = isset($ret['count']) ? $ret['count'] : [] ;
		return ['list' => $this->list , 'count' => $count] ;
	}

	/**
	*查询所有
	* @return array
	*/
	public function getAll() {
		$select = ['*'] ;
		$andWhere = [] ;
		$ret = StaffInfoModel::getAll($select, $andWhere,true) ;
		$this->list = isset($ret['list']) ? $ret['list'] : [] ;
		return ['list' => $this->list] ;
	}

	/**
	*格式化详情数据
	* @return array
	*/
	public function formatInfo() {
		//TODO 按照需求格式化数据
		$formatData = $this->info ;
        $formatData['idCardPositivePic'] = Json::decode($this->info['idCardPositivePic']);
        $formatData['idCardReversePic'] = Json::decode($this->info['idCardReversePic']);
        $formatData['educationPic'] = Json::decode($this->info['educationPic']);
        $formatData['academicDegreePic'] = Json::decode($this->info['academicDegreePic']);
        $formatData['socialSecurity'] = Json::decode($this->info['socialSecurity']);
        $formatData['sectionId'] = SectionModel::getSectionId($formatData['sectionId']);
        $position = AdminGroupBackend::getInfo($formatData['positionId']);
        $formatData['positionName'] = $position->groupName ?? '';
        $formatData['positionId'] = AdminGroupBackend::getPositionId($formatData['positionId']);
        $formatData['wages'] = BaseModel::amountToYuan($this->info['wages']);
		return $formatData ;
	}


	/**
	*格式化分页数据
	* @return array
	*/
	public function formatPage() {
		//TODO 按照需求格式化数据
		$formatData = [] ;
		if (empty($this->list)) {
			return [] ;
		}
        $sectionIds = array_column($this->list,'sectionId');
        $positionIds = array_column($this->list,'positionId');

        $sectionList = SectionModel::find()->where(['sectionId' => $sectionIds])
            ->indexBy('sectionId')
            ->asArray()
            ->all();
        $positionList = AdminGroupModel::find()->where(['groupId' => $positionIds])
            ->indexBy('groupId')
            ->asArray()
            ->all();

		foreach ( $this->list as $key => $value ) {
			$item = [] ;
            $item['staffId'] = $value['staffId'];
            $item['name'] = $value['name'];
            $item['phone'] = $value['phone'];
            $item['sex'] = $value['sex'];
            $item['sexName'] = isset(StaffInfoModel::$SEX_ENUM[$value['sex']]) ?
                StaffInfoModel::$SEX_ENUM[$value['sex']] : '';
            $item['status'] = $value['status'];
            $item['statusName'] = isset(StaffInfoModel::$STATUS_ENUM[$value['status']]) ?
                StaffInfoModel::$STATUS_ENUM[$value['status']] : '';

            $item['sectionId'] = $value['sectionId'];
            $item['sectionName'] = isset($sectionList[$value['sectionId']]) ?
                $sectionList[$value['sectionId']]['name'] : '';
            $item['entryTime'] = $value['entryTime'];
            $item['positionId'] = $value['positionId'];
            $item['positionName'] = isset($positionList[$value['positionId']]) ?
                $positionList[$value['positionId']]['groupName'] : '';

            $formatData[] = $item ;
		}
		return $formatData ;
	}


	/*
	 * 职工导出格式化
	 * */
	public function formatExport()
    {
        $formatData = [] ;
        if (empty($this->list)) {
            return [] ;
        }
        foreach ( $this->list as $key => $value ) {
            //   '员工姓名','手机号码','身份证号','入职日期'
            $item = [] ;
            $item['name'] = $value['name'];
            $item['phone'] = $value['phone'];
            $item['idCard'] = $value['idCard'];
            $item['entryTime'] = $value['entryTime'];
            $formatData[] = $item ;
        }
        return $formatData ;
    }


	/**
	*格式化所有数据
	* @return array
	*/
	public function formatAll() {
		//TODO 按照需求格式化数据
		$formatData = [] ;
		if (empty($this->list)) {
			return [] ;
		}
		foreach ( $this->list as $key => $value ) {
            $formatData[intval($value['staffId'])] = $value['name'] ;
		}
		return $formatData ;
	}

	public function getList() {
        $staff = StaffInfoModel::find()
            ->where(['isValid' => SectionModel::IS_VALID_OK])
            ->andWhere(['status' => 0])
            ->asArray()
            ->all();

        $list = SectionModel::find()
            ->where(['isValid' => SectionModel::IS_VALID_OK])
            ->orderBy(['createTime' => SORT_ASC])
            ->asArray()
            ->all();

        return SectionModel::RecursiveTwo(0,$list,$staff) ;
    }


    public static function getRelated($staffId) {
        //判断是否存在人才关联
       /* $jobCount = JobInfoModel::find()->where(['isValid' => JobInfoModel::IS_VALID_OK,'staffId' => $staffId])->count();
        if ($jobCount > 0 ) {
            return ['code' => Code::PARAM_ERR,'msg' =>'关联人才无法操作'];
        }*/
        //判断是否存在客户关联
        $clientCount = ClientInfoModel::find()
            ->where(['isValid' => JobInfoModel::IS_VALID_OK,'staffId' => $staffId])->count();
        if ($clientCount > 0 ) {
            return ['code' => Code::PARAM_ERR,'msg' =>'关联客户无法操作'];
        }
        //判断是否存在供应商关联
        /*$supplierCount = SupplierInfoModel::find()
            ->where(['isValid' => JobInfoModel::IS_VALID_OK,'staffId' => $staffId])->count();
        if ($supplierCount > 0 ) {
            return ['code' => Code::PARAM_ERR,'msg' =>'关联供应商无法操作'];
        }*/
        return ['code' => Code::SUCCESS,'msg' =>'ok'];
    }
}