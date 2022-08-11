<?php
/**
 *
 * author: jinyanxin
 * Date: 2020/9/7
 * Time: 9:06
 * PHP version 7
 * 产品-物料关联表
 */

namespace common\models\goods;


use common\models\BaseModel;
use Yii;


/**
 * This is the model class for table "kj_goods".
 *
 * @property int $id
 * @property int|null $goodsId 产品id
 * @property int|null $materialId 物料或半产品id
 * @property int|null $number 数量
 * @property string|null $describe 描述
 * @property string|null $creator
 * @property string|null $createTime
 * @property string|null $updater
 * @property string|null $updateTime
 * @property int|null $isValid
 */
class GoodsMaterialModel extends BaseModel
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'kj_goods_material';
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'goodsId'=>'产品id',
            'materialId' => '物料id',
            'number' => '数量',
            'describe' => '描述',
            'creator' => 'Creator',
            'createTime' => 'Create Time',
            'updater' => 'Updater',
            'updateTime' => 'Update Time',
            'isValid' => 'Is Valid',
        ];
    }


    public static function getById($id,$isArr = true)
    {
        $info = GoodsMaterialModel::find()->where(['id'=>$id,'isValid'=>GoodsMaterialModel::IS_VALID_OK]);
        if($isArr === true){
            $info->asArray();
        }
        return $info->one();
    }

    /*
     * 根据产品id得到物料信息
     * */
    public static function getByGoodsIds($goodsIds)
    {
        $returnArr = [];
        $data = GoodsMaterialModel::find()->where(['goodsId'=>$goodsIds,'isValid'=>GoodsMaterialModel::IS_VALID_OK])->asArray()->all();
        if(count($data) > 0){
            $materialIds = array_unique(array_column($data,'materialId'));
            $material = GoodsModel::find()->select('id,name,unit')->where(['id'=>$materialIds,'isValid'=>GoodsModel::IS_VALID_OK])->indexBy('id')->asArray()->all();
            foreach ($data as $datum) {
                $returnArr[$datum['goodsId']][] = [
                    'id'=>$datum['id'],
                    'goodsId'=>$datum['goodsId'],
                    'materialId'=>$datum['materialId'],
                    'num'=>$datum['number'],
                    'describe'=>$datum['describe'],
                    'name'=>isset($material[$datum['materialId']]) ? $material[$datum['materialId']]['name'] : '',
                    'unit'=>isset($material[$datum['materialId']]) ? $material[$datum['materialId']]['unit'] : '',
                ];
            }
        }
        return $returnArr;
    }

}