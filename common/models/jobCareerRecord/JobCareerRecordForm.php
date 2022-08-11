<?php

namespace common\models\jobCareerRecord;

/**
* Created by cqj
* User: cqj
* Date: 2020-07-07
* Time: 14:23
*/
use common\models\BaseForm;
use common\library\helper\Code;
use common\models\clientContract\ClientContractModel;
use common\models\clientInfo\ClientInfoModel;
use common\models\config\ConfigForm;
use common\models\jobContract\JobContractModel;
use common\models\jobInfo\JobInfoForm;
use common\models\jobInfo\JobInfoModel;
use common\models\jobSocialSecurity\JobSocialSecurityModel;
use common\models\report\ReportModel;
use common\models\system\basis\BasisModel;
use yii\helpers\Json;

class JobCareerRecordForm extends BaseForm
{
	//TODO 根据表情况新增字段变量
	public $page ;
	public $pageSize ;
	public $info ;
	public $list ;

	public $recordId ;
	public $status ;
	public $jobId ;
	public $staffId ;
	public $clientId ;
	public $supplierId ;
	public $creator ;
	public $createTime ;
	public $updater ;
	public $updateTime ;
	public $isValid ;
	public $department ;
	public $startTime ;
	public $endTime ;
	public $idCard ;
	public $position ;
	public $interviewTime ;
	public $trainTime ;
	public $politicalStatus ;
	public $bank ;
	public $bankCard ;
	public $address ;
	public $emergencyContact ;
	public $emergencyTell ;
	public $first ;
	public $laborContractPic ;
	public $cedicalReportPic ;
	public $time ;
	public $leaveReason ;
    public $leavePic ;
    public $leaveType ;
    public $socialSecurity ;
    public $remark ;
    public $emergency ;
    public $idCardReversePic ;
    public $idCardPositivePic ;
    public $bankReversePic;
    public $bankPositivePic;
    public $jobNumber;
	/**
	*入职
	* @return array
	*/
	public function entry() {
        $tran = \Yii::$app->db->beginTransaction();
        try {
            //修改到入职状态
            $job = JobInfoModel::getById($this->jobId);
            if($job->status == JobInfoModel::STATUS_ENTRY) {
                return ['code' => Code::PARAM_ERR ,'msg'=>'该人才已入职无法操作'] ;
            }
            if (empty($this->time)) {
                return ['code' => Code::PARAM_ERR ,'msg'=>'请选择入职时间'] ;
            }

            //添加入职记录
            $model = new JobCareerRecordModel() ;
            $model->staffId = $job->staffId ;
            $model->supplierId = $job->supplierId ;

            $model->status = JobCareerRecordModel::STATUS_ENTRY ;
            $model->jobId = $this->jobId ;
            $model->clientId = $this->clientId ;
            $model->department = $this->department ;
            $model->startTime = $this->startTime ;
            $model->endTime = $this->endTime ;
            $model->idCard = $this->idCard ;
            $model->position = $this->position ;
            $model->interviewTime = $this->interviewTime ;
            $model->trainTime = $this->trainTime ;
            $model->politicalStatus = $this->politicalStatus ;
            $model->bank = $this->bank ;
            $model->bankCard = $this->bankCard ;
            $model->address = $this->address ;
            $model->emergency = Json::encode($this->emergency,true) ;
//            $model->emergencyContact = $this->emergencyContact ;
//            $model->emergencyTell = $this->emergencyTell ;
            $model->first = $this->first ;
            $model->laborContractPic = Json::encode($this->laborContractPic,true) ;
            $model->cedicalReportPic = Json::encode($this->cedicalReportPic,true);
            $model->time = $this->time ;
            $model->remark = $this->remark ;
            $model->socialSecurity = Json::encode($this->socialSecurity,true) ;
            $model->idCardPositivePic = $this->idCardPositivePic ;
            $model->idCardReversePic = $this->idCardReversePic ;
            $model->bankPositivePic = $this->bankPositivePic ;
            $model->bankReversePic = $this->bankReversePic ;
            $model->jobNumber = $this->jobNumber ;

            if (!$model->save()) {
                $tran->rollBack();
                return ['code' => Code::PARAM_ERR ,'msg'=>$this->getErrorResponse($model)] ;
            }

            //新增记录

            $job->status = JobInfoModel::STATUS_ENTRY;
            $job->clientId = $this->clientId ;
            $job->position = $this->position ;
            $job->startTime = $this->startTime ;
            $job->endTime = $this->endTime ;
            $job->entryId = $model->recordId;
            $job->workTime = $this->time ;
            $job->jobNumber = $this->jobNumber ;

            $job->save();


            ReportModel::addEntry($job->staffId);
            //添加人才入职合同
            JobContractModel::updateAll(['use' => 0],['jobId' => $job->jobId]);

            $jobContract = new JobContractModel();
            $jobContract->startTime = $this->startTime ;
            $jobContract->endTime = $this->endTime ;
            $jobContract->clientId = $this->clientId ;
            $jobContract->recordId = $model->recordId ;
            $jobContract->jobId = $job->jobId ;
            $jobContract->title = '初次入职合同' ;
            $jobContract->laborContractPic = $model->laborContractPic ;
            $jobContract->cedicalReportPic = $model->cedicalReportPic ;
            $jobContract->use = 1 ;
            $jobContract->save();
            $tran->commit();
        }catch (\Exception $exception) {
            \Yii::info('添加失败:' . $exception->getMessage());
            $tran->rollBack();
            return ['code' => Code::PARAM_ERR ,'msg'=>$exception->getMessage()] ;
        }

		return ['code' => Code::SUCCESS ,'msg'=>'新增成功'] ;
	}

