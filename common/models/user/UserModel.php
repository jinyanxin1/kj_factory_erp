<?php


namespace common\models\user;


use common\models\BaseModel;
use common\models\jobInfo\JobInfoModel;
use common\models\staffInfo\StaffInfoModel;

class UserModel  extends BaseModel


{

    const STAFF = 1;   //职工
    const JOB   = 2;   //求职者

    public static $ENUM_TYPE = [
        self::STAFF => '职工',
        self::JOB => '求职者',
    ];

    public static function tableName()
    {
        return 'kj_user';
    }

    public static function getTypeId($id) {
        $info = self::getById($id,false);
        $typeId = 0 ;
        switch ($info->userType) {
            case self::STAFF :
                $staffInfo = StaffInfoModel::getByUserId($id);
                $typeId = $staffInfo->staffId ;
                break;
            case self::JOB :
                $jobInfo = JobInfoModel::getByUserId($id);
                $typeId = $jobInfo->jobId ;
                break;
        }
        return $typeId ;
    }

    //通过id获得单挑数据
    public static function getById($id,$isArr = true)
    {
        //todo 删除状态不符
        $info = self::find()->where(['id'=>$id]);
        if($isArr === true){
            $info->asArray();
        }
        return $info->one();
    }


    /*
     * 通过 查询条件 获取数据
     * $where  arr
     * return arr
     * */
    public static function getByWhere($where,$isArr = true)
    {
        $model = self::find()->where($where);
        if($isArr === true){
            $model->asArray();
        }
        return $model->all();
    }

}