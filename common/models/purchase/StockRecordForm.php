<?php
/**
 * @Author: jinyanxin
 * @Date: 2020/2/5
 * @Time: 9:42
 */


namespace common\models\purchase;

use common\library\helper\Code;
use common\models\BaseForm;
use common\models\goods\GoodsModel;
use common\models\purchase\adjustment\AdjustmentDetailModel;
use common\models\purchase\adjustment\AdjustmentModel;
use common\models\purchase\allocation\AllocationDetailModel;
use common\models\purchase\allocation\AllocationModel;
use common\models\purchase\borrow\BorrowDetailModel;
use common\models\purchase\borrow\BorrowModel;
use common\models\purchase\purchaseInfo\PurchaseDetailModel;
use common\models\purchase\purchaseInfo\PurchaseModel;
use common\models\purchase\returnGoods\ReturnGoodsDetailModel;
use common\models\purchase\returnGoods\ReturnGoodsModel;
use common\models\purchase\stockLoss\StockLossDetailModel;
use common\models\purchase\stockLoss\StockLossModel;
use common\models\workingProcedure\GoodsWorkingProcedureModel;

class StockRecordForm extends BaseForm
{

    public $houseId;//仓库id
    public $type;//类型
    public $page;
    public $pageSize;
    public $startTime;
    public $endTime;
    public $recordUserName;
    public $supplier;
    public $remark;
    public $date;

    public $primaryId;

    public $list;//增加的数据


    public $outHouseId;//调出仓库
    public $inHouseId;//调入仓库

    public $borrowName;//领用人

    public $categoryId;//商品类别
    public $goodsName;//商品名称
    public $status;//启用，停用

    public $goodsType;//1产品；2物料
    public $clientId;//客户id

