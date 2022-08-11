<?php

namespace common\models\clientInterviewRecord;

/**
* Created by cqj
* User: cqj
* Date: 2020-07-10
* Time: 09:48
*/
use common\models\BaseForm;
use common\library\helper\Code;
use common\models\clientInfo\ClientInfoModel;
use common\models\clientPerson\ClientPersonModel;
use common\models\staffInfo\StaffInfoModel;
use common\models\staffPosition\StaffPositionModel;
use yii\helpers\Json;

class ClientInterviewRecordForm extends BaseForm
{
	//TODO 根据表情况新增字段变量
	public $page ;
	public $pageSize ;
	public $info ;
	public $list ;

	public $recordId ;
	public $title ;
	public $time ;
	public $staffId ;
	public $clientId ;
	public $content ;
	public $pic ;
	public $start ;
	public $end ;
	public $personId ;
    public $followType ;
    public $status ;
	/**
	*新增
	* @return array
	*/
	public function add() {
        try {
            $model = new ClientInterviewRecordModel() ;
            //TODO 具体情况判断重命名
            //TODO 具体情况赋值参数
            if (empty($this->clientId)) {
                return ['code' => Code::PARAM_ERR ,'msg'=>'请选择客户'] ;
            }
            $model->title = $this->title ;
            $model->time = $this->time ;
            $model->staffId = $this->staffId ;
            $model->clientId = $this->clientId ;
            $model->content = $this->content ;
            $model->pic = Json::encode($this->pic,true) ;
            $model->start = $this->start ;
            $model->end = $this->end ;
            $model->personId = $this->personId ;
            $model->followType = $this->followType ;
            $model->status = $this->status ;
            $model->save();

            if ($model->status == ClientInterviewRecordModel::STATUS_ONE) {
                $client = ClientInfoModel::getById($model->clientId) ;
                $client->isWork = ClientInterviewRecordModel::STATUS_ONE;
                $client->save();
            }

        }catch (\Exception $exception) {
            return ['code' => Code::PARAM_ERR ,'msg'=>$exception->getMessage()] ;
        }

		return ['code' => Code::SUCCESS ,'msg'=>'新增成功'] ;
	}

	/**
	*编辑
	* @return array
	*/
	public function update() {
		$model = ClientInterviewRecordModel::getById($this->recordId) ;
		if ( empty($model) ) {
			return ['code' => Code::PARAM_ERR ,'msg'=>'编号错误'] ;
		}
		//TODO 具体情况判断重命名
		//TODO 具体情况赋值参数
        $model->recordId = $this->recordId ;
        $model->title = $this->title ;
        $model->time = $this->time ;
        $model->staffId = $this->staffId ;
        $model->clientId = $this->clientId ;
        $model->content = $this->content ;
        $model->pic = $this->pic ;
        $model->start = $this->start ;
        $model->end = $this->end ;
        $model->personId = $this->personId ;
        $model->followType = $this->followType ;
        $model->status = $this->status ;
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
		$this->info = ClientInterviewRecordModel::getById($this->recordId) ;
		return $this->info ;
	}

	/**
	*删除
	*/
	public function del() {
		if (ClientInterviewRecordModel::delById($this->recordId)) {
			return ['code' => Code::SUCCESS ,'msg'=>'操作成功'] ;
		}
		return ['code' => Code::PARAM_ERR ,'msg'=>'操作失败'] ;
	}

	/**
	*批量删除
	*/
	public function delBatch() {
		ClientInterviewRecordModel::delByIds($this->recordId) ;
		return ['code' => Code::SUCCESS ,'msg'=>'操作成功'] ;
	}

	/**
	*分页查询
	* @return array
	*/
	public function getPage($andWhere = []) {
		$select = ['*'] ;
		$ret = ClientInterviewRecordModel::getPage($this->page, $this->pageSize, $select, $andWhere,true) ;
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
		$ret = ClientInterviewRecordModel::getAll($select, $andWhere,true) ;
		$this->list = isset($ret['list']) ? $ret['list'] : [] ;
		return ['list' => $this->list] ;
	}

