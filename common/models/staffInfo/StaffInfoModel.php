<?php

namespace common\models\staffInfo;

/**
* Created by cqj
* User: cqj
* Date: 2020-07-07
* Time: 14:22
*/

use common\models\BaseModel;

class StaffInfoModel extends BaseModel
{
    const STATUS_ENTRY = 0;
    const STATUS_LEAVE = 1;

    public static $STATUS_ENUM = [
        self::STATUS_ENTRY => '入职',
        self::STATUS_LEAVE => '离职',
    ];

    //'1 未婚 2已婚 3离异 4丧偶 5分居',
    CONST MARITAL_ONE = 1;
    CONST MARITAL_TWO = 2;
    CONST MARITAL_THREE = 3;
    CONST MARITAL_FOUR = 4;
    CONST MARITAL_FIVE = 5;

    public static $marital_ENUM = [
        self::MARITAL_ONE => '未婚',
        self::MARITAL_TWO => '已婚',
        self::MARITAL_THREE => '离异',
        self::MARITAL_FOUR => '丧偶',
        self::MARITAL_FIVE => '分居',
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

    public static function tableName()
	{
		return 'kj_staff_info';
	}
    public function rules()
    {
        return [
            [['name','phone','entryTime','sex'], 'required', 'message' => '{attribute}不能为空'],
            [['remark'],'string','max' => 200,'message' => '{attribute}最大字符限制200'],
            [['name'],'string','max' => 20],
            [['idCard'],'string','max' => 18,'message' => '{attribute}格式错误'],
            ['phone','match','pattern'=>'/^[1][34578][0-9]{9}$/',
                'message' => '{attribute}格式错误'],

        ];
    }

    public function attributeLabels()
    {
        return [
            'name' => '名称',
            'phone' => '电话',
            'sex' => '性别',
            'remark' => '备注',
            'idCard' => '身份证',
            'entryTime' => '入职时间',
        ];
    }

    //通过Id查询单条数据
    public static function getById($id, $select = ['*'], $asArray = false, $isIndex = '')
    {
        $model = self::find()
            ->select($select)
            ->Where([ 'staffId' => $id , 'isValid' => self::IS_VALID_OK ]) ;
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



	//逻辑单删除
	public static function delById($id)
	{
		$model = self::find()
						->Where([ 'staffId' => $id , 'isValid' => self::IS_VALID_OK ])
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
		self::updateAll(['isValid' => self::IS_VALID_NO ],[ 'staffId' => $ids ]) ;
	}
}