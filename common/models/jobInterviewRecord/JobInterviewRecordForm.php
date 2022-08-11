<?php

namespace common\models\jobInterviewRecord;

/**
* Created by cqj
* User: cqj
* Date: 2020-07-07
* Time: 14:23
*/

use common\library\helper\Sms;
use common\models\BaseForm;
use common\library\helper\Code;
use common\models\clientInfo\ClientInfoModel;
use common\models\jobInfo\JobInfoForm;
use common\models\jobInfo\JobInfoModel;
use common\models\jobRegistra\JobRegistraModel;
use common\models\report\ReportModel;
use yii\helpers\Json;

class JobInterviewRecordForm extends BaseForm
{
	//TODO 根据表情况新增字段变量
	public $page ;
	public $pageSize ;
	public $info ;
    public $list ;
    public $registraId ;

	public $interviewId ;
	public $status ;
	public $jobId ;
	public $clientId ;
	public $staffId ;
	public $creator ;
	public $createTime ;
	public $updater ;
	public $updateTime ;
	public $isValid ;
	public $position ;
	public $time ;
	public $skill ;
	public $remark ;
	public $address ;
	public $education ;
	public $name ;
	public $phone ;
	public $sex ;
	/**
	*新增
	* @return array
	*/
	public function add() {
        $job = JobInfoModel::getById($this->jobId);

        $model = new JobInterviewRecordModel() ;
        $model->status = JobInterviewRecordModel::STATUS_ING ;
        $model->jobId = $this->jobId ;
        $model->clientId = $this->clientId ;
        $model->staffId = $this->staffId ;
        $model->position = $this->position ;
        $model->time = $this->time ;
        $model->skill = $this->skill ;
        $model->remark = $this->remark ;
        $model->address = $this->address ;
        $model->education = $job->education ;
        $model->name = $job->name ;
        $model->phone = $job->phone ;
        $model->sex = $job->sex ;

		if ( !$model->save() ) {
			return ['code' => Code::PARAM_ERR ,'msg'=>'新增失败'] ;
		}
        $job = JobInfoModel::getById($this->jobId);
		if ($job->status == JobInfoModel::STATUS_PUBLIC || $job->status == JobInfoModel::STATUS_LEAVE ) {
            $job->status = JobInfoModel::STATUS_INTERVIEW;
            $job->staffId = $this->staffId;
            $job->save();
        }
        if (!empty($this->registraId)) {
            $registra = JobRegistraModel::find()->where(['registraId' => $this->registraId])->one();
            $registra->invite = 2;
            $registra->save();
        }
        ReportModel::addInterview($this->staffId);
		return ['code' => Code::SUCCESS ,'msg'=>'新增成功'] ;
	}

