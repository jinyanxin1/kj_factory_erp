<?php
/**
 *
 * author: jinyanxin
 * Date: 2020/9/7
 * Time: 10:50
 * PHP version 7
 * 收支记录表
 */

namespace common\models\finance;


use common\models\BaseModel;
use Yii;


/**
 * This is the model class for table "kj_payments_log".
 *
 * @property int $id
 * @property int $type 类型：1收入；2支出；3转账
 * @property int $needBill 类型：2未开发票；1开发票
 * @property int|null $departmentId 部门
 * @property string|null $date 发生日期
 * @property int|null $paymentsTypeId 收支类别
 * @property int|null $incomeAccount 收入账户
 * @property int|null $expenditureAccount 支出账户
 * @property int|null $amount 金额
 * @property string|null $describe 备注
 * @property int|null $orderId 订单id
 * @property int|null $clientId 客户id
 * @property int|null $objectId 对象id
 * @property string|null $creator
 * @property string|null $createTime
 * @property string|null $updater
 * @property string|null $updateTime
 * @property int|null $isValid
 */
class PaymentsModel extends BaseModel
{
    const TYPE_INCOME = 1;//收入
    const TYPE_EXPENDITURE = 2;//支出
    const TYPE_TRANS = 3;//转账


    public static $typeList = [
        self::TYPE_INCOME => '收入',
        self::TYPE_EXPENDITURE => '支出',
        self::TYPE_TRANS => '转账',
    ];

    //2未开发票；1开发票
    const RECEIPT_NO = 2;
    const RECEIPT_YES = 1;



    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'kj_payments_log';
    }


    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'type' => '类型：1收入；2支出；3转账',
            'needBill' => '是否开发票',
            'departmentId' => '部门',
            'date' => '发生日期',
            'paymentsTypeId' => '收支类别',
            'incomeAccount' => '收入账户',
            'expenditureAccount' => '支出账户',
            'amount' => '金额',
            'describe' => '备注',
            'orderId' => '项目id',
            'clientId' => '客户id',
            'objectId' => '对象id',
            'creator' => 'Creator',
            'createTime' => 'Create Time',
            'updater' => 'Updater',
            'updateTime' => 'Update Time',
            'isValid' => 'Is Valid',
        ];
    }


    //根据订单id得到开发票的订单id
    public static function getIsDrewBillByOrderIds($orderIds = [])
    {
        $model = self::find()->select('orderId')->where([
            'type'=>self::TYPE_INCOME,'needBill'=>self::RECEIPT_YES,
            'orderId'=>$orderIds,'isValid'=>self::IS_VALID_OK])->asArray()->all();

        return count($model) > 0 ? array_column($model,'orderId') : [];
    }

}