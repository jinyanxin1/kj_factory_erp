<?php

namespace common\models\jobInfo;

/**
* Created by cqj
* User: cqj
* Date: 2020-07-07
* Time: 14:23
*/

use common\kjlib\auth\AuthCode;
use common\kjlib\auth\WXUserAuth;
use common\models\admin\AdminPowerModel;
use common\models\BaseForm;
use common\library\helper\Code;
use common\models\clientInfo\ClientInfoModel;
use common\models\jobCareerRecord\JobCareerRecordForm;
use common\models\jobCareerRecord\JobCareerRecordModel;
use common\models\jobInterviewRecord\JobInterviewRecordForm;
use common\models\jobSkill\JobSkillForm;
use common\models\jobSkill\JobSkillModel;
use common\models\report\ReportModel;
use common\models\SignupForm;
use common\models\SmsLog;
use common\models\staffInfo\StaffInfoForm;
use common\models\staffInfo\StaffInfoModel;
use common\models\supplierInfo\SupplierInfoModel;
use common\models\system\basis\BasisModel;
use common\models\User;
use common\models\user\UserApiLoginModel;
use common\models\user\UserModel;
use yii\helpers\ArrayHelper;
use yii\helpers\Json;

class JobInfoForm extends BaseForm
{
	//TODO 根据表情况新增字段变量
	public $page ;
	public $pageSize ;
	public $info ;
	public $list ;
    public $startTime ;
    public $endTime ;
    public $skillId ;

	public $jobId ;
	public $status ;
	public $clientId ;
	public $staffId ;
	public $supplierId ;
	public $creator ;
	public $createTime ;
	public $updater ;
	public $updateTime ;
	public $isValid ;
	public $name ;
	public $sex ;
	public $phone ;
	public $birthday ;
	public $education ;
	public $channelId ;
	public $remark ;
    public $age ;
    public $isLunarCalendar ;
    public $idCard ;
    public $address ;
    public $idCardReversePic ;
    public $idCardPositivePic ;

	/**
	*新增
	* @return array
	*/
	public function add() {
        $tran = \Yii::$app->db->beginTransaction();
        try {
            $model = new JobInfoModel() ;
            //TODO 具体情况判断重命名
            //TODO 具体情况赋值参数
            if (empty($this->staffId)) {
                $model->status = JobInfoModel::STATUS_PUBLIC ;
            } else {
                $model->staffId = $this->staffId ;
                $model->status = JobInfoModel::STATUS_INTERVIEW ;
            }
            $model->clientId = $this->clientId ;
            $model->supplierId = $this->supplierId ;
            $model->name = $this->name ;
            $model->sex = $this->sex ;
            $model->phone = $this->phone ;
            $model->education = $this->education ;
            $model->channelId = $this->channelId ;
            $model->remark = $this->remark ;
            $model->isLunarCalendar = $this->isLunarCalendar ;
            $model->idCard = $this->idCard ;
            $model->address = $this->address ;
            $model->idCardPositivePic = $this->idCardPositivePic ;
            $model->idCardReversePic = $this->idCardReversePic ;
            $model->birthday = $this->birthday ;
            if (empty($model->birthday)) {
                $model->age = $this->age ;
            } else {
                $model->age = 0 ;
            }
            if (!$model->save()) {
                $tran->rollBack();
                return ['code' => Code::PARAM_ERR ,'msg'=>$this->getErrorResponse($model)] ;
            }
            //新增关联技能
            $skill = new JobSkillForm();
            $skill->jobId = $model->jobId;
            $skill->basisId = $this->skillId;
            $skill->add();

            //新增登陆账号
            $signUp = new SignupForm();
            $signUp->userAccount = $this->phone;
            $signUp->userPwd = substr($this->phone,-6);
            $signUp->userName = $this->name;
            $signUp->tel = $this->phone;
            $signUp->jobId = $model->jobId;
            $signUp->userType = UserModel::JOB;
            $result = $signUp->signup();
            if ($result['code'] != 0) {
                $tran->rollBack();
                return ['code' => Code::PARAM_ERR ,'msg'=>$result['msg']] ;
            }
            $model->userId = $result['userId'];
            $model->save();

            $this->jobId = $model->jobId;

            //新增记录
            ReportModel::addJob($this->staffId);
            $tran->commit();
        }catch (\Exception $exception) {
            \Yii::info('添加失败:' . $exception->getMessage());
            $tran->rollBack();
            return ['code' => Code::PARAM_ERR ,'msg'=>$exception->getMessage()] ;
        }

		return ['code' => Code::SUCCESS ,'msg'=>'新增成功'] ;
	}

