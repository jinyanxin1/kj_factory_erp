<?php

namespace common\models\supplierRecord;

/**
* Created by cqj
* User: cqj
* Date: 2020-07-16
* Time: 10:20
*/

use common\library\helper\Sms;
use common\models\BaseForm;
use common\library\helper\Code;
use common\models\clientInfo\ClientInfoModel;
use common\models\supplierInfo\SupplierInfoModel;

class SupplierRecordForm extends BaseForm
{
	//TODO 根据表情况新增字段变量
	public $page ;
	public $pageSize ;
	public $info ;
	public $list ;

	public $recordId ;
	public $supplierId ;
	public $phone ;
	public $staffId ;
    public $clientId ;
    public $count ;
    public $position ;

    /**
	*新增
	* @return array
	*/
	public function add() {
	    $supplier = SupplierInfoModel::getById($this->supplierId);
	    if (empty($supplier)) {
            return ['code' => Code::PARAM_ERR ,'msg'=>'供应商编号错误'] ;
        }

	    $client = ClientInfoModel::getById($this->clientId);
        if (empty($client)) {
            return ['code' => Code::PARAM_ERR ,'msg'=>'客户编号错误'] ;
        }



        $send = new Sms();
        $sign = '【诚展人力】' ;
        $msg = $send->getRecord($supplier->name,$client->name,$this->count,$this->position) ;
        $tel = $this->phone ;
        $sendSms = $send->sendSMS( $tel,$sign, $msg, $needstatus = 'true') ;
        if( intval($sendSms['code']) === 0 ){
            $model = new SupplierRecordModel() ;
            //TODO 具体情况判断重命名
            //TODO 具体情况赋值参数
            $model->supplierId = $this->supplierId ;
            $model->phone = $this->phone ;
            $model->staffId = $this->staffId ;
            $model->clientId = $this->clientId ;
            $model->count = $this->count ;
            $model->position = $this->position ;

            if ( !$model->save() ) {
                return ['code' => Code::PARAM_ERR ,'msg'=>'新增失败'] ;
            }
        } else {
            return ['code' => Code::PARAM_ERR ,'msg'=>$sendSms['errorMsg']] ;
        }
        return ['code' => Code::SUCCESS ,'msg'=>'新增成功'] ;
	}

	/**
	*编辑
	* @return array
	*/
	public function update() {
		$model = SupplierRecordModel::getById($this->recordId) ;
		if ( empty($model) ) {
			return ['code' => Code::PARAM_ERR ,'msg'=>'编号错误'] ;
		}
		//TODO 具体情况判断重命名
		//TODO 具体情况赋值参数
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
		if (!empty($this->supplierId)) {
			$model->supplierId = $this->supplierId ;
		}
		if (!empty($this->phone)) {
			$model->phone = $this->phone ;
		}
		if (!empty($this->content)) {
			$model->content = $this->content ;
		}
		if (!empty($this->staffId)) {
			$model->staffId = $this->staffId ;
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
		$this->info = SupplierRecordModel::getById($this->recordId) ;
		return $this->info ;
	}

	/**
	*删除
	*/
	public function del() {
		if (SupplierRecordModel::delById($this->recordId)) {
			return ['code' => Code::SUCCESS ,'msg'=>'操作成功'] ;
		}
		return ['code' => Code::PARAM_ERR ,'msg'=>'操作失败'] ;
	}

	/**
	*批量删除
	*/
	public function delBatch() {
		SupplierRecordModel::delByIds($this->recordId) ;
		return ['code' => Code::SUCCESS ,'msg'=>'操作成功'] ;
	}

	/**
	*分页查询
	* @return array
	*/
	public function getPage() {
		$select = ['*'] ;
		$andWhere = [] ;
		$ret = SupplierRecordModel::getPage($this->page, $this->pageSize, $select, $andWhere,true) ;
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
		$ret = SupplierRecordModel::getAll($select, $andWhere,true) ;
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