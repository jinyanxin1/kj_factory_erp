<?php
/**
 * User: pyj
 * Date: 2020/8/11
 * Time: 20:57
 */

namespace common\models\jobRegistra;


use common\models\BaseModel;

class JobRegistraModel extends BaseModel
{
    //邀约状态
    CONST INVITE_ONE = 1;
    CONST INVITE_TWO = 2;

    public static $INVITE_ENUM = [
        self::INVITE_ONE => '已邀约',
        self::INVITE_TWO => '未邀约',
    ];

    //调用人才报名表
    public static function tableName()
    {
        return 'kj_job_registra';
    }


}