    //产品库存变动统计
    public function getStatisticsProductionData()
    {
        $model = GoodsModel::find()->where(['type'=>GoodsModel::TYPE_PRODUCTION,'isValid'=>GoodsModel::IS_VALID_OK]);

        if(!empty($this->goodsName)){
            $model->andWhere(['like','name',$this->goodsName]);
        }
        $count = $model->count();
        $data = $model->offset(($this->page - 1) * $this->pageSize)->limit($this->pageSize)->orderBy('createTime desc')->asArray()->all();
        $showList = [];
        if(count($data) > 0){
            $goodsIdsList = array_column($data,'id');
            //得到startTime，endTime 这段时间的出入库数量
            $stockRecordStatistics = StockRecordModel::statisticsByTime($this->houseId,$goodsIdsList,$this->startTime,$this->endTime);
            foreach($data as $dataInfo){
                $goodsId = $dataInfo['id'];
                $workingData = GoodsWorkingProcedureModel::find()->where(['goodsId'=>$goodsId,'isValid'=>GoodsWorkingProcedureModel::IS_VALID_OK])->indexBy('id')->asArray()->all();
                if(count($workingData) > 0){
                    foreach ($workingData as $workingDatum) {
                        $key = $goodsId.'-'.$workingDatum['id'];
                        $statistics = isset($stockRecordStatistics[$key]) ? $stockRecordStatistics[$key] : [];
                        $info = [
                            'goodsName'=>$dataInfo['name'],
                            'workingName'=>$workingDatum['name'],
                            'unit'=>$dataInfo['unit'],
                            'attr'=>$dataInfo['attr'],
                            'returnGoods'=>isset($statistics[StockRecordModel::TYPE_RETURN_GOODS]) ? $statistics[StockRecordModel::TYPE_RETURN_GOODS] : 0,
                            'withdrawalOfCollar'=>isset($statistics[StockRecordModel::TYPE_WITHDRAWAL_OF_COLLAR]) ? $statistics[StockRecordModel::TYPE_WITHDRAWAL_OF_COLLAR] : 0,
                            'pro'=>isset($statistics[StockRecordModel::TYPE_IN_STORAGE]) ? $statistics[StockRecordModel::TYPE_IN_STORAGE] : 0,
                            'sales'=>isset($statistics[StockRecordModel::TYPE_SALE]) ? $statistics[StockRecordModel::TYPE_SALE] : 0,
                            'collarUse'=>isset($statistics[StockRecordModel::TYPE_COLLAR_USE]) ? $statistics[StockRecordModel::TYPE_COLLAR_USE] : 0,
                            'reportLoss'=>isset($statistics[StockRecordModel::TYPE_REPORT_LOSS]) ? $statistics[StockRecordModel::TYPE_REPORT_LOSS] : 0,
                            'inva'=>isset($statistics[StockRecordModel::TYPE_INVA]) ? $statistics[StockRecordModel::TYPE_INVA] : 0,
                        ];
                        $showList[] = $info;
                    }
                }
            }
        }
        $table = [
            ['name'=>'名称', 'key'=>'goodsName'],
            ['name'=>'规格', 'key'=>'attr'],
            ['name'=>'单位', 'key'=>'unit'],
            ['name'=>'入库', 'key'=>'inHouse',
             'children'=>[['name'=>'退货', 'key'=>'returnGoods'],['name'=>'退领','key'=>'withdrawalOfCollar'],['name'=>'生产','key'=>'pro']]],
            ['name'=>'出库', 'key'=>'outHouse',
             'children'=>[['name'=>'销售', 'key'=>'sales'],['name'=>'领用','key'=>'collarUse'],['name'=>'报损','key'=>'reportLoss']]],
            ['name'=>'库存调整', 'key'=>'inva']
        ];
        return ['count'=>$count,'showList'=>$showList,'table'=>$table];
    }
    //物料库存变动统计
    public function getStatisticsMetrailData()
    {
        $model = GoodsModel::find()->where(['type'=>GoodsModel::TYPE_MATERIEL,'isValid'=>GoodsModel::IS_VALID_OK]);

        if(!empty($this->goodsName)){
            $model->andWhere(['like','name',$this->goodsName]);
        }
        $count = $model->count();
        $data = $model->offset(($this->page - 1) * $this->pageSize)->limit($this->pageSize)->orderBy('createTime desc')->asArray()->all();
        $showList = [];
        if(count($data) > 0){
            $goodsIdsList = array_column($data,'id');
            //得到startTime，endTime 这段时间的出入库数量
            $stockRecordStatistics = StockRecordModel::statisticsByTime($this->houseId,$goodsIdsList,$this->startTime,$this->endTime);
            foreach($data as $dataInfo){
                $goodsId = $dataInfo['id'];
                $key = $goodsId.'-0';
                $statistics = isset($stockRecordStatistics[$key]) ? $stockRecordStatistics[$key] : [];
                $info = [
                    'goodsName'=>$dataInfo['name'],
                    'unit'=>$dataInfo['unit'],
                    'purchase'=>isset($statistics[StockRecordModel::TYPE_PURCHASE]) ? $statistics[StockRecordModel::TYPE_PURCHASE] : 0,
                    'withdrawalOfCollar'=>isset($statistics[StockRecordModel::TYPE_WITHDRAWAL_OF_COLLAR]) ? $statistics[StockRecordModel::TYPE_WITHDRAWAL_OF_COLLAR] : 0,
                    'returnGoods'=>isset($statistics[StockRecordModel::TYPE_RETURN_GOODS]) ? $statistics[StockRecordModel::TYPE_RETURN_GOODS] : 0,
                    'collarUse'=>isset($statistics[StockRecordModel::TYPE_COLLAR_USE]) ? $statistics[StockRecordModel::TYPE_COLLAR_USE] : 0,
                    'reportLoss'=>isset($statistics[StockRecordModel::TYPE_REPORT_LOSS]) ? $statistics[StockRecordModel::TYPE_REPORT_LOSS] : 0,
                    'pro'=>isset($statistics[StockRecordModel::TYPE_CONSUMPTION]) ? $statistics[StockRecordModel::TYPE_CONSUMPTION] : 0,
                    'inva'=>isset($statistics[StockRecordModel::TYPE_INVA]) ? $statistics[StockRecordModel::TYPE_INVA] : 0,
                ];
                $showList[] = $info;
            }
        }
        $table = [
            ['name'=>'名称', 'key'=>'goodsName'],
//            ['name'=>'规格', 'key'=>'attr'],
            ['name'=>'单位', 'key'=>'unit'],
            ['name'=>'入库', 'key'=>'inHouse',
             'children'=>[['name'=>'进货', 'key'=>'purchase'],['name'=>'退领','key'=>'withdrawalOfCollar']]],
            ['name'=>'出库', 'key'=>'outHouse',
             'children'=>[['name'=>'退货', 'key'=>'returnGoods'],['name'=>'领用','key'=>'collarUse'],['name'=>'报损','key'=>'reportLoss'],['name'=>'生产消耗','key'=>'pro']]],
            ['name'=>'库存调整', 'key'=>'inva']
        ];
        return ['count'=>$count,'showList'=>$showList,'table'=>$table];
    }

