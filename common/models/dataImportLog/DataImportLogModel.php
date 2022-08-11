<?php
/**
 *
 * author: jinyanxin
 * Date: 2020/10/30
 * Time: 11:27
 * PHP version 7
 */

namespace common\models\dataImportLog;


use common\models\BaseModel;
use Yii;
/**
 * This is the model class for table "kj_data_import_log".
 *
 * @property int $id
 * @property int|null $type  类型：1人才导入
 * @property int|null $status 0导入中；1导入完成；2导入失败
 * @property string|null $fileUrl 文件路径
 * @property int|null $isConsole -0需要；1已执行
 * @property int|null $staffId 职工id
 * @property string|null $error  错误信息
 * @property string|null $creator
 * @property string|null $createTime
 * @property string|null $updater
 * @property string|null $updateTime
 * @property int|null $isValid
 */
class DataImportLogModel extends BaseModel
{

    const TYPE_JOB = 1;//人才导入

    const IMPORT_ING = 0;//导入中
    const COMPLETED = 1;//导入已完成
    const COMPLETED_NO = 2;//失败

    const IS_CONSOLE_YES = 0;//需要执行定时任务
    const IS_CONSOLE_COMPLETED = 1;//已执行定时任务

    public static $statusList = [
        self::IMPORT_ING => '导入中',
        self::COMPLETED => '成功',
        self::COMPLETED_NO => '失败',
    ];

    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'kj_data_import_log';
    }

}