	/**
	*格式化详情数据
	* @return array
	*/
	public function formatInfo() {
		//TODO 按照需求格式化数据

        $person = ClientPersonModel::find()->select(['name','personId'])
            ->where([ 'personId' => $this->info['personId'] , 'isValid' => ClientPersonModel::IS_VALID_OK ])
            ->asArray()
            ->indexBy('personId')
            ->all();
        $client = ClientInfoModel::find()
            ->where(['clientId' => $this->info['clientId']])
            ->asArray()
            ->one();
        $staff = StaffInfoModel::find()
            ->where(['staffId' => $this->info['staffId']])
            ->asArray()
            ->one();
		$formatData = [] ;
        $formatData['recordId'] = $this->info['recordId'];
        $formatData['content'] = $this->info['content'];
        $formatData['createTime'] = $this->info['createTime'];
        $formatData['title'] = $this->info['title'];
        $formatData['time'] = $this->info['time'];
        $formatData['start'] = $this->info['start'];
        $formatData['end'] = $this->info['end'];
        $formatData['personId'] = $this->info['personId'];
        $formatData['followType'] = $this->info['followType'];
        $formatData['followTypeName'] = isset(ClientInterviewRecordModel::$FOLLOW_ENUM[$this->info['followType']]) ?
            ClientInterviewRecordModel::$FOLLOW_ENUM[$this->info['followType']] : '';
        $formatData['pic'] = Json::decode($this->info['pic']);
        $formatData['personName'] = isset($person[$formatData['personId']]) ? $person[$formatData['personId']]['name'] : '' ;
        $formatData['staffId'] = $this->info['staffId'];
        $formatData['staffName'] = $staff['name'] ?? '';
        $formatData['clientName'] = $client['name'] ?? '';
        $formatData['status'] = isset(ClientInterviewRecordModel::$STATUS_ENUM[$this->info['status']]) ?
            ClientInterviewRecordModel::$STATUS_ENUM[$this->info['status']] : '';
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
		$staffIds = array_column($this->list,'staffId');
		$staffList = StaffInfoModel::find()->select(['staffId','name'])
            ->where(['isValid' => StaffInfoModel::IS_VALID_OK ])
            ->andWhere(['staffId' => $staffIds])
            ->indexBy('staffId')
            ->asArray()
            ->all();
		$personIds = array_column($this->list,'personId');
        $personList = ClientPersonModel::find()->select(['name','personId'])
            ->where([ 'personId' => $personIds , 'isValid' => ClientPersonModel::IS_VALID_OK ])
            ->asArray()
            ->indexBy('personId')
            ->all();
        $clientIds = array_column($this->list,'clientId');
        $clientList = ClientInfoModel::find()->select(['clientId','name'])
            ->where(['isValid' => StaffInfoModel::IS_VALID_OK ])
            ->andWhere(['clientId' => $clientIds])
            ->indexBy('clientId')
            ->asArray()
            ->all();
		foreach ( $this->list as $key => $value ) {
			$item = [] ;
            $item['recordId'] = $value['recordId'];
            $item['staffName'] = isset($staffList[$value['staffId']]) ? $staffList[$value['staffId']]['name'] : '';
            $item['clientName'] = isset($clientList[$value['clientId']]) ? $clientList[$value['clientId']]['name'] : '';
            $item['staffId'] = $value['staffId'];
            $item['content'] = $value['content'];
            $item['title'] = $value['title'];
            $item['time'] = $value['time'];
            $item['start'] = $value['start'];
            $item['end'] = $value['end'];
            $item['createTime'] = $value['createTime'];
            $item['personName'] = isset($personList[$value['personId']]['name']) ?
                $personList[$value['personId']]['name'] : '';
            $item['followType'] = isset(ClientInterviewRecordModel::$FOLLOW_ENUM[$value['followType']]) ?
                ClientInterviewRecordModel::$FOLLOW_ENUM[$value['followType']] : '';
            $item['status'] = isset(ClientInterviewRecordModel::$STATUS_ENUM[$value['status']]) ?
                ClientInterviewRecordModel::$STATUS_ENUM[$value['status']] : '';

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