<?php

namespace common\models\supplierInfo;

/**
* Created by cqj
* User: cqj
* Date: 2020-07-16
* Time: 10:13
*/
use common\models\BaseForm;
use common\library\helper\Code;
use common\models\clientInfo\ClientInfoModel;
use common\models\industry\IndustryModel;
use common\models\jobInfo\JobInfoModel;
use common\models\staffInfo\StaffInfoForm;
use common\models\staffInfo\StaffInfoModel;
use common\models\supplierContract\SupplierContractModel;
use yii\base\Exception;

class SupplierInfoForm extends BaseForm
{
	//TODO 根据表情况新增字段变量
	public $page ;
	public $pageSize ;
	public $info ;
	public $list ;

	public $supplierId ;
	public $provinceId ;
	public $cityId ;
    public $areaId ;
    public $area ;
	public $industryId ;
	public $staffId ;
	public $type ;
	public $tell ;
	public $address ;
	public $settlement ;
	public $cycle ;
	public $startTime ;
	public $endTime ;
	public $name ;
	public $account ;
	public $accountBank ;
	public $remark ;
    public $supplierType ;
    public $userName ;
	/**
	*新增
	* @return array
	*/
	public function add() {
		$model = new SupplierInfoModel() ;
		//TODO 具体情况判断重命名
		//TODO 具体情况赋值参数
        if (!empty($this->area)) {
            $model->provinceId = $this->area[0] ;
            $model->cityId = isset($this->area[1])  ? $this->area[1] : 0;
            $model->areaId = isset($this->area[2]) ? $this->area[2] : 0 ;
        }

        $model->industryId = $this->industryId ;
        $model->staffId = $this->staffId ;
        $model->type = $this->type ;
        $model->tell = $this->tell ;
        $model->address = $this->address ;
        $model->settlement = $this->settlement ;
        $model->cycle = $this->cycle ;
        $model->startTime = $this->startTime ;
        $model->endTime = $this->endTime ;
        $model->name = $this->name ;
        $model->account = $this->account ;
        $model->accountBank = $this->accountBank ;
        $model->remark = $this->remark ;
        $model->supplierType = $this->supplierType ;
        $model->userName = $this->userName ;
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
		$model = SupplierInfoModel::getById($this->supplierId) ;
		if ( empty($model) ) {
			return ['code' => Code::PARAM_ERR ,'msg'=>'编号错误'] ;
		}
		//TODO 具体情况判断重命名
		//TODO 具体情况赋值参数
        if (!empty($this->area)) {
            $model->provinceId = $this->area[0] ;
            $model->cityId = isset($this->area[1])  ? $this->area[1] : 0;
            $model->areaId = isset($this->area[2]) ? $this->area[2] : 0 ;
        }
        $model->industryId = $this->industryId ;
        $model->staffId = $this->staffId ;
        $model->type = $this->type ;
        $model->tell = $this->tell ;
        $model->address = $this->address ;
        $model->settlement = $this->settlement ;
        $model->cycle = $this->cycle ;
        $model->startTime = $this->startTime ;
        $model->endTime = $this->endTime ;
        $model->name = $this->name ;
        $model->account = $this->account ;
        $model->accountBank = $this->accountBank ;
        $model->remark = $this->remark ;
        $model->supplierType = $this->supplierType ;
        $model->userName = $this->userName ;

		if ( !$model->save() ) {
			return ['code' => Code::PARAM_ERR ,'msg'=>$this->getErrorResponse($model)] ;
		}
		return ['code' => Code::SUCCESS ,'msg'=>'编辑成功'] ;
	}

	/**
	*详情
	* @return array
	*/
	public function getInfo() {
		$this->info = SupplierInfoModel::getById($this->supplierId,['*'],true) ;
		return $this->info ;
	}

