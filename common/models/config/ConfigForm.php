<?php

namespace common\models\config;

/**
* Created by cqj
* User: cqj
* Date: 2020-07-23
* Time: 08:44
*/
use common\models\BaseForm;
use common\library\helper\Code;

class ConfigForm extends BaseForm
{
	//TODO 根据表情况新增字段变量
	public $page ;
	public $pageSize ;
	public $info ;
	public $list ;

	public $configId ;
	public $creator ;
	public $createTime ;
	public $updater ;
	public $updateTime ;
	public $isValid ;
	public $publicDay ;
    public $contractDay ;
    public $leaveTime ;

	public static $DEFAULT = [
        'publicDay' => 0 ,
        'contractDay' => 0 ,
        'leaveTime' => 0
    ];

	/**
	*编辑
	* @return array
	*/
	public function update() {
        $model = ConfigModel::find()
            ->limit(1)
            ->one();
        if (empty($model)) {
            $model = new ConfigModel();
        }
        //TODO 具体情况判断重命名
		//TODO 具体情况赋值参数
        $model->publicDay = $this->publicDay ;
        $model->contractDay = $this->contractDay ;
        $model->leaveTime = $this->leaveTime ;
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
		$this->info = ConfigModel::find()
            ->asArray()
            ->limit(1)
            ->one();

		if (empty($this->info)) {
		    $this->info = self::$DEFAULT;
        }
        $this->publicDay = $this->info['publicDay'];
        $this->contractDay = $this->info['contractDay'];
        $this->leaveTime = $this->info['leaveTime'];
		return $this->info ;
	}

	/**
	*删除
	*/
	public function del() {
		if (ConfigModel::delById($this->configId)) {
			return ['code' => Code::SUCCESS ,'msg'=>'操作成功'] ;
		}
		return ['code' => Code::PARAM_ERR ,'msg'=>'操作失败'] ;
	}

	/**
	*批量删除
	*/
	public function delBatch() {
		ConfigModel::delByIds($this->configId) ;
		return ['code' => Code::SUCCESS ,'msg'=>'操作成功'] ;
	}

	/**
	*分页查询
	* @return array
	*/
	public function getPage() {
		$select = ['*'] ;
		$andWhere = [] ;
		$ret = ConfigModel::getPage($this->page, $this->pageSize, $select, $andWhere,true) ;
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
		$ret = ConfigModel::getAll($select, $andWhere,true) ;
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

	public function calculate($day) {
        return date('Y-m-d',time() + $day*24*60*60);
    }
}