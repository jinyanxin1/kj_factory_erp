<?php

namespace common\models\staffContract;

/**
* Created by cqj
* User: cqj
* Date: 2020-07-07
* Time: 14:22
*/
use common\models\staffContract\StaffContractModel;
use common\models\BaseForm;
use common\library\helper\Code;
use common\models\staffInfo\StaffInfoModel;
use yii\helpers\Json;

class StaffContractForm extends BaseForm
{
	//TODO 根据表情况新增字段变量
	public $page ;
	public $pageSize ;
	public $info ;
	public $list ;

	public $contractId ;
	public $staffId ;
	public $creator ;
	public $createTime ;
	public $updater ;
	public $updateTime ;
	public $isValid ;
	public $title ;
	public $startTime ;
	public $endTime ;
	public $laborContractPic ;
	public $competitionAgreementPic ;
	public $confidentialityContract ;
	/**
	*新增
	* @return array
	*/
	public function add() {
		$model = new StaffContractModel() ;
		//TODO 具体情况判断重命名
		//TODO 具体情况赋值参数
        $model->staffId = $this->staffId ;
        $model->title = $this->title ;
        $model->startTime = $this->startTime ;
        $model->endTime = $this->endTime ;
        $model->laborContractPic = Json::encode($this->laborContractPic);
        $model->competitionAgreementPic = Json::encode($this->competitionAgreementPic);
        $model->confidentialityContract = Json::encode($this->confidentialityContract);

        //覆盖新的合同
        $staff = StaffInfoModel::getById($this->staffId);
        $staff->startTime = $this->startTime ;
        $staff->endTime = $this->endTime ;
        $staff->save();
		if ( !$model->save() ) {
			return ['code' => Code::PARAM_ERR ,'msg'=>'新增失败'] ;
		}
		return ['code' => Code::SUCCESS ,'msg'=>'新增成功'] ;
	}

	/**
	*编辑
	* @return array
	*/
	public function update() {
		$model = StaffContractModel::getById($this->contractId) ;
		if ( empty($model) ) {
			return ['code' => Code::PARAM_ERR ,'msg'=>'编号错误'] ;
		}
		//TODO 具体情况判断重命名
		//TODO 具体情况赋值参数
        $model->staffId = $this->staffId ;
        $model->title = $this->title ;
        $model->startTime = $this->startTime ;
        $model->endTime = $this->endTime ;
        $model->laborContractPic = Json::encode($this->laborContractPic);
        $model->competitionAgreementPic = Json::encode($this->competitionAgreementPic);
        $model->confidentialityContract = Json::encode($this->confidentialityContract);
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
		$this->info = StaffContractModel::getById($this->contractId) ;
		return $this->info ;
	}

	/**
	*删除
	*/
	public function del() {
		if (StaffContractModel::delById($this->contractId)) {
			return ['code' => Code::SUCCESS ,'msg'=>'操作成功'] ;
		}
		return ['code' => Code::PARAM_ERR ,'msg'=>'操作失败'] ;
	}

	/**
	*批量删除
	*/
	public function delBatch() {
		StaffContractModel::delByIds($this->contractId) ;
		return ['code' => Code::SUCCESS ,'msg'=>'操作成功'] ;
	}

	/**
	*分页查询
	* @return array
	*/
	public function getPage($andWhere = []) {
		$select = ['*'] ;
		$ret = StaffContractModel::getPage($this->page, $this->pageSize, $select, $andWhere,true) ;
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
		$ret = StaffContractModel::getAll($select, $andWhere,true) ;
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
        $formatData['title'] = $this->info['title'];
        $formatData['startTime'] = $this->info['startTime'];
        $formatData['endTime'] = $this->info['endTime'];
        $formatData['createTime'] = $this->info['createTime'];
        $formatData['laborContractPic'] = Json::decode($this->info['laborContractPic']);
        $formatData['competitionAgreementPic'] = Json::decode($this->info['competitionAgreementPic']);
        $formatData['confidentialityContract'] = Json::decode($this->info['confidentialityContract']);
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
		foreach ( $this->list as $key => $value ) {
			$item = [] ;
            $item['contractId'] = $value['contractId'];
            $item['title'] = $value['title'];
            $item['startTime'] = $value['startTime'];
            $item['endTime'] = $value['endTime'];
            $item['createTime'] = $value['createTime'];
            $item['laborContractPic'] = Json::decode($value['laborContractPic']);
            $item['competitionAgreementPic'] = Json::decode($value['competitionAgreementPic']);
            $item['confidentialityContract'] = Json::decode($value['confidentialityContract']);
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