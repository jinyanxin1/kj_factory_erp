<?php
/**
 *
 * author: jinyanxin
 * Date: 2020/10/27
 * Time: 16:31
 * PHP version 7
 * 通知阅读记录表
 */

namespace common\models\notice;


use common\models\BaseModel;
use Yii;

/**
 * This is the model class for table "kj_notice_read_log".
 *
 * @property int $id
 * @property int|null $userId
 * @property int|null $noticeId
 * @property string|null $creator
 * @property string|null $createTime
 * @property string|null $updater
 * @property string|null $updateTime
 * @property int|null $isValid
 */
class NoticeReadLogModel extends BaseModel
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'kj_notice_read_log';
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'userId' => 'User ID',
            'noticeId' => 'Notice ID',
            'creator' => 'Creator',
            'createTime' => 'Create Time',
            'updater' => 'Updater',
            'updateTime' => 'Update Time',
            'isValid' => 'Is Valid',
        ];
    }
}