    //库存查询得到数据
    public function getQueryData()
    {
        $house = WarehouseModel::getAllHouse();
        $houseIds = array_column($house,'id');
        $model = StockRecordModel::find()->where(['goodsType'=>$this->goodsType,'wareHouseId'=>$houseIds,'isValid'=>StockRecordModel::IS_VALID_OK]);
        //仓库id 0 不限
        if($this->houseId > 0){
            $model->andWhere(['wareHouseId'=>$this->houseId]);
        }

        if(!empty($this->goodsName)){
            $goodsData = GoodsModel::getDataByGoodsName($this->goodsName);
            $goodsIdsList = array_column($goodsData,'id');
            $model->andWhere(['goodsId'=>$goodsIdsList]);
        }
        if(!empty($this->startTime)){
            $model->andWhere(['>=','date',$this->startTime]);
        }
        if(!empty($this->endTime)){
            $model->andWhere(['<=','date',$this->endTime]);
        }
        $count = $model->count();
        $data = $model->offset(($this->page - 1) * $this->pageSize)->limit($this->pageSize)->orderBy('createTime desc')->asArray()->all();
        $showList = StockRecordModel::format($data);
        return [
            'count'=>$count,
            'showList'=>$showList
        ];
    }

    public function getData()
    {
        if($this->type === StockRecordModel::TYPE_PURCHASE){
            //进货
            $data = $this->getPurchaseData();
        }else if($this->type === StockRecordModel::TYPE_RETURN_GOODS){
            //退货
            $data = $this->getReturnGoodsData();
        }else if( $this->type === StockRecordModel::TYPE_ALLOCATION){
            //调拨
            $data = $this->getAllocationData();
        }else if($this->type === StockRecordModel::TYPE_REPORT_LOSS){
            //报损
            $data = $this->getStockLossData();
        }else if(($this->type === StockRecordModel::TYPE_COLLAR_USE) || ($this->type === StockRecordModel::TYPE_WITHDRAWAL_OF_COLLAR)){
            //领用或退领
            $data = $this->getBorrowData();
        }else if($this->type === StockRecordModel::TYPE_INVA){
            //库存调整
            $data = $this->getAdjustmentData();
        }else{
            $data = [];
        }
        return $data;
    }

    //得到库存调整
    public function getAdjustmentData()
    {
        $model = AdjustmentModel::find()->where(['houseId'=>$this->houseId,'isValid'=>AdjustmentModel::IS_VALID_OK]);
        if($this->goodsType > 0){
            $model->andWhere(['goodsType'=>$this->goodsType]);
        }
        if(!empty($this->startTime)){
            $model->andWhere(['>=','date',$this->startTime]);
        }
        if( !empty($this->endTime)){
            $model->andWhere(['<=','date',$this->endTime]);
        }
        if(!empty($this->recordUserName)){
            $model->andWhere(['like','userName',$this->recordUserName]);
        }
        $count = $model->count();
        $data = $model->offset(($this->page - 1) * $this->pageSize)->limit($this->pageSize)->orderBy('date desc,createTime desc')->asArray()->all();
        $showList = AdjustmentModel::format($data);
        return [
            'count'=>$count,
            'showList'=>$showList
        ];
    }

