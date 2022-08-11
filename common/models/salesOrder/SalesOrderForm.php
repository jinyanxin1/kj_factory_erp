<?php
/**
 *
 * author: jinyanxin
 * Date: 2020/9/4
 * Time: 14:11
 * PHP version 7
 */

namespace common\models\salesOrder;


use common\library\helper\Code;
use common\models\clientInfo\ClientInfoModel;
use common\models\finance\PaymentsModel;
use common\models\goods\GoodsMaterialModel;
use common\models\goods\GoodsModel;
use common\models\purchase\GoodsStockModel;
use common\models\purchase\send\SendGoodsDetailModel;
use common\models\purchase\send\SendGoodsModel;
use common\models\purchase\StockRecordModel;
use common\models\workingProcedure\GoodsWorkingProcedureModel;
use Yii;
use yii\helpers\Json;

class SalesOrderForm extends SalesOrderModel
{
    public $detailList;
    public $page;
    public $pageSize;
    public $startOrderDate;
    public $endOrderDate;
    public $startDeliveryDate;
    public $endDeliveryDate;
    public $clientName;

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id','detailList','orderDate', 'deliveryDate','clientName','price','collectionStatus','fileUrl',
                'totalPrice','receiptPrice','startOrderDate','endOrderDate','clientPersonId',
                'startDeliveryDate','endDeliveryDate','page','pageSize','status','clientId','sendDate','sendWay','clientAddress'], 'safe'],
            [['number','contractCode','sendWay'], 'string', 'max' => 32],
        ];
    }

    //保存
    public function saveInfo()
    {
        if(!$this->validate()){
            $firstItem = current($this->getErrors());
            return ['code'=>Code::PARAM_ERR,'msg'=>$firstItem[0]];
        }

        if(count($this->detailList) <= 0){
            return ['code'=>Code::PARAM_ERR,'msg'=>'订单产品为空'];
        }

        if($this->receiptPrice > $this->totalPrice){
            return ['code'=>Code::PARAM_ERR,'msg'=>'收款金额不能大于总金额'];
        }

        if($this->id > 0){
            $info = SalesOrderModel::getById($this->id,false);
            if(empty($info)){
                return ['code'=>Code::PARAM_ERR,'msg'=>'订单不存在'];
            }
        }else{
            $info = new SalesOrderModel();
            $info->number = SalesOrderModel::getNumber(self::ORDER_PREFIX);
        }

        //销售单主表，副表都需要加数据
        $transaction = Yii::$app->db->beginTransaction();
        try{
            $info->clientId = $this->clientId;
            //合同编号
            $info->contractCode = $this->contractCode;
            //订单日期
            $info->orderDate = date('Y-m-d');
            //订单总金额
            $info->totalPrice = self::amountToCent($this->totalPrice);
            //发货总金额
            $info->receiptPrice = self::amountToCent($this->receiptPrice);
            if($this->totalPrice > $this->receiptPrice){
                $info->collectionStatus = SalesOrderModel::COLLECTION_STATUS_NO;
            }else{
                $info->collectionStatus = SalesOrderModel::COLLECTION_STATUS_YES;
            }
            //交货日期
            $info->deliveryDate = $this->deliveryDate;
            $info->status = !empty($this->status) ? $this->status : SalesOrderModel::STATUS_PRO_ING;
            if(!empty($this->fileUrl)){
                $info->fileUrl = Json::encode($this->fileUrl);
            }
            $info->save();

            $this->id = $info->id;
            //保存详情
            foreach($this->detailList as $detailInfo){
                //获取之前订单详情
                $existOrderDetail = SalesOrderDetailModel::find()->where(['orderId'=>$this->id,'isValid'=>SalesOrderDetailModel::IS_VALID_OK])->asArray()->all();
                $existOrderDetailGoodsIds = count($existOrderDetail) > 0 ? array_column($existOrderDetail,'goodsId') : [];
                $nowOrderDetailGoodsIds = array_column($this->detailList,'goodsId');
                $delGoodsIds = array_diff($existOrderDetailGoodsIds,$nowOrderDetailGoodsIds);
                SalesOrderDetailModel::updateAll(
                    ['isValid'=>SalesOrderDetailModel::IS_VALID_NO,'updateTime'=>date('Y-m-d H:i:s')],
                    ['goodsId'=>$delGoodsIds,'orderId'=>$this->id]);
                $orderDetail = new SalesOrderDetailForm();
                $detailInfo['orderId'] = $this->id;
                $orderDetail->attributes = $detailInfo;
                $saveOrderDetail = $orderDetail->saveInfo();
                if($saveOrderDetail['code'] !== Code::SUCCESS){
                    throw new \Exception($saveOrderDetail['msg'],Code::PARAM_ERR);
                    break;
                }
            }
            $transaction->commit();
        }catch (\Exception $e){
            $transaction->rollBack();
            Yii::info('sales order save fail error msg:'.$e->getMessage(),'salesOrder');
            $errorMsg = $e->getCode() === Code::PARAM_ERR ? $e->getMessage() : '保存失败';
            return ['code'=>Code::PARAM_ERR,'msg'=>$errorMsg];
        }
        return ['code'=>Code::SUCCESS,'msg'=>'保存成功'];
    }

    /*
     * 根据客户id获取订单
     * */
    public function getClientOrder()
    {
        $model = SalesOrderModel::find()->where([
            'clientId'=>$this->clientId,
            'isValid'=>SalesOrderModel::IS_VALID_OK])->asArray()->all();
        $returnArr = [];
        if(count($model) > 0){
            $statusList = SalesOrderModel::$statusList;
            //根据订单id得到已经开过发票的订单
            $isBillOrderIds = PaymentsModel::getIsDrewBillByOrderIds(array_column($model,'id'));
            foreach ($model as $info){
                $returnArr[] = [
                    'orderId'=>$info['id'],
                    'number'=>$info['number'],
                    'contractCode'=>$info['contractCode'],
                    'orderDate'=>$info['orderDate'],
                    'totalPrice'=>SalesOrderModel::amountToYuan($info['totalPrice']),
                    'receiptPrice'=>SalesOrderModel::amountToYuan($info['receiptPrice']),
                    'noReceiptPrice'=>SalesOrderModel::amountToYuan(($info['totalPrice'] - $info['receiptPrice'])),
                    'deliveryDate'=>$info['deliveryDate'],
                    'isDrewBill'=>in_array($info['id'],$isBillOrderIds) ? 1 : 0
                ];
            }
        }
        return $returnArr;
    }


    //获取列表数据  订单管理
    public function getData()
    {
        $model = self::find()->where(['isValid'=>self::IS_VALID_OK]);
        if(!empty($this->clientName)){
            $client = ClientInfoModel::find()->select('clientId')->where([
                'and',
                ['like','name',$this->clientName],
                ['isValid'=>ClientInfoModel::IS_VALID_OK]
            ])->asArray()->all();
            $clientIds = count($client) > 0 ? array_column($client,'clientId') : [-1];
            $model->andWhere(['clientId'=>$clientIds]);
        }
        if(!empty($this->number)){
            $model->andWhere(['number'=>$this->number]);
        }
        if($this->status > 0){
            $model->andWhere(['status'=>$this->status]);
        }
        if($this->collectionStatus > 0){
            $model->andWhere(['collectionStatus'=>$this->collectionStatus]);
        }
        if(!empty($this->startOrderDate) && !empty($this->endOrderDate)){
            $model->andWhere(['between','orderDate',$this->startOrderDate,$this->endOrderDate]);
        }

        if(!empty($this->startDeliveryDate) && !empty($this->endDeliveryDate)){
            $model->andWhere(['between','deliveryDate',$this->startDeliveryDate,$this->endDeliveryDate]);
        }
        $count = $model->count();
        if(($this->page) > 0 && ($this->pageSize > 1)){
            $model->offset(($this->page - 1) * $this->pageSize)->limit($this->pageSize);
        }
        $data = $model->orderBy('orderDate desc')->asArray()->all();
        return ['count'=>$count,'data'=>$data];
    }

    //订单列表数据   财务管理
    public function getFinanceData()
    {
        $model = self::find()->where(['isValid'=>self::IS_VALID_OK]);
        if(!empty($this->clientName)){
            $client = ClientInfoModel::find()->select('clientId')->where([
                'and',
                ['like','name',$this->clientName],
                ['isValid'=>ClientInfoModel::IS_VALID_OK]
            ])->asArray()->all();
            $clientIds = count($client) > 0 ? array_column($client,'clientId') : [-1];
            $model->andWhere(['clientId'=>$clientIds]);
        }
        if(!empty($this->number)){
            $model->andWhere(['number'=>$this->number]);
        }
        if($this->status > 0){
            $model->andWhere(['status'=>$this->status]);
        }
        if(!empty($this->startOrderDate) && !empty($this->endOrderDate)){
            $model->andWhere(['between','orderDate',$this->startOrderDate,$this->endOrderDate]);
        }

        if(!empty($this->startDeliveryDate) && !empty($this->endDeliveryDate)){
            $model->andWhere(['between','deliveryDate',$this->startDeliveryDate,$this->endDeliveryDate]);
        }
        $count = $model->count();
        if(($this->page) > 0 && ($this->pageSize > 0)){
            $model->offset(($this->page - 1) * $this->pageSize)->limit($this->pageSize);
        }
        $data = $model->orderBy('collectionStatus desc,orderDate desc')->asArray()->all();
        return ['count'=>$count,'data'=>$data];
    }

    public function formatData($data)
    {
        $returnArr = [];
        if(count($data) > 0){
            $orderIds = array_column($data,'id');
            $client = ClientInfoModel::find()->select('clientId,name')
                ->where(['clientId'=>array_column($data,'clientId'),'isValid'=>ClientInfoModel::IS_VALID_OK])
                ->indexBy('clientId')->asArray()->all();
            $statusList = self::$statusList;
            $collectionStatus = self::$collectionStatusList;
            //得到开票的订单
            $needBillOrder = PaymentsModel::find()->select('orderId')->where([
                'orderId'=>$orderIds,'needBill'=>PaymentsModel::RECEIPT_YES,'isValid'=>PaymentsModel::IS_VALID_OK])->asArray()->all();
            $needBillOrderIds = count($needBillOrder) > 0 ? array_column($needBillOrder,'orderId') : [];
            foreach($data as $info){
                $noReceiptPrice = self::amountToYuan(($info['totalPrice'] - $info['receiptPrice']));
                $noReceiptPrice = $noReceiptPrice < 0 ?  0 : $noReceiptPrice;
                $returnArr[] = [
                    'id'=>intval($info['id']),
                    'number'=>$info['number'],
                    'clientId'=>$info['clientId'],
                    'clientName'=>isset($client[$info['clientId']]) ? $client[$info['clientId']]['name'] : '',
                    'totalPrice'=>self::amountToYuan(intval($info['totalPrice'])),
                    'receiptPrice'=>self::amountToYuan(intval($info['receiptPrice'])),
                    'noReceiptPrice'=>$noReceiptPrice,
                    'orderDate'=>$info['orderDate'],
                    'sendDate'=>$info['sendDate'],
                    'deliveryDate'=>$info['deliveryDate'],
                    'status'=>intval($info['status']),
                    'collectionStatus'=>intval($info['collectionStatus']),
                    'statusName'=>isset($statusList[$info['status']]) ? $statusList[$info['status']] : '',
                    'collectionStatusName'=>isset($collectionStatus[$info['collectionStatus']]) ? $collectionStatus[$info['collectionStatus']] : '',
                    'needBill'=>in_array($info['id'],$needBillOrderIds) ? PaymentsModel::RECEIPT_YES : PaymentsModel::RECEIPT_NO,
                    'needBillName'=>in_array($info['id'],$needBillOrderIds) ? '已开票' : '未开票',
                ];
            }
        }
        return $returnArr;
    }

    //格式化导出数据
    public function formatExport($data)
    {
        $returnArr = [];
        if(count($data) > 0){
            $client = ClientInfoModel::find()->select('clientId,name')
                ->where(['clientId'=>array_column($data,'clientId'),'isValid'=>ClientInfoModel::IS_VALID_OK])
                ->indexBy('clientId')->asArray()->all();
            $orderId = array_column($data,'id');
            $detailInfo = SalesOrderDetailModel::find()->where(['orderId'=>$orderId,'isValid'=>SalesOrderDetailModel::IS_VALID_OK])->asArray()->all();
            $orderGoods = [];
            if(count($detailInfo) > 0){
                $goodsIds = array_unique(array_column($detailInfo,'goodsId'));
                $goods = GoodsModel::find()->select('id,name')->where(['id'=>$goodsIds,'isValid'=>GoodsModel::IS_VALID_OK])->indexBy('id')->asArray()->all();
                foreach ($detailInfo as $item) {
                    if(isset($goods[$item['goodsId']])){
                        $orderGoods[$item['orderId']][] = $goods[$item['goodsId']]['name'].':'.$item['num'];
                    }
                }
            }
            foreach ($data as $datum) {
                $returnArr[] = [
                    'number'=>$datum['number'],
                    'clientName'=>isset($client[$datum['clientId']]) ? $client[$datum['clientId']]['name'] : '',
                    'goods'=>isset($orderGoods[$datum['id']]) ? implode('、',$orderGoods[$datum['id']] ): '',
                    'totalPrice'=>SalesOrderModel::amountToYuan($datum['totalPrice']),
                    'orderDate' => $datum['orderDate']
                ];
            }
        }
        return $returnArr;
    }

    //获取详情
    public function getInfo()
    {
        $salesOrder = SalesOrderModel::find()->where(['id'=>$this->id,'isValid'=>SalesOrderModel::IS_VALID_OK])->asArray()->one();
        if(empty($salesOrder)){
            return ['code'=>Code::PARAM_ERR,'msg'=>'订单不存在','info'=>[]];
        }
        $client = ClientInfoModel::find()->select('clientId,name,address')->where(['clientId'=>$salesOrder['clientId'],'isValid'=>ClientInfoModel::IS_VALID_OK])->asArray()->one();
        $detailList = [];
        $orderDetail = SalesOrderDetailModel::find()
            ->select('id,orderId,goodsId,workingId,num,price,isTax,taxPrice')
            ->where(['orderId'=>$this->id,'isValid'=>SalesOrderDetailModel::IS_VALID_OK])->asArray()->all();
        if(count($orderDetail) > 0){
            $goodsIds = array_column($orderDetail,'goodsId');
            $goods = GoodsModel::find()->select('id,name,unit,number,attr')->where(['id'=>$goodsIds,'isValid'=>GoodsModel::IS_VALID_OK])
                ->indexBy('id')->asArray()->all();
            $working = GoodsWorkingProcedureModel::find()->where(['id'=>array_column($orderDetail,'workingId'),'isValid'=>GoodsWorkingProcedureModel::IS_VALID_OK])->indexBy('id')->asArray()->all();
            foreach ($orderDetail as &$item) {
                $item['price'] = SalesOrderModel::amountToYuan($item['price']);
                $item['taxPrice'] = SalesOrderModel::amountToYuan($item['taxPrice']);
                if(isset($goods[$item['goodsId']])){
                    $item['goodsName'] = $goods[$item['goodsId']]['name'];
                    $item['unit'] = $goods[$item['goodsId']]['unit'];
                    $item['number'] = $goods[$item['goodsId']]['number'];
                    $item['attr'] = $goods[$item['goodsId']]['attr'];
                }else{
                    $item['goodsName'] = '';
                    $item['unit'] = '';
                    $item['number'] = '';
                    $item['attr'] = '';
                }
                $item['workingName'] = isset($working[$item['workingId']]) ? $working[$item['workingId']]['name'] : '';
            }
            $detailList = $orderDetail;
        }
        $statusList = SalesOrderModel::$statusList;
        $salesOrder['statusName'] = isset($statusList[$salesOrder['status']]) ? $statusList[$salesOrder['status']] : '';
        $salesOrder['clientName'] = !empty($client) ? $client['name'] : '';
        $salesOrder['detailList'] = $detailList;
        $salesOrder['totalPrice'] = SalesOrderModel::amountToYuan(intval($salesOrder['totalPrice']));
        $salesOrder['receiptPrice'] = SalesOrderModel::amountToYuan(intval($salesOrder['receiptPrice']));
        $salesOrder['fileUrl'] = !empty($salesOrder['fileUrl']) ? Json::decode($salesOrder['fileUrl']) : [];
        $clientAddress = $salesOrder['clientAddress'];//客户地址
        if(empty($clientAddress)){
            $clientAddress = !empty($client) ? $client['address'] : '';
        }
        $salesOrder['clientAddress'] = $clientAddress;
        return ['code'=>Code::SUCCESS,'msg'=>'ok','info'=>$salesOrder];
    }

    //生产完成
    public function proComplete()
    {
        if($this->id <= 0){
            return ['code'=>Code::PARAM_ERR,'msg'=>'订单id为空'];
        }
        $info = SalesOrderModel::find()->where(['id'=>$this->id,'isValid'=>SalesOrderModel::IS_VALID_OK])->one();
        if(empty($info)){
            return ['code'=>Code::PARAM_ERR,'msg'=>'订单不存在'];
        }
        $info->status = SalesOrderModel::STATUS_PRODUCTION_COMPLETE;
        if(!$info->save()){
            return ['code'=>Code::PARAM_ERR,'msg'=>'修改失败'];
        }
        return ['code'=>Code::SUCCESS,'msg'=>'修改成功'];
    }


    //发货
    public function send()
    {
        $houseId = 1;//仓库默认1
        $info = SalesOrderModel::find()->where(['id'=>$this->id,'isValid'=>SalesOrderModel::IS_VALID_OK])->one();
        if(empty($info)){
            return ['code'=>Code::PARAM_ERR,'msg'=>'订单不存在'];
        }
        if(intval($info->status) !== SalesOrderModel::STATUS_PRODUCTION_COMPLETE){
            return ['code'=>Code::PARAM_ERR,'msg'=>'只有生产完成才能发货'];
        }
        $tran = Yii::$app->db->beginTransaction();
        try{
            $info->clientPersonId = $this->clientPersonId;
            $info->sendDate = $this->sendDate;
            $info->sendWay = $this->sendWay;
            $info->clientAddress = $this->clientAddress;
            $info->status = SalesOrderModel::STATUS_SEND;
            $info->save();
            //添加发货记录
            $sendInfo = SendGoodsModel::find()->where(['orderId'=>$this->id,'isValid'=>SendGoodsModel::IS_VALID_OK])->one();
            if(empty($sendInfo)){
                $sendInfo = new SendGoodsModel();
            }
            $sendInfo->goodsType = GoodsModel::TYPE_PRODUCTION;
            $sendInfo->orderId = $this->id;
            $sendInfo->houseId = $houseId;
            $sendInfo->sendDate = $this->sendDate;
            $sendInfo->sn = date('ymd');
            $sendInfo->remark = '订单发货添加';
            $sendInfo->userName = Yii::$app->user->identity['userAccount'];
            if(!$sendInfo->save()){
                throw  new \Exception('发货记录添加失败',Code::PARAM_ERR);
            }
            $sendId = $sendInfo->sendId;
            $orderDetail = SalesOrderDetailModel::find()->where(['orderId'=>$this->id,'isValid'=>SalesOrderDetailModel::IS_VALID_OK])->asArray()->all();
            if(!empty($orderDetail)){
                $goods = GoodsModel::find()->where(['isValid'=>GoodsModel::IS_VALID_OK])->indexBy('id')->asArray()->all();
                $working = GoodsWorkingProcedureModel::find()->where(['isValid'=>GoodsWorkingProcedureModel::IS_VALID_OK])->indexBy('id')->asArray()->all();
                foreach ($orderDetail as $item) {
                    $goodsId = intval($item['goodsId']);
                    $workingId = intval($item['workingId']);
                    $num = intval($item['num']);
                    if(!isset($goods[$goodsId]) || !isset($working[$workingId])){
                        throw  new \Exception('商品或工序不存在',Code::PARAM_ERR);
                    }
                    $goodsName = $goods[$goodsId]['name'];
                    $workingName = $working[$workingId]['name'];
                    if(isset($goods[$goodsId])){
                        $goodsInfo = $goods[$goodsId];
                        //发货详情记录
                        $sendDetail = new SendGoodsDetailModel();
                        $sendDetail->goodsType = GoodsModel::TYPE_PRODUCTION;
                        $sendDetail->sendId = $sendId;
                        $sendDetail->goodsId = $goodsId;
                        $sendDetail->workingId = $workingId;
                        $sendDetail->num = $num;
                        if(!$sendDetail->save()){
                            throw  new \Exception('发货记录详情添加失败',Code::PARAM_ERR);
                            break;
                        }
                        //流水记录
                        $stockRecord = new StockRecordModel();
                        $stockRecord->goodsType = GoodsModel::TYPE_PRODUCTION;
                        $stockRecord->wareHouseId = $houseId;
                        $stockRecord->goodsId = $goodsId;
                        $stockRecord->workingId = $workingId;
                        $stockRecord->num = $num;
                        $stockRecord->type = StockRecordModel::TYPE_SALE;
                        $stockRecord->unionId = $sendId;
                        $stockRecord->remark = '订单发货-销售';
                        $stockRecord->userName = Yii::$app->user->identity['userAccount'];
                        $stockRecord->date = $this->sendDate;
                        if(!$stockRecord->save()){
                            throw  new \Exception('流水记录添加失败',Code::PARAM_ERR);
                            break;
                        }
                        //更新库存
                        $stock = GoodsStockModel::find()->where(['goodsId'=>$goodsId,'workingId'=>$workingId,'wareHouseId'=>$houseId,'isValid'=>GoodsStockModel::IS_VALID_OK])->one();
                        if(empty($stock)){
                            $stock = new GoodsStockModel();
                           /* throw  new \Exception($goodsName.'-'.$workingName.'无库存无法发货',Code::PARAM_ERR);
                            break;*/
                        }
                        $stock->wareHouseId = $houseId;
                        $stock->goodsId = $goodsId;
                        $stock->workingId = $workingId;
                        $updateNum =  $stock->num - $num;
                      /*  if($updateNum < 0){
                            throw  new \Exception($goodsName.'-'.$workingName.'库存不够',Code::PARAM_ERR);
                            break;
                        }*/
                        $stock->num = $updateNum;
                        if(!$stock->save()){
                            throw  new \Exception($goodsName.'-'.$workingName.'库存更新失败',Code::PARAM_ERR);
                            break;
                        }
                    }
                }
            }
            $tran->commit();
        }catch(\Exception $e){
            $tran->rollBack();
            Yii::info('----send order fail--'.$e->getMessage().'---file--'.$e->getFile().'---line--'.$e->getLine());
            $msg = $e->getCode() === Code::PARAM_ERR ? $e->getMessage() : '发货失败';
            return ['code'=>Code::PARAM_ERR,'msg'=>$msg];
        }
        return ['code'=>Code::SUCCESS,'msg'=>'发货完成'];
    }

}