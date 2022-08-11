<?php
/**
 *
 * author: jinyanxin
 * Date: 2020/9/3
 * Time: 15:14
 * PHP version 7
 */

namespace backend\models\purchaseOrder;


use common\library\helper\Code;
use common\models\goods\GoodsModel;
use common\models\purchaseOrder\PurchaseOrderDetailModel;
use Yii;

class PurchaseOrderDetailForm extends PurchaseOrderDetailModel
{
    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['orderId', 'goodsId', 'purchaseNum', 'deliveryNum'], 'integer'],
            [['id','price','totalPrice'], 'safe'],
            [['unit'], 'string', 'max' => 5],
        ];
    }


    public function saveInfo()
    {
        if(!$this->validate()){
            $firstItem = current($this->getErrors());
            return ['code'=>Code::PARAM_ERR,'msg'=>$firstItem[0]];
        }

        if($this->id > 0){
            $info = self::getById($this->id,false);
            if(empty($info)){
                Yii::info('save purchase order detail fail error msg：not exist id-'.$this->id,'purchaseOrder');
                return ['code'=>Code::PARAM_ERR,'msg'=>'详情数据不存在'];
            }
        }else{
            $info = new self();
        }
        $this->price = self::amountToCent($this->price);
        $this->totalPrice = self::amountToCent($this->totalPrice);
        $info->attributes = $this->attributes;
        if(!$info->save()){
            return ['code'=>Code::PARAM_ERR,'msg'=>'详情保存失败'];
        }
        return ['code'=>Code::SUCCESS,'msg'=>'详情保存成功'];
    }


    public function getData()
    {
        $model = self::find()->where(['isValid'=>self::IS_VALID_OK]);
        if($this->orderId > 0){
            $model->andWhere(['orderId'=>$this->orderId]);
        }
        $count = $model->count();
        $data = $model->orderBy('goodsId desc')->asArray()->all();
        return ['count'=>$count,'data'=>$data];
    }


    public function formatData($data)
    {
        $returnArr = [];
        if(count($data) > 0){
            $goods = GoodsModel::find()->select('id,name')->where(['id'=>array_column($data,'goodsId'),'isValid'=>GoodsModel::IS_VALID_OK])->indexBy('id')->asArray()->all();
            foreach($data as $info){
                $returnArr[] = [
                    'goodsId'=>intval($info['goodsId']),
                    'goodsName'=>isset($goods[$info['goodsId']]) ? $goods[$info['goodsId']]['name'] : '',
                    'purchaseNum'=>intval($info['purchaseNum']),
                    'deliveryNum'=>intval($info['deliveryNum']),
                    'unit'=>$info['unit'],
                    'price'=>self::amountToYuan(intval($info['price']))
                ];
            }
        }
        return $returnArr;
    }
}