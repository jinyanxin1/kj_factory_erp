<?php
/**
 *
 * author: jinyanxin
 * Date: 2020/11/23
 * Time: 10:15
 * PHP version 7
 * 打印模板表
 */

namespace common\models\system\printTemplates;


use common\models\BaseModel;
use Yii;

/**
 * This is the model class for table "kj_project_info".
 *
 * @property int $printTemplatesId
 * @property int|null $type 类型
 * @property string|null $format 板式
 * @property string|null $h5 内容
 * @property string|null $creator
 * @property string|null $createTime
 * @property string|null $updater
 * @property string|null $updateTime
 * @property int|null $isValid 0未删除；1已删除
 */
class PrintTemplatesModel extends BaseModel
{

    public static function tableName()
    {
        return 'kj_print_templates';
    }

    public function attributeLabels()
    {
        return [
            'printTemplatesId' => 'ID',
            'type' => '类型',
            'format' => '板式',
            'h5' => '内容',
        ];
    }




}