    //得到领用数据
    public function getBorrowData()
    {
        if($this->type === StockRecordModel::TYPE_COLLAR_USE){
            $type = BorrowModel::TYPE_COLLAR_USE;
        }else{
            $type = BorrowModel::TYPE_WITHDRAWAL_OF_COLLAR;
        }
        $model = BorrowModel::find()->where(['houseId'=>$this->houseId,'isValid'=>StockLossModel::IS_VALID_OK,'type'=>$type]);
        if($this->goodsType > 0){
            $model->andWhere(['goodsType'=>$this->goodsType]);
        }
        if(!empty($this->startTime)){
            $model->andWhere(['>=','date',$this->startTime]);
        }
        if( !empty($this->endTime)){
            $model->andWhere(['<=','date',$this->endTime]);
        }
        if(!empty($this->recordUserName)){
            $model->andWhere(['like','userName',$this->recordUserName]);
        }
        $count = $model->count();
        $data = $model->offset(($this->page - 1) * $this->pageSize)->limit($this->pageSize)->orderBy('date desc,createTime desc')->asArray()->all();
        $showList = BorrowModel::format($data);
        return [
            'count'=>$count,
            'showList'=>$showList
        ];
    }

    //得到报损数据
    public function getStockLossData()
    {
        $model = StockLossModel::find()->where(['houseId'=>$this->houseId,'isValid'=>StockLossModel::IS_VALID_OK]);
        if($this->goodsType > 0){
            $model->andWhere(['goodsType'=>$this->goodsType]);
        }
        if(!empty($this->startTime)){
            $model->andWhere(['>=','date',$this->startTime]);
        }
        if( !empty($this->endTime)){
            $model->andWhere(['<=','date',$this->endTime]);
        }
        if(!empty($this->recordUserName)){
            $model->andWhere(['like','userName',$this->recordUserName]);
        }
        $count = $model->count();
        $data = $model->offset(($this->page - 1) * $this->pageSize)->limit($this->pageSize)->orderBy('date desc,createTime desc')->asArray()->all();
        $showList = StockLossModel::format($data);
        return [
            'count'=>$count,
            'showList'=>$showList
        ];
    }

    //得到调拨数据
    public function getAllocationData()
    {
        $model = AllocationModel::find()->where(['outWarehouseId'=>$this->houseId,'isValid'=>AllocationModel::IS_VALID_OK]);
        if($this->goodsType > 0){
            $model->andWhere(['goodsType'=>$this->goodsType]);
        }
        if(!empty($this->startTime)){
            $model->andWhere(['>=','date',$this->startTime]);
        }
        if( !empty($this->endTime)){
            $model->andWhere(['<=','date',$this->endTime]);
        }
        if(!empty($this->recordUserName)){
            $model->andWhere(['like','userName',$this->recordUserName]);
        }
        $count = $model->count();
        $data = $model->offset(($this->page - 1) * $this->pageSize)->limit($this->pageSize)->orderBy('date desc,createTime desc')->asArray()->all();
        $showList = AllocationModel::format($data);
        return [
            'count'=>$count,
            'showList'=>$showList
        ];
    }

    //得到退货数据
    public function getReturnGoodsData()
    {
        $model = ReturnGoodsModel::find()->where(['houseId'=>$this->houseId,'isValid'=>ReturnGoodsModel::IS_VALID_OK]);
        if($this->goodsType > 0){
            $model->andWhere(['goodsType'=>$this->goodsType]);
        }
        if(!empty($this->startTime)){
            $model->andWhere(['>=','returnDate',$this->startTime]);
        }
        if( !empty($this->endTime)){
            $model->andWhere(['<=','returnDate',$this->endTime]);
        }
        if(!empty($this->recordUserName)){
            $model->andWhere(['like','userName',$this->recordUserName]);
        }
        $count = $model->count();
        $data = $model->offset(($this->page - 1) * $this->pageSize)->limit($this->pageSize)->orderBy('returnDate desc,createTime desc')->asArray()->all();
        $showList = ReturnGoodsModel::format($data);
        return [
            'count'=>$count,
            'showList'=>$showList
        ];
    }