    /**
     * 新增 微信
     * @param $code
     * @param $userPwd
     * @param $checkPwd
     * @param $token
     * @return array
     */
    public function wxAdd($code,$userPwd,$checkPwd,$token) {
        //判断两次密码
        if($userPwd !== $checkPwd){
            return ['code' => Code::PARAM_ERR ,'msg'=>'两次密码不一致','data'=>[]] ;
        }
        //判断验证码
        $checkCode = SmsLog::checkCode($this->phone ,$code, $this->phone ,SmsLog::TYPE_TWO);
        if($checkCode['code'] != 0){
            return ['code' => $checkCode['code'] ,'msg'=>$checkCode['msg'],'data'=>[]] ;
        }
        $tran = \Yii::$app->db->beginTransaction();
        $data = [];
        try {
            $model = new JobInfoModel() ;
            //TODO 具体情况判断重命名
            //TODO 具体情况赋值参数
            if (empty($this->staffId)) {
                $model->status = JobInfoModel::STATUS_PUBLIC ;
            } else {
                $model->staffId = $this->staffId ;
                $model->status = JobInfoModel::STATUS_INTERVIEW ;
            }
            $model->clientId = $this->clientId ;
            $model->name = $this->name ;
            $model->sex = $this->sex ;
            $model->phone = $this->phone ;
            $model->education = $this->education ;
            $model->channelId = $this->channelId ;
            $model->idCardPositivePic = $this->idCardPositivePic ;
            $model->idCardReversePic = $this->idCardReversePic ;

            $model->birthday = $this->birthday ;
            if (empty($model->birthday)) {
                $model->age = $this->age ;
            } else {
                $model->age = 0 ;
            }
            if (!$model->save()) {
                $tran->rollBack();
                return ['code' => Code::PARAM_ERR ,'msg'=>$this->getErrorResponse($model),'data'=>[]] ;
            }

            //新增登陆账号
            $signUp = new SignupForm();
            $signUp->userAccount = $this->phone;
            $signUp->userPwd = $userPwd;
            $signUp->userName = $this->name;
            $signUp->tel = $this->phone;
            $signUp->jobId = $model->jobId;
            $signUp->userType = UserModel::JOB;
            $result = $signUp->signup();
            if ($result['code'] != 0) {
                $tran->rollBack();
                return ['code' => Code::PARAM_ERR ,'msg'=>$result['msg'],'data'=>[]] ;
            }
            $model->userId = $result['userId'];
            $model->save();

            $this->jobId = $model->jobId;

            //新增记录
            ReportModel::addJob($this->staffId);
            $tokenData = [
                'userInfo' => AuthCode::authcode($model->userId, 'ENCODE', WXUserAuth::WEIXIN_COOKIE_KEY),
                'staffId' => '',
                'jobId' => '',
                'openInfo' => ''
            ];

            //登陆
            $user = UserModel::find()
                ->select(['id as userId','checkStatus','staffId','tel as phone',
                    'jobId','groupId','userAccount','authKey','userName'])
                ->where(['id' => $model->userId])
                ->andWhere(['isValid' => UserModel::IS_VALID_OK])
                ->asArray()
                ->one();
            $menuList =  AdminPowerModel::getMenuList($user['groupId'],1);

            $tokenData['staffId'] = AuthCode::authcode($user['staffId'], 'ENCODE', WXUserAuth::WEIXIN_COOKIE_KEY);
            $tokenData['jobId'] = AuthCode::authcode($user['jobId'], 'ENCODE', WXUserAuth::WEIXIN_COOKIE_KEY);
            $key = md5($user['authKey']);
            \Yii::info('token信息：'. $token . 'msg:' . Json::encode($data));

            $data = [
                'token' => $key ,
                'menuList' =>$menuList,
                'imgUrl' => \Yii::$app->params['imageUrl'],
                'userInfo' => $user
            ];


            //判断是否直接授权微信
            if (!empty($token)) {
                $info = \Yii::$app->cache->get($token);
                if(empty($info)){
                    return ['code' => Code::LOGIN_ERR ,'msg'=>'请进行微信授权登录','data'=>[]] ;
                } else {
                    $infoData = Json::decode($info);
                    $openInfo = $infoData['openInfo'] ?? '';
                    $tokenData['openInfo'] = AuthCode::authcode($openInfo, 'DECODE', WXUserAuth::WEIXIN_COOKIE_KEY);
                    $userApi = UserApiLoginModel::getByOpenId($tokenData['openInfo']);
                    $userApi->loginUserId = $model->userId;
                    $userApi->save();
                }
            }

            \Yii::$app->cache->set($key, Json::encode($tokenData), 10 * 24 * 3600);

            $tran->commit();
        }catch (\Exception $exception) {
            \Yii::info('添加失败:' . $exception->getMessage());
            $tran->rollBack();
            return ['code' => Code::PARAM_ERR ,'msg'=>$exception->getMessage(),'data'=>[]] ;
        }

        return ['code' => Code::SUCCESS ,'msg'=>'新增成功','data'=>$data] ;
    }