	/**
	*删除
	*/
	public function del() {
        $tran = \Yii::$app->db->beginTransaction();
        try {
            if (!SupplierInfoModel::delById($this->supplierId)) {
                throw new Exception('操作失败');
            }
            SupplierContractModel::updateAll(['supplierId' => $this->supplierId],['isValid' => SupplierContractModel::IS_VALID_NO]);
            $tran->commit();
        }catch (\Exception $exception) {
            \Yii::info('操作失败:' . $exception->getMessage());
            $tran->rollBack();
            return ['code' => Code::PARAM_ERR ,'msg'=>$exception->getMessage()] ;
        }
        return ['code' => Code::SUCCESS, 'msg' => '操作成功'];

	}

	/**
	*批量删除
	*/
	public function delBatch() {
		SupplierInfoModel::delByIds($this->supplierId) ;
		return ['code' => Code::SUCCESS ,'msg'=>'操作成功'] ;
	}

	/**
	*分页查询
	* @return array
	*/
	public function getPage($andWhere = []) {
		$select = ['*'] ;
		$ret = SupplierInfoModel::getPage($this->page, $this->pageSize, $select, $andWhere,true) ;
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
        if (!empty($this->staffId)) {
            $andWhere[] = [
                'staffId' => $this->staffId
            ] ;

        }
		$ret = SupplierInfoModel::getAll($select, $andWhere,true) ;
		$this->list = isset($ret['list']) ? $ret['list'] : [] ;
		return ['list' => $this->list] ;
	}

	/**
	*格式化详情数据
	* @return array
	*/
	public function formatInfo() {
		//TODO 按照需求格式化数据
        $staff = StaffInfoModel::getById($this->info['staffId'],['staffId','name'],true);
		$formatData = $this->info ;
        $formatData['staffName'] = $staff['name'] ?? '';
        if (!empty($formatData['provinceId'])) {
            $formatData['area'] = [
                $formatData['provinceId'],
                $formatData['cityId'],
                $formatData['areaId']
            ];
        }
        $formatData['industryId'] = IndustryModel::getIndustryId($formatData['industryId']);

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
		$staffIds = array_column($this->list,'staffId') ;
		$staffList = StaffInfoModel::find()
            ->where(['staffId' => $staffIds])
            ->indexBy('staffId')
            ->asArray()
            ->all();
		$supplierIds = array_column($this->list,'supplierId');
        $supplierCount = JobInfoModel::find()
            ->select(['supplierId','count(jobId) as count'])
            ->andWhere(['isValid' => JobInfoModel::IS_VALID_OK])
            ->andWhere(['supplierId' => $supplierIds])
            ->groupBy('supplierId')
            ->indexBy('supplierId')
            ->asArray()
            ->all();
		foreach ( $this->list as $key => $value ) {
            $item = [] ;
            $item['supplierId'] = $value['supplierId'] ;
            $item['type'] = $value['type'] ;
            $item['typeName'] = isset(StaffInfoModel::$TYPE_ENUM[$value['type']]) ?
                StaffInfoModel::$TYPE_ENUM[$value['type']] : '';
            $item['name'] = $value['name'] ;
            $item['tell'] = $value['tell'] ;
            $item['staffId'] = $value['staffId'] ;
            $item['staffName'] = isset($staffList[$value['staffId']]) ?
                $staffList[$value['staffId']]['name'] : '';
            $item['count'] = isset($supplierCount[$value['supplierId']]) ?
                $supplierCount[$value['supplierId']]['count'] : 0 ;
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
            $formatData[intval($value['supplierId'])] = $value['name'] ;
        }
		return $formatData ;
	}

    /**
     *编辑
     * @return array
     */
    public function shift() {
        $model = SupplierInfoModel::getById($this->supplierId) ;
        if ( empty($model) ) {
            return ['code' => Code::PARAM_ERR ,'msg'=>'编号错误'] ;
        }
        $model->staffId = $this->staffId ;
        if ( !$model->save() ) {
            return ['code' => Code::PARAM_ERR ,'msg'=>'转移失败'] ;
        }
        return ['code' => Code::SUCCESS ,'msg'=>'转移成功'] ;
    }
}