<?php

namespace common\models\clientPerson;

/**
* Created by cqj
* User: cqj
* Date: 2020-07-10
* Time: 09:48
*/

use common\models\clientInfo\ClientInfoModel;
use common\models\clientPerson\ClientPersonModel;
use common\models\BaseForm;
use common\library\helper\Code;

class ClientPersonForm extends BaseForm
{
	//TODO 根据表情况新增字段变量
	public $page ;
	public $pageSize ;
	public $info ;
	public $list ;

	public $personId ;
	public $clientId ;
	public $tell ;
	public $phone ;
	public $name ;
	public $department ;
	public $position ;
	public $remark ;
	public $email ;
	public $weixin ;
	public $qq ;
	/**
	*新增
	* @return array
	*/
	public function add() {
		$model = new ClientPersonModel() ;
		//TODO 具体情况判断重命名
		//TODO 具体情况赋值参数
        $model->clientId = $this->clientId ;
        $model->tell = $this->tell ;
        $model->phone = $this->phone ;
        $model->name = $this->name ;
        $model->department = $this->department ;
        $model->position = $this->position ;
        $model->remark = $this->remark ;
        $model->email = $this->email ;
        $model->weixin = $this->weixin ;
        $model->qq = $this->qq ;
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
		$model = ClientPersonModel::getById($this->personId) ;
		if ( empty($model) ) {
			return ['code' => Code::PARAM_ERR ,'msg'=>'编号错误'] ;
		}
		//TODO 具体情况判断重命名
		//TODO 具体情况赋值参数
        $model->clientId = $this->clientId ;
        $model->tell = $this->tell ;
        $model->phone = $this->phone ;
        $model->name = $this->name ;
        $model->department = $this->department ;
        $model->position = $this->position ;
        $model->remark = $this->remark ;
        $model->email = $this->email ;
        $model->weixin = $this->weixin ;
        $model->qq = $this->qq ;
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
		$this->info = ClientPersonModel::getById($this->personId,['*'],true) ;
		return $this->info ;
	}

	/**
	*删除
	*/
	public function del() {
		if (ClientPersonModel::delById($this->personId)) {
			return ['code' => Code::SUCCESS ,'msg'=>'操作成功'] ;
		}
		return ['code' => Code::PARAM_ERR ,'msg'=>'操作失败'] ;
	}

	/**
	*批量删除
	*/
	public function delBatch() {
		ClientPersonModel::delByIds($this->personId) ;
		return ['code' => Code::SUCCESS ,'msg'=>'操作成功'] ;
	}

	/**
	*分页查询
	* @return array
	*/
	public function getPage($andWhere = []) {
		$select = ['*'] ;
		$ret = ClientPersonModel::getPage($this->page, $this->pageSize, $select, $andWhere,true) ;
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
		if (!empty($this->clientId)) {
            $andWhere[] = [
              'clientId'=> $this->clientId
            ];
        }
        if (!empty($this->name)) {
            $andWhere[] = [
                'like','name',$this->name
            ];
        }
		$ret = ClientPersonModel::getAll($select, $andWhere,true) ;
		$this->list = isset($ret['list']) ? $ret['list'] : [] ;
		return ['list' => $this->list] ;
	}

	/**
	*格式化详情数据
	* @return array
	*/
	public function formatInfo() {
		//TODO 按照需求格式化数据
        $client = ClientInfoModel::find()
            ->where(['clientId' => $this->info['clientId']])
            ->asArray()
            ->one();
        $formatData = $this->info ;
        $formatData['clientName'] = $client['name'] ?? '' ;
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
		$clientId = array_column($this->list,'clientId');
		$clientList = ClientInfoModel::find()
            ->where(['clientId' => $clientId])
            ->asArray()
            ->indexBy('clientId')
            ->all();
		foreach ( $this->list as $key => $value ) {
			$item = [] ;
            $item['personId'] = $value['personId'];
            $item['name'] = $value['name'];
            $item['phone'] = $value['phone'];
            $item['email'] = $value['email'];
            $item['createTime'] = $value['createTime'];
            $item['position'] = empty($value['position']) ? '' : $value['position'];
            $item['department'] = $value['department'];
            $item['clientName'] = isset($clientList[$value['clientId']]['name'])
                ? $clientList[$value['clientId']]['name'] : '';
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
            $formatData[intval($value['personId'])] = $value['name'] ;
		}
		return $formatData ;
	}
}