	/**
	*编辑
	* @return array
	*/
	public function update() {
		$model = JobInfoModel::getById($this->jobId) ;
		if ( empty($model) ) {
			return ['code' => Code::PARAM_ERR ,'msg'=>'编号错误'] ;
		}
        $tran = \Yii::$app->db->beginTransaction();
        try {
            //判断新手机号是否被录入
            $count = User::find()
                ->where(['isValid' => User::IS_VALID_OK])
                ->andWhere(['userAccount' => $this->phone])
                ->andWhere(['!=','jobId',$model->jobId])
                ->count();
            if ($count > 0) {
                \Yii::info('添加失败:该手机号已存在');
                throw new \Exception('添加失败:该手机号已存在');
            }

            $userAccount = $model->phone;
            $staffId = $model->staffId;
            //TODO 具体情况判断重命名
            //TODO 具体情况赋值参数
//            $model->status = $this->status ;
            $model->clientId = $this->clientId ;
            $model->staffId = $this->staffId ;
            $model->supplierId = $this->supplierId ;
            $model->name = $this->name ;
            $model->sex = $this->sex ;
            $model->phone = $this->phone ;
            $model->education = $this->education ;
            $model->channelId = $this->channelId ;
            $model->remark = $this->remark ;
            $model->isLunarCalendar = $this->isLunarCalendar ;
            $model->idCard = $this->idCard ;
            $model->address = $this->address ;
            $model->idCardPositivePic = $this->idCardPositivePic ;
            $model->idCardReversePic = $this->idCardReversePic ;

            if (empty($this->birthday)) {
                $model->age = $this->age ;
            } else {
                $model->age = 0 ;
                $model->birthday = $this->birthday ;

            }

            //说明修改了招聘专员
            if ($staffId != $model->staffId) {
                if (empty($model->staffId)) {
                    //空时
                    $model->status = JobInfoModel::STATUS_PUBLIC;
                } else {
                  if ($model->status == JobInfoModel::STATUS_PUBLIC) {
                      $model->status = JobInfoModel::STATUS_INTERVIEW;
                  }
                }
            }

            if (!$model->save()) {
                $tran->rollBack();
                return ['code' => Code::PARAM_ERR ,'msg'=>$this->getErrorResponse($model)] ;
            }

            //新增关联技能
            $skill = new JobSkillForm();
            $skill->jobId = $this->jobId;
            $skill->basisId = $this->skillId;
            $skill->add();

            //同时修改登陆账号
            $user = User::findByUserAccount($userAccount);

            if (!empty($user)) {
                $user->tel = $model->phone ;
                $user->userAccount = $model->phone ;
                $user->userName = $model->name ;
                $user->save();
            }

            //判断是否存在关联的职工账号
            if (!empty($user->staffId)) {
                $staff = StaffInfoModel::getById($user->staffId);
                $staff->phone = $model->phone;
                $staff->name = $model->name;
                $staff->sex = $model->sex;
                $staff->birthday = $model->birthday;
                $staff->save();
            }
            $tran->commit();
        }catch (\Exception $exception) {
            \Yii::info('添加失败:' . $exception->getMessage());
            $tran->rollBack();
            return ['code' => Code::PARAM_ERR ,'msg'=>$exception->getMessage()] ;

        }

		return ['code' => Code::SUCCESS ,'msg'=>'编辑成功'] ;
	}