    /**
     *离职
     * @return array
     */
    public function leave() {
        $tran = \Yii::$app->db->beginTransaction();
        try {
            //修改到离职状态
            $job = JobInfoModel::getById($this->jobId);
            if ($job->status == JobInfoModel::STATUS_LEAVE) {
                return ['code' => Code::PARAM_ERR ,'msg'=>'该人才未入职无法操作'] ;
            }

            if (empty($this->time)) {
                return ['code' => Code::PARAM_ERR ,'msg'=>'请选择离职时间'] ;
            }

            $clientId = $job->clientId;
            $job->status = JobInfoModel::STATUS_LEAVE;
            $job->clientId = 0 ;
            $job->position = '' ;
            $job->jobNumber = '' ;
            $job->save();
            //添加离职记录
            $model = new JobCareerRecordModel() ;
            $model->status = JobCareerRecordModel::STATUS_LEAVE;
            $model->staffId = $job->staffId ;
            $model->clientId = $clientId ;
            $model->supplierId = $job->supplierId ;

            $model->jobId = $this->jobId ;
            $model->time = $this->time ;
            $model->leaveType = $this->leaveType ;
            $model->leaveReason = $this->leaveReason ;
            $model->leavePic = Json::encode($this->leavePic,true) ;
            $model->save();

            $job->leaveId = $model->recordId;
            $job->leaveTime = date('Y-m-d H:i:s');
            $job->save();

            //合同全不生效
            JobContractModel::updateAll(['use' => 0],['jobId' => $job->jobId]);

            $tran->commit();
        }catch (\Exception $exception) {
            \Yii::info('添加失败:' . $exception->getMessage());
            $tran->rollBack();
            return ['code' => Code::PARAM_ERR ,'msg'=>'离职失败'] ;
        }

        return ['code' => Code::SUCCESS ,'msg'=>'新增成功'] ;
    }

    /**
     *获取最新到离职信息
     * @return array
     */
    public function getLeave() {
        $this->info = JobCareerRecordModel::find()
            ->where(['status'=> JobCareerRecordModel::STATUS_LEAVE])
            ->andWhere(['isValid' => JobCareerRecordModel::IS_VALID_OK])
            ->andWhere(['jobId' => $this->jobId])
            ->orderBy('time')
            ->asArray()
            ->limit(1)
            ->one();
        return $this->info ;
    }
    /**
     *获取最新到入职信息
     * @return array
     */
    public function getEntry() {
        $this->info = JobCareerRecordModel::find()
            ->where(['status'=> JobCareerRecordModel::STATUS_ENTRY])
            ->andWhere(['isValid' => JobCareerRecordModel::IS_VALID_OK])
            ->andWhere(['jobId' => $this->jobId])
            ->orderBy('time')
            ->asArray()
            ->limit(1)
            ->one();
        return $this->info ;
    }
	/**
	*详情
	* @return array
	*/
	public function getInfo() {
		$this->info = JobCareerRecordModel::getById($this->recordId) ;
		return $this->info ;
	}

	/**
	*删除
	*/
	public function del() {
		if (JobCareerRecordModel::delById($this->recordId)) {
			return ['code' => Code::SUCCESS ,'msg'=>'操作成功'] ;
		}
		return ['code' => Code::PARAM_ERR ,'msg'=>'操作失败'] ;
	}

