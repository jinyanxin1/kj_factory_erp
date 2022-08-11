<?php
/**
 *
 * author: jinyanxin
 * Date: 2020/11/18
 * Time: 11:47
 * PHP version 7
 */

namespace common\models\purchase\consumption;


use common\models\BaseModel;
use Yii;

/**
 * This is the model class for table "kj_goods_production_consumption_detail".
 *
 * @property int $consumptionDetailId 表id
 * @property int|null $goodsType 1产品；2物料
 * @property int $consumptionId 主表id
 * @property int $goodsId 商品id
 * @property int $workingId 工序id
 * @property int $num 数量
 * @property int $price 进货价格
 * @property string|null $createTime 创建时间
 * @property string|null $creator 创建者
 * @property string|null $updateTime 修改时间
 * @property string|null $updater 修改者
 * @property int|null $isValid 0正常，1删除
 */
class GoodsConsumptionDetailModel extends BaseModel
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'kj_goods_production_consumption_detail';
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'consumptionDetailId' => '表id',
            'goodsType' => '1产品；2物料',
            'consumptionId' => '主表id',
            'goodsId' => '商品id',
            'workingId' => '工序id',
            'num' => '数量',
            'price' => '进货价格',
            'createTime' => '创建时间',
            'creator' => '创建者',
            'updateTime' => '修改时间',
            'updater' => '修改者',
            'isValid' => '0正常，1删除',
        ];
    }




}