    /**
     * 入职
     * @param $param
     */
    public function entry($param){

    }

    /**
     * 离职
     * @param $param
     */
    public function leave($param){

    }

	/**
	*详情
	* @return array
	*/
	public function getInfo() {
		$this->info = JobInfoModel::getById($this->jobId) ;
		return $this->info ;
	}
    /**
     *编辑
     * @return array
     */
    public function shift() {
        $model = JobInfoModel::getById($this->jobId) ;
        if ( empty($model) ) {
            return ['code' => Code::PARAM_ERR ,'msg'=>'编号错误'] ;
        }
        if ($model->status == JobInfoModel::STATUS_PUBLIC) {
            $model->status = JobInfoModel::STATUS_INTERVIEW;
        }
        $model->staffId = $this->staffId ;
        if ( !$model->save() ) {
            return ['code' => Code::PARAM_ERR ,'msg'=>'转移失败'] ;
        }
        return ['code' => Code::SUCCESS ,'msg'=>'转移成功'] ;
    }

	/**
	*删除
	*/
	public function del() {
		if (JobInfoModel::delById($this->jobId)) {
			return ['code' => Code::SUCCESS ,'msg'=>'操作成功'] ;
		}
		return ['code' => Code::PARAM_ERR ,'msg'=>'操作失败'] ;
	}

	/**
	*批量删除
	*/
	public function delBatch() {
		JobInfoModel::delByIds($this->jobId) ;
		return ['code' => Code::SUCCESS ,'msg'=>'操作成功'] ;
	}

    /**
     * 我的人才
     */
	public function getMyJob($andWhere = []){
        $select = ['*'] ;
        $andWhere[] = ['!=','status',JobInfoModel::STATUS_PUBLIC];
//        $andWhere[] = ['staffId' => UserModel::getTypeId($this->loginUserId)];
        if (!empty($this->staffId)) {
            $andWhere[] = ['staffId' => $this->staffId];
        }
        if (!empty($this->phone)) {
            $andWhere[] = ['phone' => $this->phone];
        }
        if (!empty($this->status)) {
            $andWhere[] = ['status' => $this->status];
        }
        if ($this->sex != -1) {
            $andWhere[] = ['sex' => $this->sex];
        }
        if (!empty($this->name)) {
            $andWhere[] = ['like','name' , $this->name];
        }
        if (!empty($this->startTime)) {
            $andWhere[] = ['>=','workTime',$this->startTime];
            $andWhere[] = ['<=','workTime',$this->endTime];
        }
        if (!empty($this->jobId)) {
            $andWhere[] = ['jobId' => $this->jobId];
        }
        if (!empty($this->clientId)) {
            $andWhere[] = ['clientId' => $this->clientId];
        }

        if (!empty($this->skillId)) {
            $jobId = JobSkillModel::find()
                ->select(['jobId'])
                ->where([
                    'isValid' => JobSkillModel::IS_VALID_OK,
                    'basisId' => $this->skillId
                ])
                ->groupBy('jobId')
                ->asArray()
                ->all();
            if (empty($jobId)) {
                $this->list = [] ;
                return ['list' => $this->list , 'count' => 0] ;
            } else {
                $jobId = array_column($jobId,'jobId');
                $andWhere[] = ['jobId' => $jobId];
            }
        }

        \Yii::info('==============================where:'.Json::encode($andWhere));
        $ret = JobInfoModel::getPage($this->page, $this->pageSize, $select, $andWhere,true) ;
        $this->list = isset($ret['list']) ? $ret['list'] : [] ;
        $count = isset($ret['count']) ? $ret['count'] : [] ;
        return ['list' => $this->list , 'count' => $count] ;
    }

