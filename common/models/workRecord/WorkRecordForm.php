<?php
/**
 *
 * author: jinyanxin
 * Date: 2021/7/27
 * Time: 16:09
 * PHP version 7
 */

namespace common\models\workRecord;

use common\library\helper\Code;
use common\models\BaseForm;
use common\models\BaseModel;
use common\models\goods\GoodsModel;
use common\models\purchase\consumption\GoodsConsumptionDetailModel;
use common\models\purchase\consumption\GoodsConsumptionModel;
use common\models\purchase\GoodsStockModel;
use common\models\purchase\inStorage\GoodsInStorageDetailModel;
use common\models\purchase\inStorage\GoodsInStorageModel;
use common\models\purchase\StockRecordModel;
use common\models\staffInfo\StaffInfoModel;
use common\models\workingProcedure\GoodsWorkingProcedureConsumeModel;
use common\models\workingProcedure\GoodsWorkingProcedureModel;
use Yii;

class WorkRecordForm extends WorkRecordModel
{
    public $page;
    public $pageSize;
    public $staffName;
    public $startDate;
    public $goodsName;
    public $loginUserName;//当前登录账号用户姓名

    public $goodsData;
    public $personData;
    public $orderBy = "date desc,createTime desc";
    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id','staffId', 'type', 'goodsId', 'workingId', 'amount', 'price',
                'date', 'endDate', 'goodsData', 'personData'], 'safe'],
            [['remark'], 'string', 'max' => 500],
            ['type','in','range'=>[1,2,3]]
        ];
    }

    /*
     * 工人入库
     * */
    public function saveInStorage()
    {
        if(count($this->goodsData) < 0){
            return ['code'=>Code::PARAM_ERR,'msg'=>'入库数据为空'];
        }
        $tran = Yii::$app->db->beginTransaction();
        try{
            if($this->type === WorkRecordModel::TYPE_TIME){
                //计时
                $this->saveInfo();
            }else if($this->type === WorkRecordModel::TYPE_PIECES){
                //计件
                if(count($this->goodsData) <= 0){
                    throw new \Exception('入库信息为空',Code::PARAM_ERR);
                }
                foreach ($this->goodsData as $goodsDatum) {
                    $this->id = isset($goodsDatum['id']) ? $goodsDatum['id'] : 0;
                    $this->workingId = intval($goodsDatum['workingId']);
                    if(!isset($goodsDatum['price'])){
                        $workingInfo = GoodsWorkingProcedureModel::find()->where(['id'=>$this->workingId,'goodsId'=>$this->goodsId,'isValid'=>GoodsWorkingProcedureModel::IS_VALID_OK])->asArray()->one();
                        if(empty($workingInfo)){
                            throw new \Exception('工序不存在或不匹配',Code::PARAM_ERR);
                        }
                        $this->price = BaseForm::amountToYuan($workingInfo['price']);
                    }else{
                        $this->price = $goodsDatum['price'];
                    }
                    $this->amount = $goodsDatum['amount'];
                    $this->saveInfo();
                }
            }else if($this->type === WorkRecordModel::TYPE_XIUXI){
                //休息
                if(count($this->personData) < 0){
                    throw new \Exception('工人为空',Code::PARAM_ERR);
                }
                foreach ($this->personData as $personDatum) {
                    $this->staffId = intval($personDatum);
                    $this->goodsId = 0;
                    $this->workingId = 0;
                    $this->price = 0;
                    $this->saveInfo();
                    $this->id = 0;
                }
            }else{
                throw new \Exception('类型错误',Code::PARAM_ERR);
            }

            $tran->commit();
        }catch (\Exception $e){
            $tran->rollBack();
            Yii::error('work record save in storage fail--'.$e->getMessage().'----file--'.$e->getFile().'---line---'.$e->getLine());
            $msg = $e->getCode() == Code::PARAM_ERR ? $e->getMessage() : '入库失败';
            return ['code'=>Code::PARAM_ERR,'msg'=>$msg];
        }
        return ['code'=>Code::SUCCESS,'msg'=>'入库成功'];
    }

    /*
     * 保存工单信息
     * 1 保存工单记录
     * 2 入库操作，需确认操作流程
     * 入库：
     *      产品在这道工序的库存增加，更改库存kj_goods_stock，增加入库记录：kj_goods_in_storage,kj_goods_in_storage_detail,kj_goods_stock_record
     *      这道工序的上道工序消耗量，库存减少,，更改库存kj_goods_stock，增加消耗记录：kj_goods_production_consumption,kj_goods_production_consumption_detail,kj_goods_stock_record
     *      关联的物料库存减少
     *      关联的半产品库存减少
     * */
    public function saveInfo()
    {
        if(!$this->validate()){
            $err = current($this->getErrors());
            throw new \Exception($err[0],Code::PARAM_ERR);
        }
        if($this->id > 0){
            $info = WorkRecordModel::find()->where(['id'=>$this->id,'isValid'=>WorkRecordModel::IS_VALID_OK])->one();
            if(empty($info)){
                throw new \Exception('工单记录不存在',Code::PARAM_ERR);
            }
            $oldAmount = $info->amount;
            //编辑时，判断产品，工序是否改变
            if($this->type == WorkRecordModel::TYPE_PIECES){
                if(intval($info->goodsId) !== intval($this->goodsId) || intval($info->workingId) !== intval($this->workingId)){
                    $oldAmount = 0;
                    //这个工单的产品和工序变了
                    $houseId = BaseModel::HOUSE_ID;
                    $amount = intval($info->amount);
                    $goodsId = intval($info->goodsId);
                    $workingId = intval($info->workingId);
                    // 库存更新
                    $goodsStock = GoodsStockModel::find()->where(['goodsId'=>$goodsId,'workingId'=>$workingId,'wareHouseId'=>$houseId,'isValid'=>GoodsStockModel::IS_VALID_OK])->one();
                    if(!empty($goodsStock)){
                        $num = $goodsStock->num - $amount;
                        $goodsStock->num = $num;
                        $goodsStock->save();
                    }
                    $inStorage = GoodsInStorageModel::find()->where(['workId'=>$this->id,'houseId'=>$houseId,'isValid'=>GoodsInStorageModel::IS_VALID_OK])->one();
                    if(!empty($inStorage)){
                        $inStorage->isValid = GoodsInStorageModel::IS_VALID_NO;
                        $inStorage->save();
                        $inStorageDetail = GoodsInStorageDetailModel::find()->where(['storageId'=>$inStorage->storageId,'isValid'=>GoodsInStorageDetailModel::IS_VALID_OK])->all();
                        if(count($inStorageDetail) > 0){
                            foreach ($inStorageDetail as $item) {
                                $item->isValid = GoodsInStorageDetailModel::IS_VALID_NO;
                                $item->save();
                            }
                        }
                        $stockRecord = StockRecordModel::find()
                            ->where(['unionId'=>$inStorage->storageId,'type'=>StockRecordModel::TYPE_IN_STORAGE,'isValid'=>StockRecordModel::IS_VALID_OK])->all();
                        if(count($stockRecord) > 0){
                            foreach ($stockRecord as $item) {
                                $item->isValid = GoodsInStorageDetailModel::IS_VALID_NO;
                                $item->save();
                            }
                        }
                        $inStorageid = $inStorage->storageId;
                        //获取生产入库消耗，库存增加
                        $consumption = GoodsConsumptionModel::find()->where(['storageId'=>$inStorageid,'isValid'=>GoodsConsumptionModel::IS_VALID_OK])->one();
                        if(!empty($consumption)){
                            $consumption->isValid = GoodsConsumptionModel::IS_VALID_NO;
                            $consumption->save();
                            $consumptionId = $consumption->consumptionId;
                            //流水记录删除
                            $record = StockRecordModel::find()
                                ->where(['unionId'=>$consumptionId,'type'=>StockRecordModel::TYPE_CONSUMPTION,'isValid'=>StockRecordModel::IS_VALID_OK])->all();
                            if(count($record) > 0){
                                foreach ($record as $item) {
                                    $item->isValid = StockRecordModel::IS_VALID_NO;
                                    $item->save();
                                }
                            }
                            //删除入库消耗详情记录，并且更新库存
                            $detail = GoodsConsumptionDetailModel::find()->where(['consumptionId'=>$consumptionId,'isValid'=>GoodsConsumptionDetailModel::IS_VALID_OK])->all();
                            if(count($detail) > 0){
                                foreach ($detail as $item) {
                                    $item->isValid = GoodsConsumptionDetailModel::IS_VALID_NO;
                                    $item->save();
                                    //更新库存
                                    if($item->goodsType = GoodsModel::TYPE_PRODUCTION){
                                        //产品回滚，物料不会滚
                                        $goodsStock = GoodsStockModel::find()
                                            ->where(['goodsId'=>$item->goodsId, 'workingId'=>$item->workingId, 'wareHouseId'=>$houseId, 'isValid'=>GoodsStockModel::IS_VALID_OK])
                                            ->one();
                                        if(!empty($goodsStock)){
                                            $goodsStock->num = $goodsStock->num + $item->num;
                                            $goodsStock->save();
                                        }
                                    }
                                }
                            }
                        }
                    }
                }
            }
        }else{
            $info = new WorkRecordModel();
            $oldAmount = 0;
        }
        //保存工单信息
        $info->type = intval($this->type);
        $info->staffId = intval($this->staffId);
        $info->date = date('Y-m-d',strtotime($this->date));
        $info->endDate = date('Y-m-d',strtotime($this->endDate));
        $info->goodsId = intval($this->goodsId);
        $info->workingId = intval($this->workingId);
        $info->amount = $this->amount;
        $info->price = BaseForm::amountToCent($this->price);
        $info->remark = $this->remark;
        $info->save();
        $this->id = $info->id;
        //计件类型时： 入库操作流程，更改库存
        if($this->type == WorkRecordModel::TYPE_PIECES){
            $houseId = BaseModel::HOUSE_ID;
            //计件操作时，要修改库存
            $amount = $this->amount;
            //1 该道工序生产出的产品入库增加，增加入库记录
            $procedureStock = GoodsStockModel::find()
                ->where(['goodsId'=>$this->goodsId, 'workingId'=>$this->workingId, 'wareHouseId'=>$houseId, 'isValid'=>GoodsStockModel::IS_VALID_OK])
                ->one();
            if(empty($procedureStock)){
                $procedureStock = new GoodsStockModel();
                $stock = 0;
            }else{
                $stock = $procedureStock->num;
            }
            $stock = $stock + $amount -$oldAmount;
            if($stock < 0){
                //                    throw  new \Exception('库存不够',Code::PARAM_ERR);
            }
            $procedureStock->goodsId = intval($this->goodsId);
            $procedureStock->workingId = intval($this->workingId);
            $procedureStock->wareHouseId = $houseId;
            $procedureStock->num = $stock;
            $procedureStock->save();
            //增加入库记录，主表kj_goods_in_storage；副表kj_goods_in_storage_detail；流水表kj_goods_stock_record
            $inStorage = GoodsInStorageModel::find()->where(['houseId'=>$houseId,'workId'=>$this->id,'isValid'=>GoodsInStorageModel::IS_VALID_OK])->one();
            if(empty($inStorage)){
                $inStorage = new GoodsInStorageModel();
                $inStorage->sn = GoodsInStorageModel::getNumber(GoodsInStorageModel::SN_PRIX);
            }
            $inStorage->workId = $this->id;
            $inStorage->goodsType = GoodsModel::TYPE_PRODUCTION;
            $inStorage->houseId = $houseId;
            $inStorage->storageDate = $this->date;
            $inStorage->totalAmount = 0;
            $inStorage->remark = '工单记录生产入库';
            $inStorage->userName = $this->loginUserName;
            $inStorage->supplier = 0;
            $inStorage->staffId = $this->staffId;
            $inStorage->save();
            $inStorageId = $inStorage->storageId;
            $inStorageDetail = GoodsInStorageDetailModel::find()->where(['storageId'=>$inStorageId,'isValid'=>GoodsInStorageDetailModel::IS_VALID_OK])->one();
            if(empty($inStorageDetail)){
                $inStorageDetail = new GoodsInStorageDetailModel();
            }
            $inStorageDetail->workId = $this->id;
            $inStorageDetail->goodsType = GoodsModel::TYPE_PRODUCTION;
            $inStorageDetail->storageId = $inStorageId;
            $inStorageDetail->goodsId = $this->goodsId;
            $inStorageDetail->workingId = $this->workingId;
            $inStorageDetail->num = $amount;
            $inStorageDetail->price = 0;
            $inStorageDetail->save();
            $stockRecord = StockRecordModel::find()
                ->where(['goodsId'=>$this->goodsId,'workingId'=>$this->workingId,'unionId'=>$inStorageId])
                ->andWhere(['type'=>StockRecordModel::TYPE_IN_STORAGE,'isValid'=>StockRecordModel::IS_VALID_OK])
                ->one();
            if(empty($stockRecord)){
                $stockRecord = new StockRecordModel();
            }
            $stockRecord->goodsType = GoodsModel::TYPE_PRODUCTION;
            $stockRecord->wareHouseId = $houseId;
            $stockRecord->goodsId = $this->goodsId;
            $stockRecord->workingId = $this->workingId;
            $stockRecord->num = $amount;
            $stockRecord->price = 0;
            $stockRecord->type = StockRecordModel::TYPE_IN_STORAGE;
            $stockRecord->unionId = $inStorageId;
            $stockRecord->remark = '工单记录生产入库';
            $stockRecord->userName = $this->loginUserName;
            $stockRecord->date = $this->date;
            $stockRecord->save();

            $workingInfo = GoodsWorkingProcedureModel::find()->where(['id'=>$this->workingId,'goodsId'=>$this->goodsId,'isValid'=>GoodsWorkingProcedureModel::IS_VALID_OK])
                ->asArray()->one();
            if(empty($workingInfo)){
                throw new \Exception('工序不存在或与产品不匹配',Code::PARAM_ERR);
            }
            //2 这道工序消耗的上道工序生产的产品库存减少
            $lastWorkingInfo = GoodsWorkingProcedureModel::find()->where(['goodsId'=>$this->goodsId,'isValid'=>GoodsWorkingProcedureModel::IS_VALID_OK])
                ->andWhere(['<','sort',$workingInfo['sort']])->orderBy('sort desc')->asArray()->one();
            if(!empty($lastWorkingInfo)){
                $lastProcedureStock = GoodsStockModel::find()
                    ->where(['goodsId'=>$this->goodsId, 'workingId'=>$lastWorkingInfo['id'], 'wareHouseId'=>$houseId, 'isValid'=>GoodsStockModel::IS_VALID_OK])
                    ->one();
                if(empty($lastProcedureStock)){
                    $lastProcedureStock = new GoodsStockModel();
                    $lastStock = 0;
                }else{
                    $lastStock = $lastProcedureStock['num'];
                }
                $lastStock = $lastStock - ($amount - $oldAmount) * $workingInfo['consume'];
                if($lastStock < 0){

                }
                $lastProcedureStock->goodsId = $this->goodsId;
                $lastProcedureStock->workingId = $lastWorkingInfo['id'];
                $lastProcedureStock->wareHouseId = $houseId;
                $lastProcedureStock->num = $lastStock;
                $lastProcedureStock->save();
                //增加消耗记录，kj_goods_production_consumption,kj_goods_production_consumption_detail,kj_goods_stock
                $consumption = GoodsConsumptionModel::find()->where(['storageId'=>$inStorageId,'isValid'=>GoodsConsumptionModel::IS_VALID_OK])->one();
                if(empty($consumption)){
                    $consumption = new GoodsConsumptionModel();
                    $consumption->sn = GoodsConsumptionModel::getNumber(GoodsConsumptionModel::SN_PRIX);
                }
                $consumption->goodsType = GoodsModel::TYPE_ALL;
                $consumption->houseId = $houseId;
                $consumption->consumptionDate = $this->date;
                $consumption->totalAmount = 0;
                $consumption->remark = '工单记录生产消耗';
                $consumption->userName = $this->loginUserName;
                $consumption->supplier = 0;
                $consumption->staffId = $this->staffId;
                $consumption->storageId = $inStorageId;
                $consumption->save();
                $consumptionId = $consumption->consumptionId;
                $consumptionDetail = GoodsConsumptionDetailModel::find()->where(['consumptionId'=>$consumptionId,'goodsId'=>$this->goodsId,'workingId'=> $lastWorkingInfo['id'],'isValid'=>GoodsConsumptionDetailModel::IS_VALID_OK])->one();
                if(empty($consumptionDetail)){
                    $consumptionDetail = new GoodsConsumptionDetailModel();
                }
                $consumptionDetail->goodsType = GoodsModel::TYPE_PRODUCTION;
                $consumptionDetail->consumptionId = $consumptionId;
                $consumptionDetail->goodsId = $this->goodsId;
                $consumptionDetail->workingId = $lastWorkingInfo['id'];
                $consumptionDetail->num = $amount * $workingInfo['consume'];
                $consumptionDetail->price = 0;
                $consumptionDetail->save();
                $stockRecord = StockRecordModel::find()
                    ->where(['goodsId'=>$this->goodsId,'workingId'=>$lastWorkingInfo['id'],'unionId'=>$consumptionId])
                    ->andWhere(['type'=>StockRecordModel::TYPE_CONSUMPTION,'isValid'=>StockRecordModel::IS_VALID_OK])
                    ->one();
                if(empty($stockRecord)){
                    $stockRecord = new StockRecordModel();
                }
                $stockRecord->goodsType = GoodsModel::TYPE_PRODUCTION;
                $stockRecord->wareHouseId = $houseId;
                $stockRecord->goodsId = $this->goodsId;
                $stockRecord->workingId = $lastWorkingInfo['id'];
                $stockRecord->num = $amount * $workingInfo['consume'];
                $stockRecord->price = 0;
                $stockRecord->type = StockRecordModel::TYPE_CONSUMPTION;
                $stockRecord->unionId = $consumptionId;
                $stockRecord->remark = '工单记录生产消耗';
                $stockRecord->userName = $this->loginUserName;
                $stockRecord->date = $this->date;
                $stockRecord->save();
            }
            //这道工序消耗的产品或物料减少
            $procedureConsume = GoodsWorkingProcedureConsumeModel::find()->where(['workingId'=>$this->workingId,'isValid'=>GoodsWorkingProcedureConsumeModel::IS_VALID_OK])->asArray()->all();
            if(count($procedureConsume) > 0){
                //同一条生产入库消耗记录
                $consumption = GoodsConsumptionModel::find()->where(['storageId'=>$inStorageId,'isValid'=>GoodsConsumptionModel::IS_VALID_OK])->one();
                if(empty($consumption)){
                    $consumption = new GoodsConsumptionModel();
                    $consumption->sn = GoodsConsumptionModel::getNumber(GoodsConsumptionModel::SN_PRIX);
                }
                $consumption->goodsType = GoodsModel::TYPE_ALL;
                $consumption->houseId = $houseId;
                $consumption->consumptionDate = $this->date;
                $consumption->totalAmount = 0;
                $consumption->remark = '工单记录生产消耗';
                $consumption->userName = $this->loginUserName;
                $consumption->supplier = 0;
                $consumption->staffId = $this->staffId;
                $consumption->storageId = $inStorageId;
                $consumption->save();
                $consumptionId = $consumption->consumptionId;
                foreach ($procedureConsume as $item) {
                    //物料消耗，更新库存kj_goods_stock,kj_goods_production_consumption,kj_goods_production_consumption_detail,kj_stock_record
                    $goodsId = intval($item['goodsId']);
                    $goodsWorkingId = intval($item['goodsWorkingId']);
                    if($item['type'] == GoodsWorkingProcedureConsumeModel::TYPE_MATERIAL){
                        $goodsType = GoodsModel::TYPE_MATERIEL;
                    }else if($item['type'] == GoodsWorkingProcedureConsumeModel::TYPE_GOODS){
                        //产品
                        $goodsType = GoodsModel::TYPE_PRODUCTION;
                    }else{
                        throw new \Exception('关联消耗产品类型错误',Code::PARAM_ERR);
                    }
                    $goodsStock = GoodsStockModel::find()->where(['goodsId'=>$goodsId,'workingId'=>$goodsWorkingId,'wareHouseId'=>$houseId,'isValid'=>GoodsStockModel::IS_VALID_OK])->one();
                    if(empty($goodsStock)){
                        $goodsStock = new GoodsStockModel();
                        $num = 0;
                    }else{
                        $num = $goodsStock->num;
                    }
                    $num = $num - ($amount - $oldAmount) * $item['consume'];
                    if($num < 0){

                    }
                    $goodsStock->goodsId = $goodsId;
                    $goodsStock->workingId = $goodsWorkingId;
                    $goodsStock->wareHouseId = $houseId;
                    $goodsStock->num = $num;
                    $goodsStock->save();
                    //保存生产入库消耗详情
                    $consumptionDetail = GoodsConsumptionDetailModel::find()
                        ->where(['consumptionId'=>$consumptionId,'goodsId'=>$goodsId,'workingId'=>$goodsWorkingId,'isValid'=>GoodsConsumptionDetailModel::IS_VALID_OK])->one();
                    if(empty($consumptionDetail)){
                        $consumptionDetail = new GoodsConsumptionDetailModel();
                    }
                    $consumptionDetail->goodsType = $goodsType;
                    $consumptionDetail->consumptionId = $consumptionId;
                    $consumptionDetail->goodsId = $goodsId;
                    $consumptionDetail->workingId = $goodsWorkingId;
                    $consumptionDetail->num = $amount * $item['consume'];
                    $consumptionDetail->price = 0;
                    $consumptionDetail->save();
                    $stockRecord = StockRecordModel::find()
                        ->where(['goodsId'=>$goodsId,'workingId'=>0,'unionId'=>$consumptionId])
                        ->andWhere(['type'=>StockRecordModel::TYPE_CONSUMPTION,'isValid'=>StockRecordModel::IS_VALID_OK])
                        ->one();
                    if(empty($stockRecord)){
                        $stockRecord = new StockRecordModel();
                    }
                    $stockRecord->goodsType =$goodsType;
                    $stockRecord->wareHouseId = $houseId;
                    $stockRecord->goodsId = $goodsId;
                    $stockRecord->workingId = $goodsWorkingId;
                    $stockRecord->num = $amount * $item['consume'];
                    $stockRecord->price = 0;
                    $stockRecord->type = StockRecordModel::TYPE_CONSUMPTION;
                    $stockRecord->unionId = $consumptionId;
                    $stockRecord->remark = '工单记录生产消耗';
                    $stockRecord->userName = $this->loginUserName;
                    $stockRecord->date = $this->date;
                    $stockRecord->save();
                }
            }
        }
        return true;
    }


    /*
     * 获取列表数据
     * */
    public function getData()
    {
        $model = WorkRecordModel::find()->where(['isValid'=>WorkRecordModel::IS_VALID_OK]);
        if(!empty($this->staffName)){
            $staff = StaffInfoModel::find()->select('staffId')->where(['isValid'=>StaffInfoModel::IS_VALID_OK])
                ->andWhere(['like','name',$this->staffName])->asArray()->all();
            $staffIds = count($staff) > 0 ? array_column($staff,'staffId') : [-1];
            $model->andWhere(['staffId'=>$staffIds]);
        }
        if(!empty($this->startDate) && !empty($this->endDate)){
            $model->andWhere(['between','date',
                date('Y-m-d',strtotime($this->startDate)),
                date('Y-m-d',strtotime($this->endDate)),
                ]);
        }
        if(!empty($this->goodsName)){
            $goods = GoodsModel::find()->select('id')->where(['isValid'=>GoodsModel::IS_VALID_OK])
                ->andWhere(['like','name',$this->goodsName])->asArray()->all();
            $goodsIds = count($goods) > 0 ? array_column($goods,'id') : [-1];
            $model->andWhere(['goodsId'=>$goodsIds]);
        }
        if($this->type > 0){
            $model->andWhere(['type'=>$this->type]);
        }
        $count = $model->count();
        if($this->page > 0 && $this->pageSize > 0){
            $model->offset(($this->page - 1) * $this->pageSize)->limit($this->pageSize);
        }
        $data = $model->orderBy($this->orderBy)->asArray()->all();
        return ['count'=>$count,'data'=>$data];
    }


    /*
     * 格式数据
     * */
    public function formatData($data)
    {
        $returnArr = [];
        if(count($data) > 0){
            $staff = StaffInfoModel::find()->where(['staffId'=>array_unique(array_column($data,'staffId')),'isValid'=>StaffInfoModel::IS_VALID_OK])
                ->indexBy('staffId')->asArray()->all();
            $goods = GoodsModel::find()->where(['id'=>array_unique(array_column($data,'goodsId')),'isValid'=>GoodsModel::IS_VALID_OK])
                ->indexBy('id')->asArray()->all();
            $working = GoodsWorkingProcedureModel::find()->where(['id'=>array_unique(array_column($data,'workingId')),'isValid'=>GoodsWorkingProcedureModel::IS_VALID_OK])
                ->indexBy('id')->asArray()->all();
            $typeList = WorkRecordModel::$typeList;
            foreach ($data as $datum) {
                if($datum['type'] == WorkRecordModel::TYPE_XIUXI){
                    $datum['date'] = $datum['date'].'~'.$datum['endDate'];
                }
                $returnArr[] = [
                    'id'=>intval($datum['id']),
                    'date'=>$datum['date'],
                    'staffId'=>intval($datum['staffId']),
                    'staffName'=>isset($staff[$datum['staffId']]) ? $staff[$datum['staffId']]['name'] : '',
                    'goodsName'=>isset($goods[$datum['goodsId']]) ? $goods[$datum['goodsId']]['name'] : '',
                    'workingName'=>isset($working[$datum['workingId']]) ? $working[$datum['workingId']]['name'] : '',
                    'amount'=> $datum['amount'],
                    'goodsUnit'=>isset($goods[$datum['goodsId']]) ? $goods[$datum['goodsId']]['unit'] : '',
                    'price'=>BaseForm::amountToYuan($datum['price']),
                    'total'=>BaseForm::amountToYuan($datum['price'] * $datum['amount']),
                    'type'=>intval($datum['type']),
                    'typeName'=>isset($typeList[$datum['type']]) ? $typeList[$datum['type']] : '',
                    'remark'=>$datum['remark']
                ];
            }
        }
        return $returnArr;
    }


    /*
     * 格式化导出数据
     * */
    public function formatExport($data)
    {
        $returnArr = [];
        if(count($data) > 0){
            $staff = StaffInfoModel::find()->where(['staffId'=>array_unique(array_column($data,'staffId')),'isValid'=>StaffInfoModel::IS_VALID_OK])
                ->indexBy('staffId')->asArray()->all();
            $goods = GoodsModel::find()->where(['id'=>array_unique(array_column($data,'goodsId')),'isValid'=>GoodsModel::IS_VALID_OK])
                ->indexBy('id')->asArray()->all();
            $working = GoodsWorkingProcedureModel::find()->where(['id'=>array_unique(array_column($data,'workingId')),'isValid'=>GoodsWorkingProcedureModel::IS_VALID_OK])
                ->indexBy('id')->asArray()->all();
            $typeList = WorkRecordModel::$typeList;
            foreach ($data as $datum) {
                if($datum['type'] == WorkRecordModel::TYPE_TIME){
                    $unit = '时';
                }else if($datum['type'] == WorkRecordModel::TYPE_XIUXI){
                    $unit = '天';
                    $datum['date'] = $datum['date'].'~'.$datum['endDate'];
                }else{
                    $unit =  isset($goods[$datum['goodsId']]) ? $goods[$datum['goodsId']]['unit'] : '';
                }
                //工单日期，员工姓名，产品名称，工序，数量，单位，工价，合计，类型，备注
                $returnArr[] = [
                    $datum['date'],
                    isset($staff[$datum['staffId']]) ? $staff[$datum['staffId']]['name'] : '',
                    isset($goods[$datum['goodsId']]) ? $goods[$datum['goodsId']]['name'] : '',
                    isset($working[$datum['workingId']]) ? $working[$datum['workingId']]['name'] : '',
                    $datum['amount'],
                    $unit,
                    BaseForm::amountToYuan($datum['price']),
                    BaseForm::amountToYuan($datum['price'] * $datum['amount']),
                    isset($typeList[$datum['type']]) ? $typeList[$datum['type']] : '',
                    $datum['remark']
                ];
            }
        }
        return $returnArr;
    }


    /*
     * 详情
     * */
    public function getInfo()
    {
        $returnArr = [];
        if($this->id > 0){
            $info = WorkRecordModel::find()->where(['id'=>$this->id,'isValid'=>WorkRecordModel::IS_VALID_OK])->asArray()->one();
            if(!empty($info)){
                $staff = StaffInfoModel::find()->where(['staffId'=>$info['staffId'],'isValid'=>StaffInfoModel::IS_VALID_OK])->asArray()->one();
                $goods = GoodsModel::find()->where(['id'=>$info['goodsId'],'isValid'=>GoodsModel::IS_VALID_OK])->asArray()->one();
                $returnArr = [
                    'id'=>intval($info['id']),
                    'type'=>intval($info['type']),
                    'date'=>$info['date'],
                    'endDate'=>$info['endDate'],
                    'staffId'=>$info['staffId'],
                    'staffName'=>!empty($staff) ? $staff['name'] : '',
                    'goodsId'=>intval($info['goodsId']),
                    'goodsName'=>!empty($goods) ? $goods['name'] : '',
                    'workingId'=>intval($info['workingId']),
                    'workingName'=>'',
                    'goodsUnit'=>!empty($goods) ? $goods['unit'] : '',
                    'amount'=>$info['amount'],
                    'price'=>BaseForm::amountToYuan($info['price']),
                    'total'=>BaseForm::amountToYuan($info['amount'] * $info['price']),
                    'remark'=>$info['remark']
                ];
                if($info['workingId'] > 0){
                    $workingInfo = GoodsWorkingProcedureModel::find()->where(['id'=>$info['workingId'],'isValid'=>GoodsWorkingProcedureModel::IS_VALID_OK])->asArray()->one();
                    if(!empty($workingInfo)){
                        $returnArr['workingName'] = $workingInfo['name'];
                    }
                }
            }
        }
        return $returnArr;
    }


    /*
     * 删除
     * 1 删除工单记录
     * 2 库存调整；流程需确认
     * 该产品的这道工序的库存减少  kj_goods_stock更新库存，入库记录删除：kj_goods_in_storage,kj_goods_in_storage_detail,kj_goods_stock_record
     * 这道工序消耗的上道工序产品数量库存增加 kj_goods_stock 库存更新，删除消耗记录：kj_goods_production_consumption,kj_goods_production_consumption_detail,kj_goods_stock_record
     * 关联的产品，物料库存增加
     * */
    public function del()
    {
        $tran = Yii::$app->db->beginTransaction();
        try{
            if($this->id > 0){
                $info = WorkRecordModel::find()->where(['id'=>$this->id,'isValid'=>WorkRecordModel::IS_VALID_OK])->one();
                if(!empty($info)){
                    $info->isValid = WorkRecordModel::IS_VALID_NO;
                    $info->save();
                    //计件类型时，库存更新
                    if($info->type == WorkRecordModel::TYPE_PIECES){
                        $houseId = BaseModel::HOUSE_ID;
                        $amount = intval($info->amount);
                        $goodsId = intval($info->goodsId);
                        $workingId = intval($info->workingId);
                        // 库存更新
                        $goodsStock = GoodsStockModel::find()->where(['goodsId'=>$goodsId,'workingId'=>$workingId,'wareHouseId'=>$houseId,'isValid'=>GoodsStockModel::IS_VALID_OK])->one();
                        if(!empty($goodsStock)){
                            $num = $goodsStock->num - $amount;
                            $goodsStock->num = $num;
                            $goodsStock->save();
                        }
                        $inStorage = GoodsInStorageModel::find()->where(['workId'=>$this->id,'houseId'=>$houseId,'isValid'=>GoodsInStorageModel::IS_VALID_OK])->one();
                        if(!empty($inStorage)){
                            $inStorage->isValid = GoodsInStorageModel::IS_VALID_NO;
                            $inStorage->save();
                            $inStorageDetail = GoodsInStorageDetailModel::find()->where(['storageId'=>$inStorage->storageId,'isValid'=>GoodsInStorageDetailModel::IS_VALID_OK])->all();
                            if(count($inStorageDetail) > 0){
                                foreach ($inStorageDetail as $item) {
                                    $item->isValid = GoodsInStorageDetailModel::IS_VALID_NO;
                                    $item->save();
                                }
                            }
                            $stockRecord = StockRecordModel::find()
                                ->where(['unionId'=>$inStorage->storageId,'type'=>StockRecordModel::TYPE_IN_STORAGE,'isValid'=>StockRecordModel::IS_VALID_OK])->all();
                            if(count($stockRecord) > 0){
                                foreach ($stockRecord as $item) {
                                    $item->isValid = GoodsInStorageDetailModel::IS_VALID_NO;
                                    $item->save();
                                }
                            }
                            $inStorageid = $inStorage->storageId;
                            //获取生产入库消耗，库存增加
                            $consumption = GoodsConsumptionModel::find()->where(['storageId'=>$inStorageid,'isValid'=>GoodsConsumptionModel::IS_VALID_OK])->one();
                            if(!empty($consumption)){
                                $consumption->isValid = GoodsConsumptionModel::IS_VALID_NO;
                                $consumption->save();
                                $consumptionId = $consumption->consumptionId;
                                //流水记录删除
                                $record = StockRecordModel::find()
                                    ->where(['unionId'=>$consumptionId,'type'=>StockRecordModel::TYPE_CONSUMPTION,'isValid'=>StockRecordModel::IS_VALID_OK])->all();
                                if(count($record) > 0){
                                    foreach ($record as $item) {
                                        $item->isValid = StockRecordModel::IS_VALID_NO;
                                        $item->save();
                                    }
                                }
                                //删除入库消耗详情记录，并且更新库存
                                $detail = GoodsConsumptionDetailModel::find()->where(['consumptionId'=>$consumptionId,'isValid'=>GoodsConsumptionDetailModel::IS_VALID_OK])->all();
                                if(count($detail) > 0){
                                    foreach ($detail as $item) {
                                        $item->isValid = GoodsConsumptionDetailModel::IS_VALID_NO;
                                        $item->save();
                                        //更新库存
                                        if($item->goodsType = GoodsModel::TYPE_PRODUCTION){
                                            //产品回滚，物料不会滚
                                            $goodsStock = GoodsStockModel::find()
                                                ->where(['goodsId'=>$item->goodsId, 'workingId'=>$item->workingId, 'wareHouseId'=>$houseId, 'isValid'=>GoodsStockModel::IS_VALID_OK])
                                                ->one();
                                            if(!empty($goodsStock)){
                                                $goodsStock->num = $goodsStock->num + $item->num;
                                                $goodsStock->save();
                                            }
                                        }
                                    }
                                }
                            }
                        }
                    }
                }
            }
            $tran->commit();
        }catch (\Exception $e){
            $tran->rollBack();
            Yii::error('del work record fail---'.$e->getMessage());
            $msg = $e->getCode() == Code::PARAM_ERR ? $e->getMessage() : '删除失败';
            return ['code'=>Code::PARAM_ERR,'msg'=>$msg];
        }
        return ['code'=>Code::SUCCESS,'msg'=>'删除成功'];
    }


}