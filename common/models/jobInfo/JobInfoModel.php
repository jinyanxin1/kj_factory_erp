<?php

namespace common\models\jobInfo;

/**
* Created by cqj
* User: cqj
* Date: 2020-07-07
* Time: 14:23
*/

use common\models\BaseModel;

class JobInfoModel extends BaseModel
{
    CONST FIRST_YES = 0 ;
    CONST FIRST_NO = 1 ;

    public static $FIRST_ENUM = [
        self::FIRST_YES => '是',
        self::FIRST_NO => '否',
    ];

    CONST STATUS_PUBLIC = 1;
    CONST STATUS_INTERVIEW = 2;
    CONST STATUS_ENTRY = 3;
    CONST STATUS_LEAVE = 4;

    public static $STATUS_ENUM = [
        self::STATUS_PUBLIC => '共享资源',
        self::STATUS_INTERVIEW => '邀约中',
        self::STATUS_ENTRY => '入职',
        self::STATUS_LEAVE => '离职',
    ];


        //'1 团员 2 党员 3群众 4 其他'
    CONST POLITICAL_MEMBER = 1;
    CONST POLITICAL_PARTY_MEMBER = 2;
    CONST POLITICAL_MASSES = 3;
    CONST POLITICAL_OTHER = 4;

    public static $POLITICAL_ENUM = [
        self::POLITICAL_MEMBER => '团员',
        self::POLITICAL_PARTY_MEMBER => '党员',
        self::POLITICAL_MASSES => '群众',
        self::POLITICAL_OTHER => '其他',
    ];

	public static function tableName()
	{
		return 'kj_job_info';
	}

    public function rules()
    {
        return [
            [['name','phone'], 'required', 'message' => '{attribute}不能为空'],
            [['name'],'string','max' => 20],
            [['idCard'],'string','max' => 18,'message' => '{attribute}格式错误'],
            ['phone','match','pattern'=>'/^[1][34578][0-9]{9}$/','message' => '{attribute}格式错误'],
        ];
    }

    public function attributeLabels()
    {
        return [
            'name' => '名称',
            'phone' => '手机号码',
            'idCard' => '身份证',
        ];
    }

    //通过Id查询单条数据
    public static function getByUserId($id, $select = ['*'], $asArray = false, $isIndex = '')
    {
        $model = self::find()
            ->select($select)
            ->Where([ 'userId' => $id , 'isValid' => self::IS_VALID_OK ]) ;
        if ($asArray) {
            $model = $model->asArray() ;
        }
        if ( !empty($isIndex) ) {
            $model = $model->indexBy($isIndex) ;
        }
        $model->limit(1) ;
        return $model->one() ;
    }

	//通过Id查询单条数据
	public static function getById($id, $select = ['*'], $asArray = false, $isIndex = '')
	{
		$model = self::find()
						->select($select)
						->Where([ 'jobId' => $id , 'isValid' => self::IS_VALID_OK ]) ;
		if ($asArray) {
			$model = $model->asArray() ;
		}
		if ( !empty($isIndex) ) {
			$model = $model->indexBy($isIndex) ;
		}
		$model->limit(1) ;
		return $model->one() ;
	}

	//逻辑单删除
	public static function delById($id)
	{
		$model = self::find()
						->Where([ 'jobId' => $id , 'isValid' => self::IS_VALID_OK ])
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
		self::updateAll(['isValid' => self::IS_VALID_NO ],[ 'jobId' => $ids ]) ;
	}
}