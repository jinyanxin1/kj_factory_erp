<?php

namespace common\models\clientContract;

/**
* Created by cqj
* User: cqj
* Date: 2020-07-10
* Time: 09:48
*/
use common\models\clientContract\ClientContractModel;
use common\models\BaseForm;
use common\library\helper\Code;
use common\models\config\ConfigForm;
use common\models\system\basis\BasisModel;
use yii\helpers\Json;

class ClientContractForm extends BaseForm
{
	//TODO 根据表情况新增字段变量
	public $page ;
	public $pageSize ;
	public $info ;
	public $list ;

	public $contractId ;
	public $creator ;
	public $createTime ;
	public $updater ;
	public $updateTime ;
	public $isValid ;
	public $title ;
	public $startTime ;
	public $endTime ;
	public $pic ;
	public $clientId ;
    public $staffId ;
    public $basisId ;
    public $time ;
	/**
	*新增
	* @return array
	*/
	public function add() {
        ClientContractModel::updateAll(['use' => ClientContractModel::USE_NO],
            ['clientId' => $this->clientId,'basisId'=> $this->basisId]);

        $model = new ClientContractModel() ;
        $model->title = $this->title ;
        $model->time = $this->time ;
        $model->startTime = $this->startTime ;
        $model->endTime = $this->endTime ;
        $model->pic = Json::encode($this->pic,true) ;
        $model->clientId = $this->clientId ;
        $model->staffId = $this->staffId ;
        $model->basisId = $this->basisId ;
        $model->use = ClientContractModel::USE_YES ;

		if ( !$model->save() ) {
			return ['code' => Code::PARAM_ERR ,'msg'=>$this->getErrorResponse($model)] ;
		}
		return ['code' => Code::SUCCESS ,'msg'=>'新增成功'] ;
	}

	/**
	*编辑
	* @return array
	*/
	public function update() {
		$model = ClientContractModel::getById($this->contractId) ;
		if ( empty($model) ) {
			return ['code' => Code::PARAM_ERR ,'msg'=>'编号错误'] ;
		}
        $model->contractId = $this->contractId ;
        $model->title = $this->title ;
        $model->startTime = $this->startTime ;
        $model->endTime = $this->endTime ;
        $model->pic = $this->pic ;
        $model->time = $this->time ;
        $model->clientId = $this->clientId ;
        $model->staffId = $this->staffId ;
        $model->basisId = $this->basisId ;

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
		$this->info = ClientContractModel::getById($this->contractId,['*'],true) ;
		return $this->info ;
	}

	/**
	*删除
	*/
	public function del() {
		if (ClientContractModel::delById($this->contractId)) {
			return ['code' => Code::SUCCESS ,'msg'=>'操作成功'] ;
		}
		return ['code' => Code::PARAM_ERR ,'msg'=>'操作失败'] ;
	}

	/**
	*批量删除
	*/
	public function delBatch() {
		ClientContractModel::delByIds($this->contractId) ;
		return ['code' => Code::SUCCESS ,'msg'=>'操作成功'] ;
	}

	/**
	*分页查询
	* @return array
	*/
	public function getPage($andWhere = []) {
		$select = ['*'] ;
		$ret = ClientContractModel::getPage($this->page, $this->pageSize, $select, $andWhere,true) ;
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
		$ret = ClientContractModel::getAll($select, $andWhere,true) ;
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
        $formatData['basisName'] = BasisModel::getBasicsName($this->info['basisId']);
		$formatData['pic'] = Json::decode($this->info['pic']);
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
		$basisId = array_column($this->list,'basisId');
		$basisList = BasisModel::find()->where(['basisId' => $basisId])
            ->asArray()
            ->indexBy('basisId')
            ->all();
        //查看设置是否启动
        $config = new ConfigForm();
        $config->getInfo();
        $date = '';
        if (!empty($config->contractDay)) {
            $date = $config->calculate($config->contractDay);
        }
        //获取预警日期

		foreach ( $this->list as $key => $value ) {
            $item = [] ;
            $item['contractId'] = $value['contractId'] ;
            $item['title'] = $value['title'] ;
            $item['startTime'] = $value['startTime'] ;
            $item['endTime'] = $value['endTime'] ;
            $item['pic'] = Json::decode($value['pic']);
            $item['clientId'] = $value['clientId'] ;
            $item['staffId'] = $value['staffId'] ;
            $item['createTime'] = $value['createTime'] ;
            $item['time'] = $value['time'] ;
            $item['basisId'] = $value['basisId'] ;
            $item['basisName'] = isset($basisList[$value['basisId']]) ?
                $basisList[$value['basisId']]['name'] : '';
            $item['upcoming'] = 0;
            if (!empty($date)
                && $value['use'] == ClientContractModel::USE_YES
                && strtotime($value['endTime']) <= strtotime($date)) {
                $item['upcoming'] = 1;
            }
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