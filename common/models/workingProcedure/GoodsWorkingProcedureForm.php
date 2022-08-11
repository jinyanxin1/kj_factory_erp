<?php
/**
 *
 * author: jinyanxin
 * Date: 2021/7/27
 * Time: 13:58
 * PHP version 7
 */

namespace common\models\workingProcedure;


use common\library\helper\Code;
use common\models\BaseForm;
use common\models\BaseModel;
use common\models\goods\GoodsModel;
use common\models\purchase\GoodsStockModel;
use common\models\workRecord\WorkRecordModel;
use Yii;

class GoodsWorkingProcedureForm extends GoodsWorkingProcedureModel
{

    public $relationList;//关联半成品消耗信息

    public $workingList;//同产品消耗的信息

    public $page;
    public $pageSize;

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id','goodsId', 'sort', 'price', 'consume', 'relationList', 'workingList'], 'safe'],
            [['name'], 'string', 'max' => 20],
            [['remark'],'string','max'=>500]
        ];
    }


    /*
     * 保存信息
     * 工序单价要把工单记录里面这个产品工序单价为0的更新
     * */
    public function saveInfo()
    {
        if(!$this->validate()){
            $err = current($this->getErrors());
            return ['code'=>Code::PARAM_ERR,'msg'=>$err[0]];
        }

        if($this->id > 0){
            $info  = GoodsWorkingProcedureModel::find()->where(['id'=>$this->id,'isValid'=>GoodsWorkingProcedureModel::IS_VALID_OK])->one();
            if(empty($info)){
                return ['code'=>Code::PARAM_ERR,'msg'=>'工序不存在'];
            }
        }else{
            $info = new GoodsWorkingProcedureModel();
        }

        $tran = Yii::$app->db->beginTransaction();
        try{
            //保存工序基本信息
            $info->goodsId = $this->goodsId;
            $info->name = $this->name;
            $info->price = BaseForm::amountToCent($this->price);
            $info->remark = $this->remark;
            $info->consume = $this->consume;
            $info->sort = $this->sort;
            $info->save();
            $id = $info->id;
            //将同产品消耗的工序合并到relationList中
            if(count($this->workingList) > 0){
                foreach ($this->workingList as $item) {
                    $this->relationList[] = $item;
                }
            }
            //保存消耗半成品信息
            $existConsume = GoodsWorkingProcedureConsumeModel::find()->select('id')->where(['workingId'=>$id,'isValid'=>GoodsWorkingProcedureConsumeModel::IS_VALID_OK])->asArray()->all();
            $existConsumeIds = count($existConsume) > 0 ? array_column($existConsume,'id') : [];
            if(count($this->relationList) > 0){
                $goods = GoodsModel::find()->where(['id'=>array_column($this->relationList,'goodsId'),'isValid'=>GoodsModel::IS_VALID_OK])
                    ->indexBy('id')->asArray()->all();
                foreach ($this->relationList as $item) {
                    if(isset($goods[$item['goodsId']])){
                        $consume = GoodsWorkingProcedureConsumeModel::find()->where(['workingId'=>$id,'goodsId'=>$item['goodsId'],'goodsWorkingId'=>$item['goodsWorkingId']])->one();
                        if(empty($consume)){
                            $consume = new GoodsWorkingProcedureConsumeModel();
                        }else{
                            //将存在的去掉
                            $existConsumeIds = array_diff($existConsumeIds,[$consume->id]);
                        }
                        $consume->type = $goods[$item['goodsId']]['type'] == GoodsModel::TYPE_PRODUCTION ? GoodsWorkingProcedureConsumeModel::TYPE_GOODS : GoodsWorkingProcedureConsumeModel::TYPE_MATERIAL;
                        $consume->workingId = $id;
                        $consume->goodsId = $item['goodsId'];
                        $consume->consume = $item['consume'];
                        $consume->goodsWorkingId = intval($item['goodsWorkingId']);
                        $consume->isValid = GoodsWorkingProcedureConsumeModel::IS_VALID_OK;
                        $consume->save();
                    }else{
                        throw new \Exception($item['name'].'不存在',Code::PARAM_ERR);
                    }
                }
            }

            //删除之前存在的
            if(count($existConsumeIds) > 0){
                foreach ($existConsumeIds as $existConsumeId) {
                    $delConsume = GoodsWorkingProcedureConsumeModel::find()->where(['id'=>$existConsumeId,'isValid'=>GoodsWorkingProcedureConsumeModel::IS_VALID_OK])->one();
                    if(!empty($delConsume)){
                        $delConsume->isValid = GoodsWorkingProcedureConsumeModel::IS_VALID_NO;
                        $delConsume->save();
                    }
                }
            }
            //工序单价大于0时。要把工单里面单价为0的更新
            $workRecord = WorkRecordModel::find()->where(
                ['goodsId'=>$this->goodsId,'workingId'=>$id,'isValid'=>WorkRecordModel::IS_VALID_OK]
            )->all();
            if(count($workRecord) > 0){
                foreach ($workRecord as $item) {
                    if(intval($item->price) <= 0){
                        $item->price = $info->price;
                        $item->save();
                    }
                }
            }
            $tran->commit();
        }catch (\Exception $e){
            $tran->rollBack();
            Yii::error('save goods working procedure fail---'.$e->getMessage());
            $msg = $e->getCode() === Code::PARAM_ERR ? $e->getMessage() : '保存失败';
            return ['code'=>Code::PARAM_ERR,'msg'=>$msg];
        }
        return ['code'=>Code::SUCCESS,'msg'=>'保存成功'];
    }

    /*
     * 工序详情
     * */
    public function getInfo()
    {
        $returnArr = [];
        if($this->id > 0){
            $info = GoodsWorkingProcedureModel::find()->where(['id'=>$this->id,'isValid'=>GoodsWorkingProcedureModel::IS_VALID_OK])->asArray()->one();
            if(!empty($info)){
                $goods = GoodsModel::find()->where(['id'=>$info['goodsId'],'isValid'=>GoodsModel::IS_VALID_OK])->asArray()->one();
                $returnArr['id'] = intval($info['id']);
                $returnArr['goodsId'] = intval($info['goodsId']);
                $returnArr['goodsName'] = !empty($goods) ? $goods['name'] : '';
                $returnArr['name'] = $info['name'];
                $returnArr['price'] = BaseForm::amountToYuan($info['price']);
                $returnArr['remark'] = $info['remark'];
                $returnArr['consume'] = intval($info['consume']);
                $returnArr['sort'] = intval($info['sort']);
                //关联同产品的工序
                $workingList = [];
                //关联半产品
                $relationList = [];
                $consumeList = GoodsWorkingProcedureConsumeModel::find()->where(['workingId'=>$info['id'],'isValid'=>GoodsWorkingProcedureConsumeModel::IS_VALID_OK])->asArray()->all();
                if(count($consumeList) > 0){
                    $goodsWorkList = GoodsWorkingProcedureModel::find()
                        ->where(['id'=>array_column($consumeList,'goodsWorkingId'),'isValid'=>GoodsWorkingProcedureModel::IS_VALID_OK])->indexBy('id')->asArray()->all();
                    $goodsList = GoodsModel::find()->where(['id'=>array_column($consumeList,'goodsId'),'isValid'=>GoodsModel::IS_VALID_OK])
                        ->indexBy('id')->asArray()->all();
                    foreach ($consumeList as $item) {
                        if(isset($goodsList[$item['goodsId']]) && intval($item['goodsWorkingId']) > 0){
                            $goodsInfo = $goodsList[$item['goodsId']];
                            $val = [
                                'id'=>intval($item['id']),
                                'goodsId'=>intval($goodsInfo['id']),
                                'workingId'=>intval($this->id),
                                'goodsWorkingId'=>intval($item['goodsWorkingId']),
                                'workingName'=>isset($goodsWorkList[$item['goodsWorkingId']]) ? $goodsWorkList[$item['goodsWorkingId']]['name'] : '',
                                'name'=>$goodsInfo['name'],
                                'unit'=>$goodsInfo['unit'],
                                'consume'=>intval($item['consume'])
                            ];
                            if(intval($info['goodsId']) == intval($item['goodsId'])){
                                $val['status'] = 1;
                                $workingList[] = $val;
                            }else{
                                $relationList[] = $val;
                            }
                        }
                    }
                }
                $returnArr['relationList'] = $relationList;
                $returnArr['workingList'] = $workingList;
            }
        }
        return $returnArr;
    }

    /*
     * 删除某道工序
     * */
    public function del()
    {
        $tran = Yii::$app->db->beginTransaction();
        try{
            if($this->id > 0){
                $info = GoodsWorkingProcedureModel::find()->where(['id'=>$this->id,'isValid'=>GoodsWorkingProcedureModel::IS_VALID_OK])->one();
                if(!empty($info)){
                    $info->isValid = GoodsWorkingProcedureModel::IS_VALID_NO;
                    $info->save();
                    //删除关联消耗半成品
                    $consumeList = GoodsWorkingProcedureConsumeModel::find()->where(['workingId'=>$this->id,'isValid'=>GoodsWorkingProcedureConsumeModel::IS_VALID_OK])->all();
                    if(count($consumeList) > 0){
                        foreach ($consumeList as $item) {
                            $item->isValid = GoodsWorkingProcedureConsumeModel::IS_VALID_NO;
                            $item->save();
                        }
                    }
                }
            }
            $tran->commit();
        }catch (\Exception $e){
            $tran->rollBack();
            Yii::error('del working procedure fail---'.$e->getMessage());
            return ['code'=>Code::PARAM_ERR,'msg'=>'删除失败'];
        }
        return ['code'=>Code::SUCCESS,'msg'=>'删除成功'];
    }


    /*
     * 列表
     * */
    public function getData()
    {
        $model = GoodsWorkingProcedureModel::find()->where(['goodsId'=>$this->goodsId,'isValid'=>GoodsWorkingProcedureModel::IS_VALID_OK]);
        $count = $model->count();
        if($this->page > 0 && $this->pageSize > 0){
            $model->offset(($this->page - 1) * $this->pageSize)->limit($this->pageSize);
        }
        $data = $model->orderBy('sort asc')->asArray()->all();
        return ['count'=>$count,'data'=>$data];
    }

    /*
     * 格式化数据
     * */
    public function formatData($data)
    {
        $returnArr = [];
        if(count($data) > 0){
            $relationList = [];
            $consumeList = GoodsWorkingProcedureConsumeModel::find()->where(['workingId'=>array_column($data,'id'),'isValid'=>GoodsWorkingProcedureConsumeModel::IS_VALID_OK])->asArray()->all();
            $stockList = GoodsStockModel::find()->where(['wareHouseId'=>BaseModel::HOUSE_ID,'isValid'=>GoodsStockModel::IS_VALID_OK])->asArray()->all();
            $stock = [];
            if(count($stockList) > 0){
                foreach ($stockList as $item) {
                    $stock[$item['goodsId'].'-'.$item['workingId']] = $item['num'];
                }
            }
            if(count($consumeList) > 0){
                $consumeGoods = GoodsModel::find()->where(['id'=>array_unique(array_column($consumeList,'goodsId')),'isValid'=>GoodsModel::IS_VALID_OK])
                    ->indexBy('id')->asArray()->all();
                foreach ($consumeList as $item) {
                    if(isset($consumeGoods[$item['goodsId']])){
                        $relationList[$item['workingId']][] = $consumeGoods[$item['goodsId']]['name'].'：'.$item['consume'];
                    }
                }
            }
            foreach ($data as $datum) {
                $consume = ['消耗上道工序：'.$datum['consume']];
                if(isset($relationList[$datum['id']])){
                    $consume = array_merge($consume,$relationList[$datum['id']]);
                }
                $key = $datum['goodsId'].'-'.$datum['id'];
                $returnArr[] = [
                    'id'=>intval($datum['id']),
                    'sort'=>intval($datum['sort']),
                    'name'=>$datum['name'],
                    'price'=>BaseForm::amountToYuan($datum['price']),
                    'consume'=>$consume,
                    'stock'=>isset($stock[$key]) ? $stock[$key] : 0,
                ];
            }
        }
        return $returnArr;
    }

}