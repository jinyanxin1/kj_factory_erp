<?php
/**
 * @Author: jinyanxin
 * @Date: 2020/2/5
 * @Time: 9:42
 */


namespace backend\models\purchase\stock;

use common\library\helper\Code;
use common\models\adjustment\AdjustmentDetailModel;
use common\models\adjustment\AdjustmentModel;
use common\models\allocation\AllocationDetailModel;
use common\models\allocation\AllocationModel;
use common\models\BaseForm;
use common\models\borrow\BorrowDetailModel;
use common\models\borrow\BorrowModel;
use common\models\goods\GoodsCategoryModel;
use common\models\goods\GoodsModel;
use common\models\purchase\PurchaseDetailModel;
use common\models\purchase\PurchaseModel;
use common\models\returnGoods\ReturnGoodsDetailModel;
use common\models\returnGoods\ReturnGoodsModel;
use common\models\stock\StockLossDetailModel;
use common\models\stock\StockLossModel;
use common\models\stock\StockRecordModel;
use common\models\warehouse\WarehouseModel;
use yii\debug\panels\EventPanel;

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
    public $schoolId = 0;

    public $outHouseId;//调出仓库
    public $inHouseId;//调入仓库

    public $borrowName;//领用人

    public $categoryId;//商品类别
    public $goodsName;//商品名称
    public $status;//启用，停用


    //todo 库存变动统计
    public function getStatisticsData()
    {
        $model = GoodsModel::find()->where(['isValid'=>GoodsModel::IS_VALID_OK]);
        if(!empty($this->status)){
            $model->andWhere(['status'=>$this->status]);
        }
        if($this->categoryId > 0){
            $model->andWhere(['categoryId'=>$this->categoryId]);
        }
        if(!empty($this->goodsName)){
            $model->andWhere(['like','goodsName',$this->goodsName]);
        }
        $count = $model->count();
        $data = $model->offset(($this->page - 1) * $this->pageSize)->limit($this->pageSize)->orderBy('createTime desc')->asArray()->all();
        $showList = [];
        if(count($data) > 0){
            $categoryIds = array_column($data,'categoryId');
            $goodsIdsList = array_column($data,'goodsId');
            $category = GoodsCategoryModel::getByIdList($categoryIds);
            //得到startTime，endTime 这段时间的出入库数量
            $stockRecordStatistics = StockRecordModel::statisticsByTime($this->houseId,$goodsIdsList,$this->startTime,$this->endTime);
            $inHouse = StockRecordModel::$inHouse;
            $outHouse = StockRecordModel::$outHouse;
            foreach($data as $dataInfo){
                $categoryId = $dataInfo['categoryId'];
                $goodsId = $dataInfo['goodsId'];
                $statistics = isset($stockRecordStatistics[$goodsId]) ? $stockRecordStatistics[$goodsId] : [];
                $stockNum = 0;//期末库存
                if(count($statistics) > 0){
                    foreach ($statistics as $stockRecordType=>$num){
                        if(in_array($stockRecordType,$inHouse)){
                            $stockNum += $num;
                        }else if(in_array($stockRecordType,$outHouse)){
                            $stockNum -= $num;
                        }
                    }
                }
                $info = [
                    'goodsId'=>$goodsId,
                    'categoryName'=>isset($category[$categoryId]) ? $category[$categoryId]['categoryName'] : '',
                    'goodsName'=>$dataInfo['goodsName'],
                    'unit'=>$dataInfo['unit'],
                    'startStockNum'=>0,//期初库存
                    'inHouse'=>[
                        'purchase'=>[
                            'num'=>isset($statistics[StockRecordModel::TYPE_PURCHASE]) ? $statistics[StockRecordModel::TYPE_PURCHASE] : 0,
                            'type'=>StockRecordModel::TYPE_PURCHASE
                        ],
                        'allocation'=>[
                            'num'=>isset($statistics[StockRecordModel::TYPE_DIAL_IN]) ? $statistics[StockRecordModel::TYPE_DIAL_IN] : 0,
                            'type'=>StockRecordModel::TYPE_DIAL_IN
                        ],
                        'withdrawalOfCollar'=>[
                            'num'=>isset($statistics[StockRecordModel::TYPE_WITHDRAWAL_OF_COLLAR]) ? $statistics[StockRecordModel::TYPE_WITHDRAWAL_OF_COLLAR] : 0,
                            'type'=>StockRecordModel::TYPE_WITHDRAWAL_OF_COLLAR
                        ],
                        'saleReturn'=>[
                            'num'=>isset($statistics[StockRecordModel::TYPE_SALE_RETURN]) ? $statistics[StockRecordModel::TYPE_SALE_RETURN] : 0,
                            'type'=>StockRecordModel::TYPE_SALE_RETURN
                        ],
                    ],
                    'outHouse'=>[
                        'returnGoods'=>[
                            'num'=>isset($statistics[StockRecordModel::TYPE_RETURN_GOODS]) ? $statistics[StockRecordModel::TYPE_RETURN_GOODS] : 0,
                            'type'=>StockRecordModel::TYPE_RETURN_GOODS
                        ],
                        'allocation'=>[
                            'num'=>isset($statistics[StockRecordModel::TYPE_ALLOCATE]) ? $statistics[StockRecordModel::TYPE_ALLOCATE] : 0,
                            'type'=>StockRecordModel::TYPE_ALLOCATE
                        ],
                        'collarUse'=>[
                            'num'=>isset($statistics[StockRecordModel::TYPE_COLLAR_USE]) ? $statistics[StockRecordModel::TYPE_COLLAR_USE] : 0,
                            'type'=>StockRecordModel::TYPE_COLLAR_USE
                        ],
                        'sale'=>[
                            'num'=>isset($statistics[StockRecordModel::TYPE_SALE]) ? $statistics[StockRecordModel::TYPE_SALE] : 0,
                            'type'=>StockRecordModel::TYPE_SALE
                        ],
                        'reportLoss'=>[
                            'num'=>isset($statistics[StockRecordModel::TYPE_REPORT_LOSS]) ? $statistics[StockRecordModel::TYPE_REPORT_LOSS] : 0,
                            'type'=>StockRecordModel::TYPE_REPORT_LOSS
                        ],
                    ],
                    'inva'=>[
                        'num'=>isset($statistics[StockRecordModel::TYPE_INVA]) ? $statistics[StockRecordModel::TYPE_INVA] : 0,
                        'type'=>StockRecordModel::TYPE_INVA
                    ],
                    'stockNum'=>$stockNum
                ];
                $showList[] = $info;
            }
        }
        return ['count'=>$count,'showList'=>$showList];
    }

    //库存查询得到数据
    public function getQueryData()
    {
        $house = WarehouseModel::getAllHouse();
        $houseIds = array_column($house,'warehouseId');
        $model = StockRecordModel::find()->where(['warehouseId'=>$houseIds,'isValid'=>StockRecordModel::IS_VALID_OK]);
        //仓库id 0 不限
        if($this->houseId > 0){
            $model->andWhere(['warehouseId'=>$this->houseId]);
        }
        //操作类型：0表示全选
        if($this->type > 0){
            $model->andWhere(['type'=>$this->type]);
        }
        if($this->categoryId > 0){
            //根据类别id得到商品id
            $goodsList = GoodsModel::getDataByCategoryId($this->categoryId);
            $goodsIds = array_column($goodsList,'goodsId');
            $model->andWhere(['goodsId'=>$goodsIds]);
        }
        if(!empty($this->goodsName)){
            $goodsData = GoodsModel::getDataByGoodsName($this->goodsName);
            $goodsIdsList = array_column($goodsData,'goodsId');
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
        $model = AdjustmentModel::find()->where(['schoolId'=>$this->schoolId,'houseId'=>$this->houseId,'isValid'=>AdjustmentModel::IS_VALID_OK]);
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
        $model = BorrowModel::find()->where(['schoolId'=>$this->schoolId,'houseId'=>$this->houseId,'isValid'=>StockLossModel::IS_VALID_OK,'type'=>$type]);
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
        $model = StockLossModel::find()->where(['schoolId'=>$this->schoolId,'houseId'=>$this->houseId,'isValid'=>StockLossModel::IS_VALID_OK]);
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
                'amount'=>$amount,
                'remark'=>$purchase['remark'],
                'userName'=>$purchase['userName'],
                'list'=>PurchaseDetailModel::format($data)
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
                'amount'=>$amount,
                'remark'=>$returnInfo['remark'],
                'userName'=>$returnInfo['userName'],
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
                'remark'=>$allocationInfo['remark'],
                'userName'=>$allocationInfo['userName'],
                'date'=>$allocationInfo['date'],
                'inHouse'=>isset($house[$allocationInfo['enterWarehouseId']]) ? $house[$allocationInfo['enterWarehouseId']]['warehouseName'] : '',
                'outHouse'=>isset($house[$allocationInfo['outWarehouseId']]) ? $house[$allocationInfo['outWarehouseId']]['warehouseName'] : '',
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
            $saveData = PurchaseModel::saveData($this->list,$this->houseId,$this->remark,$this->recordUserName,$this->supplier,$this->date,$this->primaryId);
        }else if($this->type === StockRecordModel::TYPE_RETURN_GOODS){
            //保存退货
            $saveData = ReturnGoodsModel::saveData($this->list,$this->houseId,$this->remark,$this->recordUserName,$this->supplier,$this->date,$this->primaryId);
        }else if($this->type === StockRecordModel::TYPE_ALLOCATION){
            //调拨
            $saveData = AllocationModel::saveData($this->schoolId,$this->primaryId,$this->list,$this->outHouseId,$this->inHouseId,$this->remark,$this->recordUserName,$this->date);
        }else if($this->type === StockRecordModel::TYPE_REPORT_LOSS){
            //报损
            $saveData = StockLossModel::saveData($this->primaryId,$this->list,$this->houseId,$this->remark,$this->recordUserName,$this->date);
        }else if($this->type === StockRecordModel::TYPE_COLLAR_USE){
            //领用
            $saveData = BorrowModel::saveData($this->primaryId,$this->list,$this->houseId,$this->remark,$this->recordUserName,$this->date,$this->borrowName,BorrowModel::TYPE_COLLAR_USE);
        }else if($this->type === StockRecordModel::TYPE_WITHDRAWAL_OF_COLLAR){
            //退领
            $saveData = BorrowModel::saveData($this->primaryId,$this->list,$this->houseId,$this->remark,$this->recordUserName,$this->date,$this->borrowName,BorrowModel::TYPE_WITHDRAWAL_OF_COLLAR);
        }else if( $this->type === StockRecordModel::TYPE_INVA){
            //库存调整
            $saveData = AdjustmentModel::saveData($this->primaryId,$this->list,$this->houseId,$this->remark,$this->recordUserName,$this->date);
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
            $bol = PurchaseModel::delById($this->primaryId);
        }else if($this->type === StockRecordModel::TYPE_RETURN_GOODS){
            //退货
            $info = ReturnGoodsModel::getById($this->primaryId);
            if($info === null){
                $returnArr['code'] = Code::PARAM_ERR;
                $returnArr['msg'] = '记录不存在';
                return $returnArr;
            }
            $bol = ReturnGoodsModel::delById($this->primaryId);
        }else if($this->type === StockRecordModel::TYPE_ALLOCATION){
            //调拨删除
            $info = AllocationModel::getById($this->primaryId);
            if($info === null){
                $returnArr['code'] = Code::PARAM_ERR;
                $returnArr['msg'] = '记录不存在';
                return $returnArr;
            }
            $bol = AllocationModel::delById($this->primaryId);
        }else if($this->type === StockRecordModel::TYPE_REPORT_LOSS){
            //报损删除
            $info = StockLossModel::getById($this->primaryId);
            if($info === null){
                $returnArr['code'] = Code::PARAM_ERR;
                $returnArr['msg'] = '记录不存在';
                return $returnArr;
            }
            $bol = StockLossModel::delById($this->primaryId);
        }else if(($this->type === StockRecordModel::TYPE_COLLAR_USE) || ($this->type === StockRecordModel::TYPE_WITHDRAWAL_OF_COLLAR)){
            //领用或退领删除
            $info = BorrowModel::getById($this->primaryId);
            if($info === null){
                $returnArr['code'] = Code::PARAM_ERR;
                $returnArr['msg'] = '记录不存在';
                return $returnArr;
            }
            $bol = BorrowModel::delById($this->primaryId);
        }else if($this->type === StockRecordModel::TYPE_INVA){
            //库存调整删除
            $info = AdjustmentModel::getById($this->primaryId);
            if($info === null){
                $returnArr['code'] = Code::PARAM_ERR;
                $returnArr['msg'] = '记录不存在';
                return $returnArr;
            }
            $bol = AdjustmentModel::delById($this->primaryId);
        }else{
            $bol = false;
        }
        if($bol === false){
            $returnArr['code'] = Code::PARAM_ERR;
            $returnArr['msg'] = '删除失败';
        }
        return $returnArr;
    }

}