    //得到进货数据
    public function getPurchaseData()
    {
        $model = PurchaseModel::find()->where(['houseId'=>$this->houseId,'isValid'=>PurchaseModel::IS_VALID_OK]);
        if($this->goodsType > 0){
            $model->andWhere(['goodsType'=>$this->goodsType]);
        }
        if(!empty($this->startTime)){
            $model->andWhere(['>=','purchaseDate',$this->startTime]);
        }
        if( !empty($this->endTime)){
            $model->andWhere(['<=','purchaseDate',$this->endTime]);
        }
        if(!empty($this->recordUserName)){
            $model->andWhere(['like','userName',$this->recordUserName]);
        }
        $count = $model->count();
        $data = $model->offset(($this->page - 1) * $this->pageSize)->limit($this->pageSize)->orderBy('purchaseDate desc,createTime desc')->asArray()->all();
        $showList = PurchaseModel::format($data);
        return [
            'count'=>$count,
            'showList'=>$showList
        ];
    }

    public function getDetail()
    {
        $showList = ['code'=>Code::SUCCESS,'msg'=>'ok','data'=>[]];
        if($this->type === StockRecordModel::TYPE_PURCHASE){
            //进货详情
            $purchase = PurchaseModel::getById($this->primaryId);
            if($purchase === null){
                $showList['code'] = Code::PARAM_ERR;
                $showList['msg'] = '该条记录不存在';
            }
            $amount = BaseForm::amountToYuan(intval($purchase['totalAmount']));
            $data = PurchaseDetailModel::getDataByPurchaseId($this->primaryId);
            $showList['data'] = [
                'goodsType'=>$purchase['goodsType'],
                'amount'=>$amount,
                'remark'=>$purchase['remark'],
                'userName'=>$purchase['userName'],
                'list'=>PurchaseDetailModel::format($data),
                'supplierId'=>intval($purchase['supplier']),
            ];
        }else if($this->type === StockRecordModel::TYPE_RETURN_GOODS){
            //退货详情
            $returnInfo = ReturnGoodsModel::getById($this->primaryId);
            if($returnInfo === null){
                $showList['code'] = Code::PARAM_ERR;
                $showList['msg'] = '该条记录不存在';
            }
            $amount = BaseForm::amountToYuan(intval($returnInfo['totalAmount']));
            $data = ReturnGoodsDetailModel::getDataByReturnId($this->primaryId);
            $showList['data'] = [
                'clientId'=>$returnInfo['clientId'],
                'goodsType'=>$returnInfo['goodsType'],
                'amount'=>$amount,
                'remark'=>$returnInfo['remark'],
                'userName'=>$returnInfo['userName'],
                'supplierId'=>intval($returnInfo['supplier']),
                'list'=>ReturnGoodsDetailModel::format($data)
            ];
        }else if($this->type === StockRecordModel::TYPE_ALLOCATION){
            //调拨
            $allocationInfo = AllocationModel::getById($this->primaryId);
            if($allocationInfo === null){
                $showList['code'] = Code::PARAM_ERR;
                $showList['msg'] = '该条记录不存在';
            }
            $house = WarehouseModel::getAllHouse();
            $data = AllocationDetailModel::getDataByAllocationId($this->primaryId);
            $showList['data'] = [
                'goodsType'=>$allocationInfo['goodsType'],
                'remark'=>$allocationInfo['remark'],
                'userName'=>$allocationInfo['userName'],
                'date'=>$allocationInfo['date'],
                'inHouse'=>isset($house[$allocationInfo['enterWarehouseId']]) ? $house[$allocationInfo['enterWarehouseId']]['name'] : '',
                'outHouse'=>isset($house[$allocationInfo['outWarehouseId']]) ? $house[$allocationInfo['outWarehouseId']]['name'] : '',
                'list'=>AllocationDetailModel::format($data)
            ];
        }else if($this->type === StockRecordModel::TYPE_REPORT_LOSS){
            //报损详情
            $lossInfo = StockLossModel::getById($this->primaryId);
            if($lossInfo === null){
                $showList['code'] = Code::PARAM_ERR;
                $showList['msg'] = '该条记录不存在';
            }
            $data = StockLossDetailModel::getDataByStockLossId($this->primaryId);
            $formatData = StockLossDetailModel::format($data);
            $showList['data'] = [
                'goodsType'=>$lossInfo['goodsType'],
                'amount'=>$formatData['amount'],
                'date'=>$lossInfo['date'],
                'remark'=>$lossInfo['remark'],
                'userName'=>$lossInfo['userName'],
                'list'=>$formatData['showList'],
            ];
        }else if(($this->type === StockRecordModel::TYPE_COLLAR_USE) || ($this->type === StockRecordModel::TYPE_WITHDRAWAL_OF_COLLAR)){
            //领用或退领
            $borrowInfo = BorrowModel::getById($this->primaryId);
            if($borrowInfo === null){
                $showList['code'] = Code::PARAM_ERR;
                $showList['msg'] = '该条记录不存在';
            }
            $data = BorrowDetailModel::getByBorrowId($this->primaryId);
            $formatData = BorrowDetailModel::format($data);
            $showList['data'] = [
                'goodsType'=>$borrowInfo['goodsType'],
                'amount'=>$formatData['amount'],
                'date'=>$borrowInfo['date'],
                'remark'=>$borrowInfo['remark'],
                'userName'=>$borrowInfo['userName'],
                'borrowName'=>$borrowInfo['borrowUser'],
                'list'=>$formatData['showList'],
            ];
        }else if($this->type === StockRecordModel::TYPE_INVA){
            //库存调整
            $adjustmentInfo = AdjustmentModel::getById($this->primaryId);
            if($adjustmentInfo === null){
                $showList['code'] = Code::PARAM_ERR;
                $showList['msg'] = '该条记录不存在';
            }
            $data = AdjustmentDetailModel::getDataByAdjustmentId($this->primaryId);
            $formatData = AdjustmentDetailModel::format($data);
            $showList['data'] = [
                'goodsType'=>$adjustmentInfo['goodsType'],
                'amount'=>$formatData['amount'],
                'date'=>$adjustmentInfo['date'],
                'remark'=>$adjustmentInfo['remark'],
                'userName'=>$adjustmentInfo['userName'],
                'list'=>$formatData['showList'],
            ];
        }
        return $showList;
    }


