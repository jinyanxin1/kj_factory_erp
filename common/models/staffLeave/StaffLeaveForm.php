<?php

namespace common\models\staffLeave;

/**
* Created by cqj
* User: cqj
* Date: 2020-07-07
* Time: 14:22
*/

use common\models\clientInfo\ClientInfoModel;
use common\models\jobInfo\JobInfoModel;
use common\models\staffInfo\StaffInfoForm;
use common\models\staffInfo\StaffInfoModel;
use common\models\staffLeave\StaffLeaveModel;
use common\models\BaseForm;
use common\library\helper\Code;
use common\models\supplierInfo\SupplierInfoModel;
use common\models\user\UserModel;
use yii\helpers\Json;

class StaffLeaveForm extends BaseForm
{
	//TODO 根据表情况新增字段变量
	public $page ;
	public $pageSize ;
	public $info ;
	public $list ;

	public $leaveId ;
	public $staffId ;
	public $creator ;
	public $createTime ;
	public $updater ;
	public $updateTime ;
	public $isValid ;
	public $time ;
	public $leaveReason ;
    public $leavePic ;
    public $leaveType ;
	/**
	*新增
	* @return array
	*/
	public function add() {
        $ret = StaffInfoForm::getRelated($this->staffId);
        if($ret['code'] != Code::SUCCESS) {
            return $ret;
        }

        $tran = \Yii::$app->db->beginTransaction();
        try {
            $model = new StaffLeaveModel() ;
            //TODO 具体情况判断重命名
            //TODO 具体情况赋值参数
            $model->staffId = $this->staffId ;
            $model->time = $this->time ;
            $model->leaveReason = $this->leaveReason ;
            $model->leaveType = $this->leaveType ;
            $model->leavePic = Json::encode($this->leavePic) ;
            $model->save();
            //修改员工资料为离职
            $staff = StaffInfoModel::getById($this->staffId);
            $staff->status = StaffInfoModel::STATUS_LEAVE ;
            $staff->save();

            $user = UserModel::find()->where(['staffId' => $this->staffId])->one();
            $user->checkStatus = 1;
            $user->save();

            $tran->commit();
        }catch (\Exception $exception) {
            $tran->rollBack();
            return ['code' => Code::PARAM_ERR ,'msg'=>$exception->getMessage()] ;
        }

		return ['code' => Code::SUCCESS ,'msg'=>'新增成功'] ;
	}


	/**
	*详情
	* @return array
	*/
	public function getInfo() {
		$this->info = StaffLeaveModel::getById($this->leaveId) ;
		return $this->info ;
	}

	/**
	*删除
	*/
	public function del() {
		if (StaffLeaveModel::delById($this->leaveId)) {
			return ['code' => Code::SUCCESS ,'msg'=>'操作成功'] ;
		}
		return ['code' => Code::PARAM_ERR ,'msg'=>'操作失败'] ;
	}

	/**
	*批量删除
	*/
	public function delBatch() {
		StaffLeaveModel::delByIds($this->leaveId) ;
		return ['code' => Code::SUCCESS ,'msg'=>'操作成功'] ;
	}

	/**
	*分页查询
	* @return array
	*/
	public function getPage($andWhere = [] ) {
		$select = ['*'] ;
		$ret = StaffLeaveModel::getPage($this->page, $this->pageSize, $select, $andWhere,true) ;
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
		$ret = StaffLeaveModel::getAll($select, $andWhere,true) ;
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
        $formatData['time'] = $this->info['time'] ;
        $formatData['leaveReason'] = $this->info['leaveReason'] ;
        $formatData['leavePic'] = Json::decode($this->info['leavePic']) ;
        $formatData['leaveId'] = $this->info['leaveId'] ;
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
            $item['time'] = $value['time'] ;
            $item['leaveReason'] = $value['leaveReason'] ;
            $item['leavePic'] = $value['leavePic'] ;
            $item['leaveId'] = $value['leaveId'] ;
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