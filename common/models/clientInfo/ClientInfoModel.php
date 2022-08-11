<?php

namespace common\models\clientInfo;

/**
* Created by cqj
* User: cqj
* Date: 2020-07-10
* Time: 09:48
 * 客户表
*/

use common\models\BaseModel;

class ClientInfoModel extends BaseModel
{
    //1 潜在客户 2 普通客户 3 重要客户 4 无机会客户
    CONST TYPE_POTENTIAL = 1 ;
    CONST TYPE_ORDINARY = 2 ;
    CONST TYPE_MAJOR = 3 ;
    CONST TYPE_NO_CHANCE = 4 ;

    public static $TYPE_ENUM = [
        self::TYPE_POTENTIAL => '潜在客户',
        self::TYPE_ORDINARY => '普通客户',
        self::TYPE_MAJOR => '重要客户',
        self::TYPE_NO_CHANCE => '无机会客户',
    ];

    CONST WORK_YES = 1 ;
    CONST WORK_NO = 0 ;
    public static $WORK_ENUM = [
        self::WORK_NO => '待开发',
        self::WORK_YES => '已合作',

    ];

	public static function tableName()
	{
		return 'kj_client_info';
	}

    public function rules()
    {
        return [
            [['name','tell'], 'required', 'message' => '{attribute}不能为空'],
            [['name'],'string','max' => 20],
        ];
    }

    public function attributeLabels()
    {
        return [
            'name' => '名称',
            'tell' => '电话'
        ];
    }

	//通过Id查询单条数据
	public static function getById($id, $select = ['*'], $asArray = false, $isIndex = '')
	{
		$model = self::find()
						->select($select)
						->Where([ 'clientId' => $id , 'isValid' => self::IS_VALID_OK ]) ;
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
						->Where([ 'clientId' => $id , 'isValid' => self::IS_VALID_OK ])
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
		self::updateAll(['isValid' => self::IS_VALID_NO ],[ 'clientId' => $ids ]) ;
	}
}