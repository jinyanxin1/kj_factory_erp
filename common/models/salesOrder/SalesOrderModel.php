<?php
/**
 *
 * author: jinyanxin
 * Date: 2020/9/4
 * Time: 14:10
 * PHP version 7
 * 销售订单主表
 */

namespace common\models\salesOrder;


use common\models\BaseModel;
use Yii;

/**
 * This is the model class for table "kj_sales_order".
 *
 * @property int $id
 * @property string|null $number 订单编号
 * @property string|null $contractCode 合同编号
 * @property string $orderDate 订单日期
 * @property int|null $clientId 客户名称
 * @property int|null $clientPersonId 客户联系人id
 * @property int|null $totalPrice 订单总金额
 * @property int|null $receiptPrice 收款金额
 * @property string|null $deliveryDate 要求交货日期
 * @property string|null $sendDate 发货日期
 * @property string|null $sendWay 发货方式
 * @property string|null $clientAddress 客户地址
 * @property int|null $status 状态：1未完成；2已完成
 * @property int|null $collectionStatus 收款状态：1未完成；2已完成
 * @property string|null $fileUrl 合同地址
 * @property string|null $creator
 * @property string|null $createTime
 * @property string|null $updater
 * @property string|null $updateTime
 * @property int|null $isValid
 */
class SalesOrderModel extends BaseModel
{
    const TAX_PROPORTION = 1.13;//含税比例

    const ORDER_PREFIX = 'SALES';

    //状态：1生产中；2生产完成；3已发货；4已完成
    const STATUS_PRO_ING = 1;//1生产中
    const STATUS_PRODUCTION_COMPLETE = 2;//2生产完成
    const STATUS_SEND = 3;//3已发货

    public static $statusList = [
        self::STATUS_PRO_ING => '生产中',
        self::STATUS_PRODUCTION_COMPLETE => '生产完成',
        self::STATUS_SEND => '已发货',
    ];

    //是否收款完成：1未完成；2已完成
    const COLLECTION_STATUS_NO = 1;
    const COLLECTION_STATUS_YES = 2;

    public static $collectionStatusList = [
        self::COLLECTION_STATUS_NO => '未完成',
        self::COLLECTION_STATUS_YES => '已完成',
    ];

    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'kj_sales_order';
    }


    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'number' => '订单编号',
            'contractCode' => '合同编号',
            'orderDate' => '订单日期',
            'clientId' => '客户名称',
            'clientPersonId' => '客户联系人',
            'totalPrice' => '订单总金额',
            'receiptPrice' => '收款金额',
            'deliveryDate' => '要求交货日期',
            'sendDate' => '发货日期',
            'sendWay' => '发货方式',
            'clientAddress' => '客户地址',
            'status' => '状态',
            'collectionStatus' => '收款状态',
            'fileUrl' => '合同地址',
            'creator' => 'Creator',
            'createTime' => 'Create Time',
            'updater' => 'Updater',
            'updateTime' => 'Update Time',
            'isValid' => 'Is Valid',
        ];
    }


}