    //保存数据
    public function save()
    {
        if($this->type === StockRecordModel::TYPE_PURCHASE){
            //保存进货
            $saveData = PurchaseModel::saveData($this->list,$this->houseId,$this->remark,$this->recordUserName,$this->supplier,$this->date,$this->primaryId,$this->goodsType);
        }else if($this->type === StockRecordModel::TYPE_RETURN_GOODS){
            //保存退货
            if($this->goodsType == GoodsModel::TYPE_MATERIEL){
                //物料退货
                $saveData = ReturnGoodsModel::saveData($this->list,$this->houseId,$this->remark,$this->recordUserName,$this->supplier,$this->date,$this->primaryId,$this->goodsType,$this->clientId);
            }else{
                //产品退货
                $saveData = ReturnGoodsModel::saveProductionData($this->list,$this->houseId,$this->remark,$this->recordUserName,$this->supplier,$this->date,$this->primaryId,$this->goodsType,$this->clientId);
            }
        }else if($this->type === StockRecordModel::TYPE_ALLOCATION){
            //调拨
            $saveData = ['code'=>Code::PARAM_ERR,'msg'=>'无调拨操作'];
            //            $saveData = AllocationModel::saveData($this->primaryId,$this->list,$this->outHouseId,$this->inHouseId,$this->remark,$this->recordUserName,$this->date,$this->goodsType);
        }else if($this->type === StockRecordModel::TYPE_REPORT_LOSS){
            //报损
            $saveData = StockLossModel::saveData($this->primaryId,$this->list,$this->houseId,$this->remark,$this->recordUserName,$this->date,$this->goodsType);
        }else if($this->type === StockRecordModel::TYPE_COLLAR_USE){
            //领用
            $saveData = BorrowModel::saveData($this->primaryId,$this->list,$this->houseId,$this->remark,$this->recordUserName,$this->date,$this->borrowName,BorrowModel::TYPE_COLLAR_USE,$this->goodsType);
        }else if($this->type === StockRecordModel::TYPE_WITHDRAWAL_OF_COLLAR){
            //退领
            $saveData = BorrowModel::saveData($this->primaryId,$this->list,$this->houseId,$this->remark,$this->recordUserName,$this->date,$this->borrowName,BorrowModel::TYPE_WITHDRAWAL_OF_COLLAR,$this->goodsType);
        }else if( $this->type === StockRecordModel::TYPE_INVA){
            //库存调整
            $saveData = AdjustmentModel::saveData($this->primaryId,$this->list,$this->houseId,$this->remark,$this->recordUserName,$this->date,$this->goodsType);
        }else{
            $saveData = ['code'=>Code::PARAM_ERR,'msg'=>'类型错误'];
        }
        return $saveData;
    }