	/**
	*批量删除
	*/
	public function delBatch() {
		JobCareerRecordModel::delByIds($this->recordId) ;
		return ['code' => Code::SUCCESS ,'msg'=>'操作成功'] ;
	}
    public function getEntryList($andWhere = []) {
        $select = ['*'] ;
//        $andWhere[] = ['status' => JobCareerRecordModel::STATUS_ENTRY];
        $andWhere[] = ['jobId' => $this->jobId];
        $ret = JobCareerRecordModel::getPage($this->page, $this->pageSize, $select, $andWhere,true) ;
        $this->list = isset($ret['list']) ? $ret['list'] : [] ;
        $count = isset($ret['count']) ? $ret['count'] : [] ;
        return ['list' => $this->list , 'count' => $count] ;
    }

    public function getLeaveList($andWhere = []) {
        $select = ['*'] ;
        $andWhere[] = ['status' => JobCareerRecordModel::STATUS_LEAVE];
        $andWhere[] = ['jobId' => $this->jobId];
        $ret = JobCareerRecordModel::getPage($this->page, $this->pageSize, $select, $andWhere,true) ;
        $this->list = isset($ret['list']) ? $ret['list'] : [] ;
        $count = isset($ret['count']) ? $ret['count'] : [] ;
        return ['list' => $this->list , 'count' => $count] ;
    }