    /**
     * 共享人才
     */
    public function getPublic($andWhere = []){
        $select = ['*'] ;

        if ($this->sex != -1) {
            $andWhere[] = ['sex' => $this->sex];
        }
        if (!empty($this->name)) {
            $andWhere[] = ['like','name' , $this->name];
        }
        if (!empty($this->phone)) {
            $andWhere[] = ['phone' => $this->phone];
        }
        if (!empty($this->skillId)) {
            $jobId = JobSkillModel::find()
                ->select(['jobId'])
                ->where([
                    'isValid' => JobSkillModel::IS_VALID_OK,
                    'basisId' => $this->skillId
                ])
                ->groupBy('jobId')
                ->asArray()
                ->all();
            if (empty($jobId)) {
                $this->list = [] ;
                return ['list' => $this->list , 'count' => 0] ;
            } else {
                $jobId = array_column($jobId,'jobId');
                $andWhere[] = ['jobId' => $jobId];
            }
        }
        $andWhere[] = ['status' => JobInfoModel::STATUS_PUBLIC];
        $ret = JobInfoModel::getPage($this->page, $this->pageSize, $select, $andWhere,true) ;
        $this->list = isset($ret['list']) ? $ret['list'] : [] ;
        $count = isset($ret['count']) ? $ret['count'] : [] ;
        return ['list' => $this->list , 'count' => $count] ;
    }

    /**
     * @param array $select
     * @param array $andWhere
     * @return array
     */
    public function getPage($select = ['*'], $andWhere = []) {
        $ret = JobInfoModel::getPage($this->page, $this->pageSize, $select, $andWhere,true) ;
        $this->list = isset($ret['list']) ? $ret['list'] : [] ;
        $count = isset($ret['count']) ? $ret['count'] : [] ;
        return ['list' => $this->list , 'count' => $count] ;
    }
	/**
	*查询所有
	* @return array
	*/
	public function getAll($andWhere = []) {
        $select = ['*'] ;
//        $andWhere[] = ['staffId' => UserModel::getTypeId($this->loginUserId)];
        if (!empty($this->staffId)) {
            $andWhere[] = ['staffId' => $this->staffId];
        }
        if (!empty($this->phone)) {
            $andWhere[] = ['phone' => $this->phone];
        }
        if (!empty($this->status)) {
            $andWhere[] = ['status' => $this->status];
        }
        if ($this->sex != -1) {
            $andWhere[] = ['sex' => $this->sex];
        }
        if (!empty($this->name)) {
            $andWhere[] = ['like','name' , $this->name];
        }
        if (!empty($this->startTime)) {
            $andWhere[] = ['>=','workTime',$this->startTime];
            $andWhere[] = ['<=','workTime',$this->endTime];
        }
        if (!empty($this->jobId)) {
            $andWhere[] = ['jobId' => $this->jobId];
        }
        if (!empty($this->clientId)) {
            $andWhere[] = ['clientId' => $this->clientId];
        }

        if (!empty($this->skillId)) {
            $jobId = JobSkillModel::find()
                ->select(['jobId'])
                ->where([
                    'isValid' => JobSkillModel::IS_VALID_OK,
                    'basisId' => $this->skillId
                ])
                ->groupBy('jobId')
                ->asArray()
                ->all();
            if (empty($jobId)) {
                $this->list = [] ;
                return ['list' => $this->list , 'count' => 0] ;
            } else {
                $jobId = array_column($jobId,'jobId');
                $andWhere[] = ['jobId' => $jobId];
            }
        }
        \Yii::info('where:'.Json::encode($andWhere));
        $ret = JobInfoModel::getAll($select, $andWhere,true) ;
		$this->list = isset($ret['list']) ? $ret['list'] : [] ;
		return ['list' => $this->list] ;
	}

