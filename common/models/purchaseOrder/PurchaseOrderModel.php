<?php
/**
 *
 * author: jinyanxin
 * Date: 2020/9/3
 * Time: 14:57
 * PHP version 7
 * 采购单主表
 */

namespace common\models\purchaseOrder;


use common\models\BaseModel;
use Yii;


/**
 * This is the model class for table "kj_purchase_order".
 *
 * @property int $id
 * @property string|null $number 采购单编号
 * @property string $orderDate 采购单日期
 * @property string $shipmentDate 付运日期
 * @property int|null $userId 付运日期
 * @property int|null $wareHouseId 仓库id
 * @property string|null $wareHouseContacts 付运联系人
 * @property string|null $wareHouseAddress 付运地址
 * @property string|null $wareHouseTel 付运电话
 * @property int|null $supplierId 供应商id
 * @property string|null $supplierContacts 供应商联系人
 * @property string|null $supplierAddress 供应商地址
 * @property string|null $supplierTel 供应商电话
 * @property int|null $status 状态：1未审批；2下单；3收货中；4订单完成
 * @property int|null $price 采购单金额
 * @property string|null $describe 备注
 * @property string|null $creator
 * @property string|null $createTime
 * @property string|null $updater
 * @property string|null $updateTime
 * @property int|null $isValid
 */
class PurchaseOrderModel extends BaseModel
{

    //1未审批；2下单；3收货中；4订单完成
    const  STATUS_EXAMINE_NO = 1;
    const STATUS_EXAMINE_YES = 2;
    const STATUS_ING = 3;
    const STATUS_COMPLETE = 4;

    const ORDER_PREFIX = 'PUR';

    public static $statusList = [
        self::STATUS_EXAMINE_NO => '未审批',
        self::STATUS_EXAMINE_YES => '已审批',
        self::STATUS_ING => '3收货中',
        self::STATUS_COMPLETE => '采购完成',
    ];


    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'kj_purchase_order';
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'number' => '采购单编号',
            'orderDate' => '采购单日期',
            'shipmentDate' => '付运日期',
            'userId' => '下单人',
            'wareHouseId' => '仓库id',
            'wareHouseContacts' => '付运联系人',
            'wareHouseAddress' => '付运地址',
            'wareHouseTel' => '付运电话',
            'supplierId' => '供应商id',
            'supplierContacts' => '供应商联系人',
            'supplierAddress' => '供应商地址',
            'supplierTel' => '供应商电话',
            'status' => '状态',
            'price' => '采购单金额',
            'describe' => '备注',
            'creator' => 'Creator',
            'createTime' => 'Create Time',
            'updater' => 'Updater',
            'updateTime' => 'Update Time',
            'isValid' => 'Is Delete',
        ];
    }

}