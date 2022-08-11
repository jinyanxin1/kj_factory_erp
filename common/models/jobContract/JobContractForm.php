<?php

namespace common\models\jobContract;

/**
* Created by cqj
* User: cqj
* Date: 2020-09-10
* Time: 15:52
*/

use common\models\clientInfo\ClientInfoModel;
use common\models\config\ConfigForm;
use common\models\jobCareerRecord\JobCareerRecordModel;
use common\models\jobContract\JobContractModel;
use common\models\BaseForm;
use common\library\helper\Code;
use common\models\jobInfo\JobInfoModel;
use yii\helpers\Json;

class JobContractForm extends BaseForm
{
	//TODO 根据表情况新增字段变量
	public $page ;
	public $pageSize ;
	public $info ;
	public $list ;

	public $contractId ;
	public $jobId ;
	public $clientId ;
	public $creator ;
	public $createTime ;
	public $updater ;
	public $updateTime ;
	public $isValid ;
	public $title ;
	public $startTime ;
	public $endTime ;
	public $laborContractPic ;
    public $cedicalReportPic ;
    public $recordId ;
	public $use ;
	public function rules() {
		return [
			[['contractId','recordId','jobId','clientId','creator','createTime','updater','updateTime','isValid','title','startTime','endTime','laborContractPic','cedicalReportPic','use',],'safe']
		];
	}

	/**
	*新增
	* @return array
	*/
	public function add() {
        JobContractModel::updateAll(['use' => 0],['jobId' => $this->jobId]);
        $model = new JobContractModel() ;
		//TODO 具体情况判断重命名
		//TODO 具体情况赋值参数
		$model->jobId = $this->jobId ;
        $model->clientId = $this->clientId ;
        $model->recordId = $this->recordId ;
		$model->title = $this->title ;
		$model->startTime = $this->startTime ;
		$model->endTime = $this->endTime ;
        $model->laborContractPic = Json::encode($this->laborContractPic,true) ;
        $model->cedicalReportPic = Json::encode($this->cedicalReportPic,true);
		$model->use = 1 ;
		if ( !$model->save() ) {
			return ['code' => Code::PARAM_ERR ,'msg'=>'新增失败'] ;
		}

		$job = JobInfoModel::getById($this->jobId);
        $job->startTime = $this->startTime ;
        $job->endTime = $this->endTime ;
        $job->save();

        $record = new JobCareerRecordModel();
        $record->startTime = $this->startTime ;
        $record->endTime = $this->endTime ;
        $record->laborContractPic = Json::encode($this->laborContractPic,true) ;
        $record->cedicalReportPic = Json::encode($this->cedicalReportPic,true);
        $record->save();

		return ['code' => Code::SUCCESS ,'msg'=>'新增成功'] ;
	}

	/**
	*编辑
	* @return array
	*/
	public function update() {
		$model = JobContractModel::getById($this->contractId) ;
		if ( empty($model) ) {
			return ['code' => Code::PARAM_ERR ,'msg'=>'编号错误'] ;
		}
		//TODO 具体情况判断重命名
		//TODO 具体情况赋值参数
		$model->jobId = $this->jobId ;
		$model->clientId = $this->clientId ;
		$model->creator = $this->creator ;
		$model->createTime = $this->createTime ;
		$model->updater = $this->updater ;
		$model->updateTime = $this->updateTime ;
		$model->isValid = $this->isValid ;
		$model->title = $this->title ;
		$model->startTime = $this->startTime ;
		$model->endTime = $this->endTime ;
		$model->laborContractPic = $this->laborContractPic ;
		$model->cedicalReportPic = $this->cedicalReportPic ;
		$model->use = $this->use ;
		if ( !$model->save() ) {
			return ['code' => Code::PARAM_ERR ,'msg'=>'编辑失败'] ;
		}
		return ['code' => Code::SUCCESS ,'msg'=>'编辑成功'] ;
	}

	/**
	*详情
	* @return array
	*/
	public function getInfo() {
		$this->info = JobContractModel::getById($this->contractId) ;
		return $this->info ;
	}

	/**
	*删除
	*/
	public function del() {
		if (JobContractModel::delById($this->contractId)) {
			return ['code' => Code::SUCCESS ,'msg'=>'操作成功'] ;
		}
		return ['code' => Code::PARAM_ERR ,'msg'=>'操作失败'] ;
	}

	/**
	*批量删除
	*/
	public function delBatch() {
		JobContractModel::delByIds($this->contractId) ;
		return ['code' => Code::SUCCESS ,'msg'=>'操作成功'] ;
	}

	/**
	*分页查询
	* @param $where
	* @return array
	*/
	public function getPage($where = []) {
		$select = ['*'] ;
		$ret = JobContractModel::getPage($this->page, $this->pageSize, $select, $where,true,'createTime DESC') ;
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
		$ret = JobContractModel::getAll($select, $andWhere,true) ;
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
        //查看设置是否启动
        $config = new ConfigForm();
        $config->getInfo();
        $date = '';
        if (!empty($config->contractDay)) {
            $date = $config->calculate($config->contractDay);
        }
        $clientId = array_column($this->list,'clientId');
        $client = ClientInfoModel::find()
            ->where(['clientId' => $clientId])
            ->asArray()
            ->indexBy('clientId')
            ->all();

		foreach ( $this->list as $key => $value ) {
            $item = [] ;
            $item['upcoming'] = 0;
            if (!empty($date)
                && $value['use'] == 1
                && strtotime($value['endTime']) <= strtotime($date)) {
                $item['upcoming'] = 1;
            }
            $item['jobId'] = $value['jobId'] ;
            $item['recordId'] = $value['recordId'] ;
            $item['contractId'] = $value['contractId'] ;
            $item['clientId'] = $value['clientId'] ;
            $item['clientName'] = isset($client[$value['clientId']]['name']) ? $client[$value['clientId']]['name'] : '';
            $item['createTime'] = $value['createTime'] ;
            $item['startTime'] = $value['startTime'] ;
            $item['endTime'] = $value['endTime'] ;
            $item['title'] = $value['title'] ;
            $item['laborContractPic'] = Json::decode($value['laborContractPic']) ;
            $item['cedicalReportPic'] = Json::decode($value['cedicalReportPic']) ;

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