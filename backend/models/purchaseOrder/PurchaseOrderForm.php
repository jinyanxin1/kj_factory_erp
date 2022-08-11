<?php
/**
 *
 * author: jinyanxin
 * Date: 2020/9/3
 * Time: 15:01
 * PHP version 7
 */

namespace backend\models\purchaseOrder;


use common\library\helper\Code;
use common\models\purchaseOrder\PurchaseOrderModel;
use common\models\supplier\SupplierInfoModel;
use common\models\User;
use Yii;

class PurchaseOrderForm extends PurchaseOrderModel
{
    public $detailList;//采购单副表详情
    public $page=1;
    public $pageSize=10;
    public $startOrderDate;
    public $endOrderDate;
    public $startShipmentDate;
    public $endShipmentDate;
    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['orderDate'], 'required','message'=>'{attribute}必填'],
            [['id','orderDate','shipmentDate','detailList','price','startOrderDate','endOrderDate','startShipmentDate','endShipmentDate','page','pageSize'], 'safe'],
            [['userId','wareHouseId', 'supplierId', 'status'], 'integer'],
            [['number', 'wareHouseContacts', 'supplierContacts'], 'string', 'max' => 32],
            [['wareHouseAddress', 'supplierAddress'], 'string', 'max' => 50],
            [['wareHouseTel', 'supplierTel'], 'string', 'max' => 11],
            [['wareHouseTel','supplierTel'],'match','pattern'=>'/^1([38]\d|5[0-35-9]|7[3678])\d{8}$/','message'=>'{attribute}不正确'],
            [['describe'], 'string', 'max' => 225],
        ];
    }


    public function saveInfo()
    {
        if(!$this->validate()){
            $firstItem = current($this->getErrors());
            return ['code'=>Code::PARAM_ERR,'msg'=>$firstItem[0]];
        }
        if(count($this->detailList) <= 0){
            return ['code'=>Code::PARAM_ERR,'msg'=>'采购物品为空'];
        }
        if($this->id > 0){
            $info = self::getById($this->id,false);
            if(empty($info)){
                return ['code'=>Code::PARAM_ERR,'msg'=>'订单不存在'];
            }
        }else{
            $info = new self();
            $this->number = self::getNumber(self::ORDER_PREFIX);
        }

        //采购单主表，副表都需要加数据
        $transaction = Yii::$app->db->beginTransaction();
        try{
            //采购单总金额转化
            $this->price = self::amountToCent($this->price);
            //采购单状态保存 默认未审批
            $this->status = !empty($this->status) ? $this->status : self::STATUS_EXAMINE_NO;
            //保存采购单主表数据
            $info->attributes = $this->attributes;
            $info->save();

            $this->id = $info->id;
            //保存采购单详情表数据
            foreach ($this->detailList as $detailInfo){
                $orderDetail = new PurchaseOrderDetailForm();
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
            Yii::info('purchase order save fail error msg:'.$e->getMessage(),'purchaseOrder');
            $errorMsg = $e->getCode() === Code::PARAM_ERR ? $e->getMessage() : '保存失败';
            return ['code'=>Code::PARAM_ERR,'msg'=>$errorMsg];
        }
        return ['code'=>Code::SUCCESS,'msg'=>'保存成功'];
    }



    public function getData()
    {
        $model = self::find()->where(['isValid'=>self::IS_VALID_OK]);
        if(!empty($this->number)){
            $model->andWhere(['number'=>$this->number]);
        }
        if($this->wareHouseId > 0){
            $model->andWhere(['wareHouseId'=>$this->wareHouseId]);
        }
        if($this->status > 0){
            $model->andWhere(['status'=>$this->status]);
        }
        if(!empty($this->startOrderDate)){
            $model->andWhere(['>=','orderDate',$this->startOrderDate]);
        }
        if(!empty($this->endOrderDate)){
            $model->andWhere(['<=','orderDate',$this->endOrderDate]);
        }
        if(!empty($this->startShipmentDate)){
            $model->andWhere(['>=','shipmentDate',$this->startShipmentDate]);
        }
        if(!empty($this->endShipmentDate)){
            $model->andWhere(['<=','shipmentDate',$this->endShipmentDate]);
        }
        $count = $model->count();
        $data = $model->offset(($this->page - 1) * $this->pageSize)->limit($this->pageSize)->orderBy('orderDate desc')->asArray()->all();
        return ['count'=>$count,'data'=>$data];
    }


    public function formatData($data)
    {
        $returnArr = [];
        if(count($data) > 0){
            //获取下单人名字
            $user = User::find()->select('id,userName')->where(['id'=>array_column($data,'userId'),'isValid'=>User::IS_VALID_OK])->indexBy('id')->asArray()->all();
            $statusList = self::$statusList;
            $supplier = SupplierInfoModel::find()->select('id,userName')->where(['id'=>array_column($data,'supplierId'),'isValid'=>SupplierInfoModel::IS_VALID_OK])->indexBy('id')->asArray()->all();
            foreach($data as $info){
                $returnArr = [
                    'id'=>intval($info['id']),
                    'number'=>$info['number'],
                    'orderDate'=>$info['orderDate'],
                    'shipmentDate'=>$info['shipmentDate'],
                    'price'=>self::amountToYuan(intval($info['price'])),
                    'userName'=>isset($user[$info['userId']]) ? $user[$info['userId']]['userName'] : '',
                    'status'=>intval($info['status']),
                    'statusName'=>isset($statusList[intval($info['status'])]) ? $statusList[intval($info['status'])] : '',
                    'describe'=>$info['describe'],
                    'supplierName'=>isset($supplier[$info['supplierId']]) ? $supplier[$info['supplierId']]['userName'] : ''
                ];
            }
        }
        return $returnArr;
    }

}