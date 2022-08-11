<?php
/**
 * User: pyj
 * Date: 2020/8/6
 * Time: 11:54
 */

namespace common\models\recruitment;


use common\models\BaseModel;

class RecruitmentModel extends BaseModel
{
    public static function tableName()
    {
        return 'kj_recruitment';
    }
}