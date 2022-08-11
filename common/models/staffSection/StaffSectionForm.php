<?php

namespace common\models\staffSection;

/**
* Created by cqj
* User: cqj
* Date: 2020-07-07
* Time: 14:22
*/
use common\models\staffSection\StaffSectionModel;
use common\models\BaseForm;
use common\library\helper\Code;

class StaffSectionForm extends BaseForm
{
	//TODO 根据表情况新增字段变量
	public $page ;
	public $pageSize ;
	public $info ;
	public $list ;

	public $sectionId ;
	public $parentId ;
	public $creator ;
	public $createTime ;
	public $updater ;
	public $updateTime ;
	public $isValid ;
	public $name ;
	/**
	*新增
	* @return array
	*/
	public function add() {
		$model = new StaffSectionModel() ;
		//TODO 具体情况判断重命名
		//TODO 具体情况赋值参数
		if (!empty($this->parentId)) {
			$model->parentId = $this->parentId ;
		}
		if (!empty($this->creator)) {
			$model->creator = $this->creator ;
		}
		if (!empty($this->createTime)) {
			$model->createTime = $this->createTime ;
		}
		if (!empty($this->updater)) {
			$model->updater = $this->updater ;
		}
		if (!empty($this->updateTime)) {
			$model->updateTime = $this->updateTime ;
		}
		if (!empty($this->isValid)) {
			$model->isValid = $this->isValid ;
		}
		if (!empty($this->name)) {
			$model->name = $this->name ;
		}
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
		$model = StaffSectionModel::getById($this->sectionId) ;
		if ( empty($model) ) {
			return ['code' => Code::PARAM_ERR ,'msg'=>'编号错误'] ;
		}
		//TODO 具体情况判断重命名
		//TODO 具体情况赋值参数
		if (!empty($this->parentId)) {
			$model->parentId = $this->parentId ;
		}
		if (!empty($this->creator)) {
			$model->creator = $this->creator ;
		}
		if (!empty($this->createTime)) {
			$model->createTime = $this->createTime ;
		}
		if (!empty($this->updater)) {
			$model->updater = $this->updater ;
		}
		if (!empty($this->updateTime)) {
			$model->updateTime = $this->updateTime ;
		}
		if (!empty($this->isValid)) {
			$model->isValid = $this->isValid ;
		}
		if (!empty($this->name)) {
			$model->name = $this->name ;
		}
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
		$this->info = StaffSectionModel::getById($this->sectionId) ;
		return $this->info ;
	}

	/**
	*删除
	*/
	public function del() {
		if (StaffSectionModel::delById($this->sectionId)) {
			return ['code' => Code::SUCCESS ,'msg'=>'操作成功'] ;
		}
		return ['code' => Code::PARAM_ERR ,'msg'=>'操作失败'] ;
	}

	/**
	*批量删除
	*/
	public function delBatch() {
		StaffSectionModel::delByIds($this->sectionId) ;
		return ['code' => Code::SUCCESS ,'msg'=>'操作成功'] ;
	}

	/**
	*分页查询
	* @return array
	*/
	public function getPage() {
		$select = ['*'] ;
		$andWhere = [] ;
		$ret = StaffSectionModel::getPage($this->page, $this->pageSize, $select, $andWhere,true) ;
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
		$ret = StaffSectionModel::getAll($select, $andWhere,true) ;
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
		foreach ( $this->list as $key => $value ) {
			$item = [] ;
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