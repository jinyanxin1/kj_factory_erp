<?php

namespace common\models\clientInterviewRecord;

/**
* Created by cqj
* User: cqj
* Date: 2020-07-10
* Time: 09:48
*/

use common\models\BaseModel;

class ClientInterviewRecordModel extends BaseModel
{
    CONST STATUS_ONE = 1 ;
    CONST STATUS_ZERO = 0 ;

    public static $STATUS_ENUM = [
        self::STATUS_ONE => '已合作',
        self::STATUS_ZERO => '跟进'
    ];
//跟进方式 1 电话 2 邮件 3面谈 4 其他',
    CONST FOLLOW_ONE = 1 ;
    CONST FOLLOW_TWO = 2 ;
    CONST FOLLOW_THREE = 3 ;
    CONST FOLLOW_FOUR = 4 ;

    public static $FOLLOW_ENUM = [
        self::FOLLOW_ONE => '电话',
        self::FOLLOW_TWO => '邮件',
        self::FOLLOW_THREE => '面谈',
        self::FOLLOW_FOUR => '其他',
    ];


	public static function tableName()
	{
		return 'kj_client_Interview_record';
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