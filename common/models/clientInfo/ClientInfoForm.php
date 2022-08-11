<?php

namespace common\models\clientInfo;

/**
* Created by cqj
* User: cqj
* Date: 2020-07-10
* Time: 09:48
*/

use common\models\clientContract\ClientContractModel;
use common\models\clientInfo\ClientInfoModel;
use common\models\BaseForm;
use common\library\helper\Code;
use common\models\industry\IndustryModel;
use common\models\jobInfo\JobInfoModel;
use common\models\staffInfo\StaffInfoModel;
use common\models\system\basis\BasisModel;
use yii\base\Exception;

class ClientInfoForm extends BaseForm
{
	//TODO 根据表情况新增字段变量
	public $page ;
	public $pageSize ;
	public $info ;
	public $list ;

    public $clientId ;
    public $price ;
	public $name ;
	public $type ;
	public $staffId ;
	public $industryId ;
	public $provinceId ;
	public $cityId ;
    public $areaId ;
    public $area;
	public $tell ;
	public $address ;
	public $introduction ;
	public $website ;
	public $staffRangeMin ;
    public $staffRangeMax ;
    public $isWork ;
    public $logo ;
    public $range ;
	/**
	*新增
	* @return array
	*/
	public function add() {
		$model = new ClientInfoModel() ;
		//TODO 具体情况判断重命名
		//TODO 具体情况赋值参数
        $model->name = $this->name ;
        $model->type = $this->type ;
        $model->staffId = $this->staffId ;
        $model->industryId = $this->industryId ;
        if (!empty($this->area)) {
            $model->provinceId = $this->area[0] ;
            $model->cityId = isset($this->area[1]) ? $this->area[1] : 0;
            $model->areaId = isset($this->area[2]) ? $this->area[2]  : 0;
        }
        $model->tell = $this->tell ;
        $model->address = $this->address ;
        $model->logo = $this->logo ;
        $model->introduction = $this->introduction ;
        $model->website = $this->website ;
        $model->range = $this->range ;
        $model->price = $this->price * 100;
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
		$model = ClientInfoModel::getById($this->clientId) ;
		if ( empty($model) ) {
			return ['code' => Code::PARAM_ERR ,'msg'=>'编号错误'] ;
		}
		//TODO 具体情况判断重命名
		//TODO 具体情况赋值参数
        $model->name = $this->name ;
        $model->type = $this->type ;
        $model->staffId = $this->staffId ;
        $model->industryId = $this->industryId ;
        if (!empty($this->area)) {
            $model->provinceId = $this->area[0] ;
            $model->cityId = isset($this->area[1]) ? $this->area[1] : 0;
            $model->areaId = isset($this->area[2]) ? $this->area[2]  : 0;
        }
        $model->tell = $this->tell ;
        $model->address = $this->address ;
        $model->logo = $this->logo ;
        $model->introduction = $this->introduction ;
        $model->website = $this->website ;
        $model->range = $this->range ;
        $model->price = $this->price * 100 ;
		if ( !$model->save() ) {
			return ['code' => Code::PARAM_ERR ,'msg'=>$this->getErrorResponse($model)] ;
		}
		return ['code' => Code::SUCCESS ,'msg'=>'编辑成功'] ;
	}

    /**
     *编辑
     * @return array
     */
    public function shift() {
        $model = ClientInfoModel::getById($this->clientId) ;
        if ( empty($model) ) {
            return ['code' => Code::PARAM_ERR ,'msg'=>'编号错误'] ;
        }
        $model->staffId = $this->staffId ;
        if ( !$model->save() ) {
            return ['code' => Code::PARAM_ERR ,'msg'=>'转移失败'] ;
        }
        return ['code' => Code::SUCCESS ,'msg'=>'转移成功'] ;
    }

	/**
	*详情
	* @return array
	*/
	public function getInfo() {
		$this->info = ClientInfoModel::getById($this->clientId,['*'],true) ;
		return $this->info ;
	}

