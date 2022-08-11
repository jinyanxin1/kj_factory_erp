<?php
/**
 *
 * author: jinyanxin
 * Date: 2020/9/7
 * Time: 9:06
 * PHP version 7
 * 物品表
 */

namespace common\models\goods;


use common\models\BaseModel;
use Yii;


/**
 * This is the model class for table "kj_goods".
 *
 * @property int $id
 * @property int|null $type 类型
 * @property int|null $categoryId 类别id
 * @property int|null $price 价格
 * @property string|null $number 编号
 * @property string|null $name 物品名称
 * @property string|null $unit 单位
 * @property string|null $pic 图片
 * @property string|null $describe 描述
 * @property string|null $remark 备注
 * @property int|null $isFinished  是否成品， 1成品，2半成品
 * @property string|null $weight 重量
 * @property string|null $volume 体积
 * @property string|null $parameter 参数
 * @property string|null $attr 规格
 * @property string|null $creator
 * @property string|null $createTime
 * @property string|null $updater
 * @property string|null $updateTime
 * @property int|null $isValid
 */
class GoodsModel extends BaseModel
{
    const TYPE_MATERIEL = 2;//物料
    const TYPE_PRODUCTION = 1;//产品
    const TYPE_ALL = 3;//所有，不确定是物料还是产品

    const IS_FINISHED_YES = 1;//1成品
    const IS_FINISHED_NO = 2;//半成品

    public static $typeList = [
        self::TYPE_PRODUCTION => '产品',
        self::TYPE_MATERIEL => '物料',
    ];

    public static $finishedList = [
        self::IS_FINISHED_YES => '成品',
        self::IS_FINISHED_NO => '半成品',
    ];
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'kj_goods';
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'type'=>'类型',
            'categoryId' => '类别id',
            'price' => '价格',
            'number' => '编号',
            'name' => '物品名称',
            'unit' => '单位',
            'pic' => '图片',
            'describe' => '描述',
            'remark' => '备注',
            'isFinished' => '是否成品',
            'weight' => '重量',
            'volume' => '体积',
            'parameter' => '参数',
            'attr' => '参数',
            'creator' => 'Creator',
            'createTime' => 'Create Time',
            'updater' => 'Updater',
            'updateTime' => 'Update Time',
            'isValid' => 'Is Valid',
        ];
    }

    //根据idList得到商品  已goodsId作为键输出
    public static function getByIdList($goodsIdList)
    {
        $model = self::find()->where(['id'=>$goodsIdList,'isValid'=>self::IS_VALID_OK])->indexBy('id')->asArray()->all();
        return $model;
    }

    //根据类别得到商品
    public static function getDataByCategoryId($categoryId)
    {
        $data = self::find()->where(['categoryId'=>$categoryId,'isValid'=>self::IS_VALID_OK])->asArray()->all();
        return $data;
    }

    //根据商品名称得到商品
    public static function getDataByGoodsName($goodsName)
    {
        $data = self::find()->where(
            [
                'and',
                ['like','name',$goodsName],
                ['isValid'=>self::IS_VALID_OK]
            ]
        )->asArray()->all();
        return $data;
    }

    public static function getAllData()
    {
        $data = self::find()->where(['isValid'=>GoodsModel::IS_VALID_OK])
            ->indexBy('id')->asArray()->all();
        return $data;
    }

}