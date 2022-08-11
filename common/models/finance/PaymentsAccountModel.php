<?php
/**
 *
 * author: jinyanxin
 * Date: 2020/9/15
 * Time: 11:02
 * PHP version 7
 * 账户表
 */

namespace common\models\finance;


use common\models\BaseModel;
use Yii;

/**
 * This is the model class for table "kj_payments_account".
 *
 * @property int $id
 * @property string|null $name 账户名称
 * @property string|null $accountNumber 账号
 * @property int|null $incomeAmount 收入金额
 * @property int|null $expenditureAmount 支出金额
 * @property string|null $creator
 * @property string|null $createTime
 * @property string|null $updater
 * @property string|null $updateTime
 * @property int|null $isValid
 */
class PaymentsAccountModel extends BaseModel
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'kj_payments_account';
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'name' => '账户名称',
            'accountNumber' => '账号',
            'incomeAmount' => '收入金额',
            'expenditureAmount' => '支出金额',
            'creator' => 'Creator',
            'createTime' => 'Create Time',
            'updater' => 'Updater',
            'updateTime' => 'Update Time',
            'isValid' => 'Is Valid',
        ];
    }


}