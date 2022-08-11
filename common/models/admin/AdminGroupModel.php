<?php
/**
 * Created by PhpStorm.
 * User: zhouk
 * Date: 2019/7/31
 * Time: 17:48
 */

namespace common\models\admin;


use common\models\BaseModel;

class AdminGroupModel extends BaseModel
{

    public static function tableName()
    {
        return 'kj_sys_admin_group';
    }


    /**
     * @param $schoolId
     * @return array|\yii\db\ActiveRecord[]
     */
    public static function getGroupList($schoolId)
    {
        return static::find()->where(['isValid' => self::IS_VALID_OK, 'stationId' => $schoolId])->asArray()->all();
    }

    /**
     * @author zky
     * @duty 根据id 查询用户组信息
     * @param $id
     * @return array|null|\yii\db\ActiveRecord
     */
    public static function getInfo($id){
        return static::find()->where(['groupId' => $id, 'isValid' => self::IS_VALID_OK])->one();
    }


}