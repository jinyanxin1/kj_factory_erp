<?php
/**
 *
 * author: jinyanxin
 * Date: 2020/10/23
 * Time: 11:31
 * PHP version 7
 * 操作日志记录表
 */

namespace common\models\operateLog;

use common\models\BaseModel;
use Yii;

/**
 * This is the model class for table "kj_operate_log".
 *
 * @property int $id
 * @property int|null $type 类型
 *  * @property int|null $eventId
 * @property int|null $clientId
 * @property int|null $jobId
 * @property int|null $staffId
 * @property int|null $supplierId
 * @property string|null $content 文案
 * @property string|null $creator
 * @property string|null $createTime
 * @property string|null $updater
 * @property string|null $updateTime
 * @property int|null $isValid
 */
class OperateLogModel extends BaseModel
{
    const TYPE_ENTRY = 1;//入职
    const TYPE_QUIT = 2;//离职
    const TYPE_INVITATION = 3;//邀请面试
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'kj_operate_log';
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'type' => 'Type',
            'eventId' => 'event ID',
            'clientId' => 'Client ID',
            'jobId' => 'Job ID',
            'staffId' => 'Staff ID',
            'supplierId' => 'Supplier ID',
            'content' => 'Content',
            'creator' => 'Creator',
            'createTime' => 'Create Time',
            'updater' => 'Updater',
            'updateTime' => 'Update Time',
            'isValid' => 'Is Valid',
        ];
    }

    public static function saveData($type,$clientId,$jobId,$supplierId,$staffId,$eventId,$content)
    {
        $info = new OperateLogModel();
        $info->type = $type;
        $info->eventId = $eventId;
        $info->jobId = $jobId;
        $info->clientId = $clientId;
        $info->supplierId = $supplierId;
        $info->staffId = $staffId ;
        $info->content = $content;
        $info->save();
        return true;
    }
}