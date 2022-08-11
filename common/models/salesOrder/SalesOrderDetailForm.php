<?php
/**
 *
 * author: jinyanxin
 * Date: 2020/9/4
 * Time: 14:15
 * PHP version 7
 */

namespace common\models\salesOrder;


use common\library\helper\Code;
use common\models\goods\GoodsMaterialModel;
use common\models\goods\GoodsModel;
use common\models\workingProcedure\GoodsWorkingProcedureConsumeModel;
use common\models\workingProcedure\GoodsWorkingProcedureModel;
use Yii;

class SalesOrderDetailForm extends SalesOrderDetailModel
{

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id','orderId', 'goodsId', 'workingId', 'num', 'deliveryNum','price','isTax','taxPrice'], 'safe'],
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
            $info = SalesOrderDetailModel::getById($this->id,false);
            if(empty($info)){
                Yii::info('save sales order detail fail error msg：not exist id-'.$this->id,'salesOrder');
                return ['code'=>Code::PARAM_ERR,'msg'=>'详情数据不存在'];
            }
        }else{
            $info = SalesOrderDetailModel::find()->where(['orderId'=>$this->orderId,'goodsId'=>$this->goodsId,'workingId'=>$this->workingId,'isValid'=>SalesOrderDetailModel::IS_VALID_OK])->one();
            if(empty($info)){
                $info = new SalesOrderDetailModel();
            }
        }
        $info->orderId = $this->orderId;
        $info->goodsId = $this->goodsId;
        $info->workingId = $this->workingId;
        $info->price = self::amountToCent($this->price);
        $info->isTax = $this->isTax;
        $info->taxPrice = self::amountToCent($this->taxPrice);
        $info->num = $this->num;
        if(!$info->save()){
            return ['code'=>Code::PARAM_ERR,'msg'=>'详情保存失败'];
        }
        return ['code'=>Code::SUCCESS,'msg'=>'详情保存成功'];
    }

    //根据订单id获取订单中的物料详情
    public function getMaterial()
    {
        if($this->orderId <= 0){
            return ['code'=>Code::PARAM_ERR,'msg'=>'请选择订单','list'=>[]];
        }
        $detail = SalesOrderDetailModel::find()->where(['orderId'=>$this->orderId,'isValid'=>SalesOrderDetailModel::IS_VALID_OK])->asArray()->all();
        if(empty($detail)){
            return ['code'=>Code::PARAM_ERR,'msg'=>'订单详情不存在','list'=>[]];
        }

        $goods = GoodsModel::find()->where(['isValid'=>GoodsModel::IS_VALID_OK])->indexBy('id')->asArray()->all();
        $working = GoodsWorkingProcedureModel::find()->where(['isValid'=>GoodsWorkingProcedureModel::IS_VALID_OK])->indexBy('id')->asArray()->all();
        $materialData = [];
        foreach ($detail as $item) {
            $num = intval($item['num']);
            $consumeData = GoodsWorkingProcedureConsumeModel::find()->where(['workingId'=>$item['workingId'],'isValid'=>GoodsWorkingProcedureConsumeModel::IS_VALID_OK])->asArray()->all();
            if(count($consumeData) > 0){
                foreach ($consumeData as $consumeDatum) {
                    $goodsId = intval($consumeDatum['goodsId']);
                    $workingId = intval($consumeDatum['goodsWorkingId']);
                    $consume = intval($consumeDatum['consume']);
                    if(!isset($goods[$goodsId])){
                        continue;
                    }
                    $goodsInfo = $goods[$goodsId];
                    $workingInfo = isset($working[$workingId]) ? $working[$workingId] : [];
                    $key = $goodsId.'-'.$workingId;
                    $count = $consume * $num;
                    if(isset($materialData[$key])){
                        $materialData[$key]['count'] = $materialData[$key]['count'] + $count;
                    }else{
                        $materialData[$key] = [
                            'id'=>$goodsId,
                            'number'=>$goodsInfo['number'],
                            'name'=>$goodsInfo['name'],
                            'attr'=>$goodsInfo['attr'],
                            'weight'=>$goodsInfo['weight'],
                            'volume'=>$goodsInfo['volume'],
                            'parameter'=>$goodsInfo['parameter'],
                            'unit'=>$goodsInfo['unit'],
                            'workingName'=>!empty($workingInfo) ? $workingInfo['name'] : '',
                            'count'=>$count
                        ];
                    }
                }
            }
        }
        return ['code'=>Code::SUCCESS,'msg'=>'ok','list'=>array_values($materialData)];
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
                    'num'=>intval($info['num']),
                    'deliveryNum'=>intval($info['deliveryNum']),
                    'unit'=>$info['unit'],
                ];
            }
        }
        return $returnArr;
    }

}