	/**
	*格式化详情数据
	* @return array
	*/
	public function formatInfo() {
		//TODO 按照需求格式化数据
		$formatData = [] ;
		if (empty($this->info)) {
            return $formatData;
        }
		$staff = StaffInfoModel::find()
            ->where(['staffId' => $this->info['staffId']])
            ->andWhere(['isValid' => JobSkillModel::IS_VALID_OK])
            ->asArray()
            ->limit(1)
            ->one();
		$channel = BasisModel::getBasicsName($this->info['channelId']);
        $skill = JobSkillModel::find()->where(['jobId' => $this->info['jobId']])->asArray()->all();
        $formatData['skillId'] = [];
        if (!empty($skill)) {
            $formatData['skillId'] = array_column($skill,'basisId');
        }


        $formatData['jobId'] = $this->info['jobId'];
        $formatData['staffId'] = $this->info['staffId'];
        $formatData['jobNumber'] = $this->info['jobNumber'];
        $formatData['staffName'] = $staff['name'] ?? '';
        $formatData['clientId'] = $this->info['clientId'];
        $formatData['supplierId'] = $this->info['supplierId'];
        $formatData['status'] = $this->info['status'];
        $formatData['name'] = $this->info['name'];
        $formatData['sex'] = $this->info['sex'];
        $formatData['phone'] = $this->info['phone'];
        $formatData['birthday'] = $this->info['birthday'];
        $formatData['education'] = $this->info['education'];
        $formatData['channelId'] = $this->info['channelId'];
        $formatData['channelName'] = $channel;
        $formatData['remark'] = $this->info['remark'];
        $formatData['isLunarCalendar'] = $this->info['isLunarCalendar'];
        $formatData['idCard'] = $this->info['idCard'];
        $formatData['age'] = $this->info['age'];
        $formatData['address'] = $this->info['address'];

        if (!empty($formatData['birthday'])) {
            $bTime = strtotime($formatData['birthday']);
            $formatData['age'] = $this->getAge($bTime,$this->info['isLunarCalendar']);
        }

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
		$jobIds = array_column($this->list,'jobId');

		$skillName = self::getSkillName($jobIds);
		$clientId = array_column($this->list,'clientId');
		$client = ClientInfoModel::find()
            ->where(['clientId' => $clientId])
            ->asArray()
            ->indexBy('clientId')
            ->all();

		foreach ( $this->list as $key => $value ) {
			$item = [] ;
			$item['jobId'] = $value['jobId'];
			$item['name'] = $value['name'];
			if (!empty($value['birthday'])) {
                $bTime = strtotime($value['birthday']);
                $item['age'] = $this->getAge($bTime,$value['isLunarCalendar']);
            } else {
                $item['age'] = $value['age'];
            }
            $item['position'] = $value['position'];
            $item['phone'] = $value['phone'];
            $item['education'] = $value['education'];
            $item['idCard'] = $value['idCard'];
            $item['status'] = $value['status'];
            $item['entryTime'] = $value['workTime'];
            $item['leaveTime'] = $value['leaveTime'];
            $item['client'] = isset($client[$value['clientId']]['name']) ? $client[$value['clientId']]['name'] : '';
            $item['statusName'] = isset(JobInfoModel::$STATUS_ENUM[$value['status']]) ?
                JobInfoModel::$STATUS_ENUM[$value['status']] : '';

            $item['educationName'] = JobInfoModel::$EDUCATION_ENUM[$value['education']] ?? '';
            $item['sex'] = isset(JobInfoModel::$SEX_ENUM[$value['sex']]) ? JobInfoModel::$SEX_ENUM[$value['sex']] : '';
			$item['skill'] = isset($skillName[$value['jobId']]) ? $skillName[$value['jobId']] : '' ;
			$formatData[] = $item ;
		}
		return $formatData ;
	}

	public function formatExport(){
        //TODO 按照需求格式化数据
        $formatData = [] ;
        if (empty($this->list)) {
            return [] ;
        }
        $clientId = array_column($this->list,'clientId');
        $client = ClientInfoModel::find()
            ->where(['clientId' => $clientId])
            ->asArray()
            ->indexBy('clientId')
            ->all();
        $staffId = array_column($this->list,'staffId');
        $staff = StaffInfoModel::find()
            ->where(['staffId' => $staffId])
            ->asArray()
            ->indexBy('staffId')
            ->all();
        foreach ( $this->list as $key => $value ) {
            $item = [] ;
            $item[0] = $value['name'];
            if (!empty($value['birthday'])) {
                $bTime = strtotime($value['birthday']);
                $item[1] = $this->getAge($bTime,$value['isLunarCalendar']);
            } else {
                $item[1] = $value['age'];
            }
            $item[2] = isset(JobInfoModel::$SEX_ENUM[$value['sex']]) ? JobInfoModel::$SEX_ENUM[$value['sex']] : '';
            $item[3] = $value['position'];
            $item[4] = $value['phone'];
            $item[5] = isset(JobInfoModel::$STATUS_ENUM[$value['status']]) ?
                JobInfoModel::$STATUS_ENUM[$value['status']] : '';
            $item[6] = isset($staff[$value['staffId']]['name']) ? $staff[$value['staffId']]['name'] : '';
            $item[7] = isset($client[$value['clientId']]['name']) ? $client[$value['clientId']]['name'] : '';
            $formatData[] = $item ;
        }
        return $formatData ;
    }

