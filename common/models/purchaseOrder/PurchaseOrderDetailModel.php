<?php
/**
 *
 * author: jinyanxin
 * Date: 2020/9/3
 * Time: 15:12
 * PHP version 7
 */

namespace common\models\purchaseOrder;


use common\models\BaseModel;
use Yii;

/**
 * This is the model class for table "kj_purchase_order_detail".
 *
 * @property int $id
 * @property int|null $orderId 采购订单id
 * @property int|null $goodsId 采购物品id
 * @property int|null $purchaseNum 采购数量
 * @property int|null $deliveryNum 交货数量
 * @property string|null $unit 单位
 * @property int|null $price 单价
 * @property int|null $totalPrice 总价
 * @property string|null $creator
 * @property string|null $createTime
 * @property string|null $updater
 * @property string|null $updateTime
 * @property int|null $isValid
 */
class PurchaseOrderDetailModel extends BaseModel
{

    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'kj_purchase_order_detail';
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'orderId' => '采购订单id',
            'goodsId' => '采购物品id',
            'purchaseNum' => '采购数量',
            'deliveryNum' => '交货数量',
            'unit' => '单位',
            'price' => '单价',
            'totalPrice' => '总价',
            'creator' => 'Creator',
            'createTime' => 'Create Time',
            'updater' => 'Updater',
            'updateTime' => 'Update Time',
            'isValid' => 'Is Delete',
        ];
    }

}