    //删除数据
    public function del()
    {
        $returnArr = ['code'=>Code::SUCCESS,'msg'=>'删除成功'];
        if($this->type === StockRecordModel::TYPE_PURCHASE){
            //进货
            $info = PurchaseModel::getById($this->primaryId);
            if($info === null){
                $returnArr['code'] = Code::PARAM_ERR;
                $returnArr['msg'] = '记录不存在';
                return $returnArr;
            }
            $result = PurchaseModel::delById($this->primaryId);
        }else if($this->type === StockRecordModel::TYPE_RETURN_GOODS){
            //退货
            $info = ReturnGoodsModel::getById($this->primaryId);
            if($info === null){
                $returnArr['code'] = Code::PARAM_ERR;
                $returnArr['msg'] = '记录不存在';
                return $returnArr;
            }
            $result = ReturnGoodsModel::delById($this->primaryId);
        }else if($this->type === StockRecordModel::TYPE_ALLOCATION){
            //调拨删除
            $result['bol'] = false;
            $result['msg'] = '无操作';
            /*$info = AllocationModel::getById($this->primaryId);
            if($info === null){
                $returnArr['code'] = Code::PARAM_ERR;
                $returnArr['msg'] = '记录不存在';
                return $returnArr;
            }
            $result = AllocationModel::delById($this->primaryId);*/
        }else if($this->type === StockRecordModel::TYPE_REPORT_LOSS){
            //报损删除
            $info = StockLossModel::getById($this->primaryId);
            if($info === null){
                $returnArr['code'] = Code::PARAM_ERR;
                $returnArr['msg'] = '记录不存在';
                return $returnArr;
            }
            $result = StockLossModel::delById($this->primaryId);
        }else if(($this->type === StockRecordModel::TYPE_COLLAR_USE) || ($this->type === StockRecordModel::TYPE_WITHDRAWAL_OF_COLLAR)){
            //领用或退领删除
            $info = BorrowModel::getById($this->primaryId);
            if($info === null){
                $returnArr['code'] = Code::PARAM_ERR;
                $returnArr['msg'] = '记录不存在';
                return $returnArr;
            }
            $result = BorrowModel::delById($this->primaryId);
        }else if($this->type === StockRecordModel::TYPE_INVA){
            //库存调整删除
            $info = AdjustmentModel::getById($this->primaryId);
            if($info === null){
                $returnArr['code'] = Code::PARAM_ERR;
                $returnArr['msg'] = '记录不存在';
                return $returnArr;
            }
            $result = AdjustmentModel::delById($this->primaryId);
        }else{
            $result['bol'] = false;
        }
        if($result['bol'] === false){
            $returnArr['code'] = Code::PARAM_ERR;
            $returnArr['msg'] = isset($result['msg']) ? $result['msg'] : '删除失败';
        }
        return $returnArr;
    }

}