    /**
     *新增
     * @return array
     */
    public function adds() {
        $tran = \Yii::$app->db->beginTransaction();

        try {
            $jobs = JobInfoModel::find()
                ->where(['jobId' => $this->jobId])
                ->asArray()
                ->indexBy('jobId')
                ->all();
            foreach ($this->jobId as $value) {
                $model = new JobInterviewRecordModel() ;
                $model->status = JobInterviewRecordModel::STATUS_ING ;
                $model->jobId = $value ;
                $model->clientId = $this->clientId ;
                $model->staffId = $this->staffId ;
                $model->position = $this->position ;
                $model->time = $this->time ;
                $model->skill = $this->skill ;
                $model->remark = $this->remark ;
                $model->address = $this->address ;
                $model->name = isset($jobs[$value]['name']) ? $jobs[$value]['name'] : '';
                $model->education = isset($jobs[$value]['education']) ? $jobs[$value]['education'] : '';
                $model->phone = isset($jobs[$value]['phone']) ? $jobs[$value]['phone'] : '';
                $model->sex = isset($jobs[$value]['sex']) ? $jobs[$value]['sex'] : '';
                $model->save();
                $job = JobInfoModel::getById($value);
                if ($job->status == JobInfoModel::STATUS_PUBLIC || $job->status == JobInfoModel::STATUS_LEAVE ) {
                    $job->status = JobInfoModel::STATUS_INTERVIEW;
                    $job->staffId = $this->staffId ;
                    $job->save();
                }
                ReportModel::addInterview($this->staffId);
            }
            $tran->commit();
        }catch (\Exception $exception) {
            \Yii::info('添加失败:' . $exception->getMessage());
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
		$model = JobInterviewRecordModel::getById($this->interviewId) ;
		if ( empty($model) ) {
			return ['code' => Code::PARAM_ERR ,'msg'=>'编号错误'] ;
		}
		//TODO 具体情况判断重命名
		//TODO 具体情况赋值参数
        $model->jobId = $this->jobId ;
        $model->clientId = $this->clientId ;
        $model->staffId = $this->staffId ;
        $model->position = $this->position ;
        $model->time = $this->time ;
        $model->skill = $this->skill ;
        $model->remark = $this->remark ;
        $model->address = $this->address ;
        $model->education = $this->education ;
        $model->name = $this->name ;
        $model->phone = $this->phone ;
        $model->sex = $this->sex ;
		if ( !$model->save() ) {
			return ['code' => Code::PARAM_ERR ,'msg'=>'编辑失败'] ;
		}
		return ['code' => Code::SUCCESS ,'msg'=>'编辑成功'] ;
	}

    public function result() {
        $tran = \Yii::$app->db->beginTransaction();
        try {
            $interview = JobInterviewRecordModel::find()
                ->where(['interviewId' => $this->interviewId])
                ->all();
            $clientIds = [];
            $jobIds = [];
            foreach ($interview as $value) {
                $clientIds[] = $value->clientId;
                $jobIds[] = $value->jobId;
            }
            $clientList = ClientInfoModel::find()
                ->where(['clientId' => $clientIds])
                ->asArray()
                ->indexBy('clientId')
                ->all();
            $jobList = JobInfoModel::find()
                ->where(['jobId' => $jobIds])
                ->asArray()
                ->indexBy('jobId')
                ->all();
            foreach ($interview as $model) {
                $model->status = $this->status ;
                if ( !$model->save() ) {
                    return ['code' => Code::PARAM_ERR ,'msg'=>'操作失败'] ;
                }
                if ($this->status != JobInterviewRecordModel::STATUS_NOT_INVOLVED) {
                    ReportModel::addInterviewGo($model->staffId);
                }
                if ($this->status == JobInterviewRecordModel::STATUS_PASS) {
                    //TODO 发送手机短信通知
                    $send = new Sms();
                    $sign = '【诚展人力】' ;
                    $job = isset($jobList[$model->jobId]['name']) ? $jobList[$model->jobId]['name'] : '' ;
                    $client = isset($clientList[$model->clientId]['name']) ? $clientList[$model->clientId]['name'] : '';
                    $msg = $send->getPass($job,$client,$model->position,$this->time) ;
                    $tel = $model->phone ;
                    \Yii::info('面试通知手机号:'.$tel);
                    \Yii::info('面试通知内容:'.$msg);
                    $sendSms = $send->sendSMS( $tel,$sign, $msg, $needstatus = 'true') ;
                    \Yii::info('面试通知结果:'.Json::encode($sendSms));

                }
            }
            $tran->commit();
        }catch (\Exception $exception) {
            \Yii::info('添加失败:' . $exception->getMessage());
            $tran->rollBack();
            return ['code' => Code::PARAM_ERR ,'msg'=>$exception->getMessage()] ;
        }
        return ['code' => Code::SUCCESS ,'msg'=>'操作成功'] ;
    }

	/**
	*详情
	* @return array
	*/
	public function getInfo() {
		$this->info = JobInterviewRecordModel::getById($this->interviewId,['*'],true) ;
		return $this->info ;
	}

	/**
	*删除
	*/
	public function del() {
		if (JobInterviewRecordModel::delById($this->interviewId)) {
			return ['code' => Code::SUCCESS ,'msg'=>'操作成功'] ;
		}
		return ['code' => Code::PARAM_ERR ,'msg'=>'操作失败'] ;
	}

	/**
	*批量删除
	*/
	public function delBatch() {
		JobInterviewRecordModel::delByIds($this->interviewId) ;
		return ['code' => Code::SUCCESS ,'msg'=>'操作成功'] ;
	}
    public function getJobPage($andWhere = []) {
        $select = ['*'] ;
        $ret = JobInterviewRecordModel::getPage($this->page, $this->pageSize, $select, $andWhere,true) ;
        $this->list = isset($ret['list']) ? $ret['list'] : [] ;
        $count = isset($ret['count']) ? $ret['count'] : [] ;
        return ['list' => $this->list , 'count' => $count] ;
    }
    /**
     * 分页查询
     * @param array $andWhere
     * @return array
     */
	public function getPage($andWhere = []) {
		$select = ['*'] ;
		$ret = JobInterviewRecordModel::getPage($this->page, $this->pageSize, $select, $andWhere,true) ;
		$this->list = isset($ret['list']) ? $ret['list'] : [] ;
		$count = isset($ret['count']) ? $ret['count'] : [] ;
		return ['list' => $this->list , 'count' => $count] ;
	}

    /**
     * 查询所有
     * @param array $andWhere
     * @return array
     */
	public function getAll($andWhere = []) {
		$select = ['*'] ;
		$ret = JobInterviewRecordModel::getAll($select, $andWhere,true) ;
		$this->list = isset($ret['list']) ? $ret['list'] : [] ;
		return ['list' => $this->list] ;
	}

	/**
	*格式化详情数据
	* @return array
	*/
	public function formatInfo() {
		//TODO 按照需求格式化数据
        $info = $this->info;
        $job = JobInfoModel::getById($info['jobId'],['*'],true);
        $info['jobName'] = $job['name'] ?? '';
        $info['address'] = $job['address'] ?? '';
        $info['age'] = $job['age'];

        if (!empty($job['birthday'])) {
            $bTime = strtotime($job['birthday']);
            $info['age'] = $this->getAge($bTime,$job['isLunarCalendar']);
        }
        $skillName = JobInfoForm::getSkillName($job['jobId']);

        $info['skill'] = isset($skillName[$job['jobId']]) ? $skillName[$job['jobId']] : '' ;

        $info['education'] = isset(JobInfoModel::$EDUCATION_ENUM[$job['education']]) ?
            JobInfoModel::$EDUCATION_ENUM[$job['education']] : '';
		return $info ;
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
        $clientIds = array_column($this->list,'clientId');
		$clientList = ClientInfoModel::find()
            ->where(['clientId' => $clientIds])
            ->asArray()
            ->indexBy('clientId')
            ->all();
		$jobIds = array_column($this->list,'jobId');
		$jobList = JobInfoModel::find()
            ->where(['jobId' => $jobIds])
            ->asArray()
            ->indexBy('jobId')
            ->all();
		foreach ( $this->list as $key => $value ) {
			$item = [] ;
            $item['interviewId'] = $value['interviewId'];
            $item['statusName'] = JobInterviewRecordModel::$STATUS_ENUM[$value['status']];
            $item['status'] = $value['status'];
            $item['jobStatus'] = isset($jobList[$value['jobId']['status']]) ?? 0;
            $item['isEntry'] = $item['jobStatus']== JobInfoModel::STATUS_ENTRY ? 1 : 0;
            $item['position'] = $value['position'];
            $item['time'] = $value['time'];
            $item['clientId'] = $value['clientId'];
            $item['client'] = isset($clientList[$value['clientId']]) ?
                $clientList[$value['clientId']]['name'] : '';
            $item['clientLogo'] = isset($clientList[$value['clientId']]) ?
                $clientList[$value['clientId']]['logo'] : '';
            $item['createTime'] = $value['createTime'];
            $item['jobId'] = $value['jobId'];
            $item['jobName'] = isset($jobList[$value['jobId']]) ?
                $jobList[$value['jobId']]['name'] : '';
            $item['sex'] = isset($jobList[$value['jobId']]) ?
                $jobList[$value['jobId']]['sex'] : '';
            $item['phone'] = isset($jobList[$value['jobId']]) ?
                $jobList[$value['jobId']]['phone'] : '';

            $item['age'] = isset($jobList[$value['jobId']]) ?
                $jobList[$value['jobId']]['age'] : '';
            $item['birthday'] = isset($jobList[$value['jobId']]) ?
                $jobList[$value['jobId']]['birthday'] : '';
            $item['isLunarCalendar'] = isset($jobList[$value['jobId']]) ?
                $jobList[$value['jobId']]['isLunarCalendar'] : '';
            if (!empty($item['birthday'])) {
                $bTime = strtotime($item['birthday']);
                $item['age'] = $this->getAge($bTime,$item['isLunarCalendar']);
            }
            $item['sexName'] = isset(JobInterviewRecordModel::$SEX_ENUM[$item['sex']]) ?
                JobInterviewRecordModel::$SEX_ENUM[$item['sex']] : '';
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