    /**
     *格式化分页数据
     * @return array
     */
    public function formatClientJobPage() {
        //TODO 按照需求格式化数据
        $formatData = [] ;
        if (empty($this->list)) {
            return [] ;
        }
        $jobIds = array_column($this->list,'jobId');

        $skillName = self::getSkillName($jobIds);

        foreach ( $this->list as $key => $value ) {
            \Yii::info('============================================');
            \Yii::info(Json::encode($value));
            \Yii::info('============================================');

            $item = [] ;
            $item['jobId'] = $value['jobId'];
            $item['name'] = $value['name'];
            if (!empty($value['birthday'])) {
                $bTime = strtotime($value['birthday']);
                $item['age'] = $this->getAge($bTime,$value['isLunarCalendar']);
            } else {
                $item['age'] = $value['age'];
            }
            $item['position'] = $value['position'];
            $item['entryTime'] = $value['workTime'];
            $item['leaveTime'] = $value['leaveTime'];
            $item['phone'] = $value['phone'];
            $item['sex'] = isset(JobInfoModel::$SEX_ENUM[$value['sex']]) ?
                JobInfoModel::$SEX_ENUM[$value['sex']] : '';
            $item['skill'] = isset($skillName[$value['jobId']]) ? $skillName[$value['jobId']] : '' ;
            $formatData[] = $item ;
        }
        return $formatData ;
    }

    /**
     * 通过求职者编号获取对应技能
     * @param $jobIds
     * @return array
     */
	public static function getSkillName($jobIds) {
        $skill = JobSkillModel::find()
            ->where(['jobId' => $jobIds])
            ->andWhere(['isValid' => JobSkillModel::IS_VALID_OK])
            ->asArray()
            ->all();

        $basisIds = array_column($skill,'basisId');
        $basisList = BasisModel::find()
            ->select(['basisId','name'])
            ->where(['basisId' => $basisIds])
            ->andWhere(['isValid' => JobSkillModel::IS_VALID_OK])
            ->indexBy('basisId')
            ->asArray()
            ->all();
        foreach ($skill as $key => $value) {
            $skill[$key]['skillName'] = isset($basisList[$value['basisId']]) ? $basisList[$value['basisId']]['name'] : '';
        }

        $skill = ArrayHelper::index($skill,NULL,'jobId');
        $skillName = [];

        foreach ($skill as $key => $value) {
            $skillName[$key] = implode(',',array_column($value,'skillName'));
        }
        return $skillName;
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
			$item = [] ;
			$formatData[] = $item ;
		}
		return $formatData ;
	}


	public function getClientJobInfo() {
        $jobInfo = self::getInfo();
        if (empty($jobInfo)) {
            return [];
        }
        $list = JobCareerRecordModel::find()
            ->where(['isValid' => JobCareerRecordModel::IS_VALID_OK ])
            ->andWhere(['jobId' => $this->jobId])
            ->asArray()
            ->all();
        $info = [
            'name' => $jobInfo->name,
            'phone' => $jobInfo->phone,
            'sex' => $jobInfo->sex,
            'age' => $jobInfo->age,
            'list' => []
        ];
        if (!empty($jobInfo->birthday)) {
            $bTime = strtotime($jobInfo->birthday);
            $info['age'] = $this->getAge($bTime,$jobInfo->isLunarCalendar);
        }
        foreach ($list as $value) {
            $item = [];
            $item['status'] = JobCareerRecordModel::$STATUS_ENUM[$value['status']] ;
            $item['time'] = $value['time'] ;
            $item['position'] = $value['position'];
            $info['list'][] = $item;
        }
        return $info;
    }
}