	/**
	*删除
	*/
	public function del() {
        $tran = \Yii::$app->db->beginTransaction();
        try {
            if (!ClientInfoModel::delById($this->clientId)) {
                throw new Exception('操作失败');
            }
            $tran->commit();
        }catch (\Exception $exception) {
            \Yii::info('操作失败:' . $exception->getMessage());
            $tran->rollBack();
            return ['code' => Code::PARAM_ERR ,'msg'=>$exception->getMessage()] ;
        }

        return ['code' => Code::SUCCESS ,'msg'=>'操作成功'] ;

    }

	/**
	*批量删除
	*/
	public function delBatch() {
		ClientInfoModel::delByIds($this->clientId) ;
		return ['code' => Code::SUCCESS ,'msg'=>'操作成功'] ;
	}

    /**
     * @param array $andWhere
     * @return array
     * 分页查询
     */
	public function getPage($andWhere = []) {
		$select = ['*'] ;
		$ret = ClientInfoModel::getPage($this->page, $this->pageSize, $select, $andWhere,true) ;
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
		$ret = ClientInfoModel::getAll($select, $andWhere,true) ;
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
        $jobCount = JobInfoModel::find()
            ->select(['clientId','count(jobId) as count'])
            ->andWhere(['isValid' => JobInfoModel::IS_VALID_OK])
            ->andWhere(['status' => JobInfoModel::STATUS_ENTRY])
            ->andWhere(['clientId' => $this->info['clientId']])
            ->groupBy('clientId')
            ->asArray()
            ->one();
        if (!empty($formatData['provinceId'])) {
            $formatData['area'] = [
                $formatData['provinceId'],
                $formatData['cityId'],
                $formatData['areaId']
            ];
        }
        $range = BasisModel::getBasicsName($formatData['range']);
        $staff = StaffInfoModel::getById($this->info['staffId'],['staffId','name'],true);
        $formatData['staffName'] = $staff['name'] ?? '';
        $formatData['price'] = self::amountToYuan($formatData['price']);
        $formatData['industryId'] = IndustryModel::getIndustryId($formatData['industryId']);
        $formatData['count'] = $jobCount['count'] ?? 0;
        $formatData['rangeName'] = $range;
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
        $clientIds = array_column($this->list,'clientId');
		$staffList = StaffInfoModel::find()
            ->where(['isValid' => StaffInfoModel::IS_VALID_OK])
            ->andWhere(['staffId' => $staffIds])
            ->asArray()
            ->indexBy('staffId')
            ->all();
        $jobCount = JobInfoModel::find()
            ->select(['clientId','count(jobId) as count'])
            ->andWhere(['isValid' => JobInfoModel::IS_VALID_OK])
            ->andWhere(['status' => JobInfoModel::STATUS_ENTRY])
            ->andWhere(['clientId' => $clientIds])
            ->groupBy('clientId')
            ->indexBy('clientId')
            ->asArray()
            ->all();
		foreach ( $this->list as $key => $value ) {
			$item = [] ;
            $item['clientId'] = $value['clientId'];
            $item['name'] = $value['name'];
            $item['price'] = self::amountToYuan($value['price']);
            $item['type'] = $value['type'];
            $item['typeName'] = ClientInfoModel::$TYPE_ENUM[$item['type']] ?? '';
            $item['isWork'] = $value['isWork'];
            $item['tell'] = $value['tell'];
            $item['logo'] = $value['logo'];
            $item['staffId'] = $value['staffId'];
            $item['isWorkName'] = ClientInfoModel::$WORK_ENUM[$item['isWork']] ?? '';
            $item['staffName'] = isset($staffList[$value['staffId']]) ? $staffList[$value['staffId']]['name'] : '';
            $item['count'] = isset($jobCount[$value['clientId']]) ?
                $jobCount[$value['clientId']]['count'] : 0 ;
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
            $formatData[intval($value['clientId'])] = $value['name'] ;
        }
		return $formatData ;
	}
}