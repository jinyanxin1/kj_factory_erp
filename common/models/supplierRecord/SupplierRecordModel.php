<?php

namespace common\models\supplierRecord;

/**
* Created by cqj
* User: cqj
* Date: 2020-07-16
* Time: 10:20
*/

use common\models\BaseModel;

class SupplierRecordModel extends BaseModel
{
	public static function tableName()
	{
		return 'kj_supplier_record';
	}

	//通过Id查询单条数据
	public static function getById($id, $select = ['*'], $asArray = false, $isIndex = '')
	{
		$model = self::find()
						->select($select)
						->Where([ 'recordId' => $id , 'isValid' => self::IS_VALID_OK ]) ;
		if ($asArray) {
			$model = $model->asArray() ;
		}
		if ( !empty($isIndex) ) {
			$model = $model->indexBy($isIndex) ;
		}
		$model->limit(1) ;
		return $model->one() ;
	}

	//分页查询
	public static function getPage($page = 0, $pageSize = 0, $select = ['*'], $andWhere = [], 
												$asArray = false, $orderBy = '', $indexBy = '', $groupBy = '')
	{
		$model = self::find()
						->select($select)
						->Where([ 'isValid' => self::IS_VALID_OK ]) ;
		if ( !empty($andWhere) && is_array($andWhere) ) {
			foreach ($andWhere as $item) {
				$model->andWhere($item) ;
			}
		}
		if(!empty($pageSize)) {
			$offset = intval(($page - 1) * $pageSize) ;
			$model = $model->offset($offset)->limit(intval($pageSize)) ;
		}
		if(!empty($orderBy)) {
			$model = $model->orderBy($orderBy) ;
		}
		if(!empty($indexBy)) {
			$model = $model->indexBy($indexBy) ;
		}
		if(!empty($groupBy)) {
			$model = $model->groupBy($groupBy) ;
		}
		$count = $model->count() ;
		if ($asArray){
			$model->asArray() ;
		}
		$data = $model->all() ;
		return ['list' => $data, 'count' => $count] ;
	}

	//查询所有
	public static function getAll($select = ['*'], $andWhere = [], $asArray = false, 
												$orderBy = '', $indexBy = '', $groupBy = '')
	{
		$model = self::find()
						->select($select)
						->Where([ 'isValid' => self::IS_VALID_OK ]) ;
		if ( !empty($andWhere) && is_array($andWhere) ) {
			foreach ($andWhere as $item) {
				$model->andWhere($item) ;
			}
		}
		if(!empty($orderBy)) {
			$model = $model->orderBy($orderBy) ;
		}
		if(!empty($indexBy)) {
			$model = $model->indexBy($indexBy) ;
		}
		if(!empty($groupBy)) {
			$model = $model->groupBy($groupBy) ;
		}
		if ($asArray){
			$model->asArray() ;
		}
		$data = $model->all() ;
		return ['list' => $data ] ;
	}

	//逻辑单删除
	public static function delById($id)
	{
		$model = self::find()
						->Where([ 'recordId' => $id , 'isValid' => self::IS_VALID_OK ])
						->limit(1)
						->one() ;
		if (empty($model)) {
			return false ;
		}
		$model->isValid = self::IS_VALID_NO ;
		if (!$model->save()) {
			return false ;
		}
		return true ;
	}

	//逻辑批量删除
	public static function delByIds($ids)
	{
		self::updateAll(['isValid' => self::IS_VALID_NO ],[ 'recordId' => $ids ]) ;
	}
}