    /**
     * @param array $andWhere
     * @return array
     * 分页查询
     */
	public function getPage($andWhere = []) {
		$select = ['*'] ;
		$ret = JobCareerRecordModel::getPage($this->page, $this->pageSize, $select, $andWhere,true) ;
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
		$ret = JobCareerRecordModel::getAll($select, $andWhere,true) ;
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
            return [] ;
        }
        switch ($this->info['status']) {
            case JobCareerRecordModel::STATUS_ENTRY:
                $formatData = $this->formatEntry();
                break;
            case JobCareerRecordModel::STATUS_LEAVE:
                $formatData = $this->formatLeave();
                break;
        }
		return $formatData ;
	}

    /**
     *
     * @param unknown $date1 为结束日期  例 2018-12
     * @param unknown $date2 为开始日期  例 2017-11
     * @param string $tags 日期间隔符号
     * @return
     */
    protected  function getMonthNum( $date1, $date2, $tags='-' ){
        $date1 = explode($tags,$date1);
        $date2 = explode($tags,$date2);
        return abs($date1[0] - $date2[0]) * 12 - $date2[1] + abs($date1[1]);
    }

	public function formatEntry() {
        $client = ClientInfoModel::getById($this->info['clientId'],['*'],true);


        $item = [];
        $item['recordId'] = $this->info['recordId'];
        $item['clientId'] = $this->info['clientId'];
        $item['clientName'] = isset($client['name']) ? $client['name'] : '';
        $item['department'] = $this->info['department'];
        $item['time'] = $this->info['time'];
        $item['seniority'] = $this->getMonthNum(date("Y-m-d",time()),$item['time']);
        $item['position'] = $this->info['position'];
        $item['startTime'] = $this->info['startTime'];
        $item['endTime'] = $this->info['endTime'];
        $item['idCard'] = $this->info['idCard'];
        $item['trainTime'] = $this->info['trainTime'];
        $item['interviewTime'] = $this->info['interviewTime'];
        $item['politicalStatus'] = $this->info['politicalStatus'];
        $item['politicalStatusName'] = isset(JobInfoModel::$POLITICAL_ENUM[$this->info['politicalStatus']]) ?
            JobInfoModel::$POLITICAL_ENUM[$this->info['politicalStatus']] : '';
        $item['bank'] = $this->info['bank'];
        $item['bankCard'] = $this->info['bankCard'];
        $item['address'] = $this->info['address'];
//        $item['emergencyContact'] = $this->info['emergencyContact'];
//        $item['emergencyTell'] = $this->info['emergencyTell'];
        $item['first'] = $this->info['first'];
        $item['firstName'] = isset(JobInfoModel::$FIRST_ENUM[$this->info['first']]) ?
            JobInfoModel::$FIRST_ENUM[$this->info['first']] : '';
        $item['remark'] = $this->info['remark'];
        $item['idCardReversePic'] = $this->info['idCardReversePic'];
        $item['idCardPositivePic'] = $this->info['idCardPositivePic'];
        $item['bankReversePic'] = $this->info['bankReversePic'];
        $item['bankPositivePic'] = $this->info['bankPositivePic'];
        $item['jobNumber'] = $this->info['jobNumber'];
        $item['emergency'] = Json::decode($this->info['emergency']);
        $item['laborContractPic'] = Json::decode($this->info['laborContractPic']);
        $item['cedicalReportPic'] = Json::decode($this->info['cedicalReportPic']);
        $item['socialSecurity'] = Json::decode($this->info['socialSecurity']);

        $socialSecurity = BasisModel::find()->select(['basisId','name'])->where([
            'isValid' => JobCareerRecordModel::IS_VALID_OK,
            'basisId' => $item['socialSecurity']
        ])
            ->asArray()
            ->all();
        $item['socialSecurityName'] = array_column($socialSecurity,'name');
        return $item;
    }


    public function formatLeave() {
        $item = [];
        $item['recordId'] = $this->info['recordId'];
        $item['time'] = $this->info['time'];
        $item['leaveReason'] = $this->info['leaveReason'];
        $item['leavePic'] = Json::decode($this->info['leavePic']);
        $item['leaveType'] = $this->info['leaveType'];
        $item['leaveTypeName'] = isset(JobCareerRecordModel::$LEAVE_TYPE_ENUM[$this->info['leaveType']]) ?
            JobCareerRecordModel::$LEAVE_TYPE_ENUM[$this->info['leaveType']] : '';
	    return $item;
    }




	/**
	*格式化分页数据
	* @return array
	*/
	public function formatEntryPage() {
		//TODO 按照需求格式化数据
		$formatData = [] ;
		if (empty($this->list)) {
			return [] ;
		}
		$clientIds = array_column($this->list,'clientId');
		$clientList = ClientInfoModel::find()
            ->where(['clientId' => $clientIds])
            ->asArray()
            ->indexBy('clientId')
            ->all();



		foreach ( $this->list as $key => $value ) {
			$item = [] ;
			$item['recordId'] = $value['recordId'] ;
			$item['client'] = isset($clientList[$value['clientId']]) ?
                $clientList[$value['clientId']]['name'] : '';
            $item['position'] = $value['position'] ;
            $item['time'] = $value['time'] ;
            $item['clientId'] = $value['clientId'] ;
            $item['status'] = $value['status'] ;
            $item['statusName'] = isset(JobCareerRecordModel::$STATUS_ENUM[$value['status']]) ?
                JobCareerRecordModel::$STATUS_ENUM[$value['status']] : '';


			$formatData[] = $item ;
		}
		return $formatData ;
	}


    /**
     *格式化分页数据
     * @return array
     */
    public function formatJobPage() {
        //TODO 按照需求格式化数据
        $formatData = [] ;
        if (empty($this->list)) {
            return [] ;
        }
        $jobIds = array_column($this->list,'jobId');
        $jobList = JobInfoModel::find()
            ->where(['jobId' => $jobIds])
            ->asArray()
            ->indexBy('jobId')
            ->all();
        foreach ( $this->list as $key => $value ) {
            $item = [] ;
            $item['recordId'] = $value['recordId'] ;
            $item['status'] = $value['status'] ;
            $item['statusName'] = JobCareerRecordModel::$STATUS_ENUM[$value['status']] ;
            $item['jobId'] = $value['jobId'] ;
            $item['jobName'] = isset($jobList[$value['jobId']]) ?
                $jobList[$value['jobId']]['name'] : '' ;
            $item['sex'] = isset($jobList[$value['jobId']]) ?
                $jobList[$value['jobId']]['sex'] : '' ;
            $item['position'] = $value['position'] ;
            $formatData[] = $item ;
        }
        return $formatData ;
    }

    /**
     *格式化分页数据
     * @return array
     */
    public function formatLeavePage() {
        //TODO 按照需求格式化数据
        $formatData = [] ;
        if (empty($this->list)) {
            return [] ;
        }
        $clientIds = array_column($this->list,'clientId');
        $clientList = ClientInfoModel::find()
            ->where(['clientId' => $clientIds])
            ->asArray()
            ->indexBy('clientId')
            ->all();
        foreach ( $this->list as $key => $value ) {
            $item = [] ;
            $item['recordId'] = $value['recordId'] ;
            $item['client'] = isset($clientList[$value['clientId']]) ?
                $clientList[$value['clientId']]['name'] : '';
            $item['time'] = $value['time'] ;
            $item['leaveReason'] = $value['leaveReason'];
            $item['leaveType'] = $value['leaveType'];
            $item['leaveTypeName'] = isset(JobCareerRecordModel::$LEAVE_TYPE_ENUM[$value['leaveType']]) ?
                JobCareerRecordModel::$LEAVE_TYPE_ENUM[$value['leaveType']] : '';
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
			$item = [] ;
			$formatData[] = $item ;
		}
		return $formatData ;
	}
}