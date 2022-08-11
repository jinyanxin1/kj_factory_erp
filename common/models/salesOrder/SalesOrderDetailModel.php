<?php
/**
 *
 * author: jinyanxin
 * Date: 2020/9/4
 * Time: 14:14
 * PHP version 7
 * 销售订单详情表
 */

namespace common\models\salesOrder;


use common\models\BaseModel;
use Yii;

/**
 * This is the model class for table "kj_sales_order_detail".
 *
 * @property int $id
 * @property int|null $orderId 订单id
 * @property int|null $goodsId 物品id
 * @property int|null $workingId 工序id
 * @property int|null $num 订购数量
 * @property int|null $price 单价
 * @property int|null $isTax 是否含税
 * @property int|null $taxPrice 是否含税  1不含税；2含税
 * @property int|null $deliveryNum 交货数量
 * @property string|null $unit 单位
 * @property string|null $creator
 * @property string|null $createTime
 * @property string|null $updater
 * @property string|null $updateTime
 * @property int|null $isValid
 */
class SalesOrderDetailModel extends BaseModel
{

    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'kj_sales_order_detail';
    }


    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'orderId' => '订单id',
            'goodsId' => '物品id',
            'workingId' => '工序id',
            'price' => '价格',
            'isTax' => '是否含税',
            'taxPrice' => '含税价格',
            'num' => '订购数量',
            'deliveryNum' => '交货数量',
            'unit' => '单位',
            'creator' => 'Creator',
            'createTime' => 'Create Time',
            'updater' => 'Updater',
            'updateTime' => 'Update Time',
            'isValid' => 'Is Valid',
        ];
    }

}