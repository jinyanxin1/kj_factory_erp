<?php
/**
 *
 * author: jinyanxin
 * Date: 2020/9/7
 * Time: 10:52
 * PHP version 7
 * 收支记录
 */

namespace backend\models\finance;


use common\library\helper\Code;
use common\models\clientInfo\ClientInfoModel;
use common\models\finance\PaymentsAccountModel;
use common\models\finance\PaymentsModel;
use common\models\finance\PaymentsTypeModel;
use common\models\project\ProjectInfoModel;
use common\models\salesOrder\SalesOrderModel;
use common\models\system\section\SectionModel;

class PaymentsForm extends PaymentsModel
{
    public $pageSize = 10;
    public $page = 1;

    public $startTime;
    public $endTime;


    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['type', 'departmentId', 'paymentsTypeId', 'incomeAccount', 'expenditureAccount', 'orderId', 'clientId', 'objectId'], 'integer'],
            [['type','date'],'required','message'=>'{attribute}必填'],
            [['id','amount','page','pageSize','startTime','endTime','needBill'], 'safe'],
            [['type'],'number','min'=>1],
            [['describe'], 'string', 'max' => 100],
        ];
    }

    /*
     * 保存信息
     * 更新订单的收入金额
     * */
    public function saveInfo()
    {
        if(!$this->validate()){
            $firstItem = current($this->getErrors());
            return ['code'=>Code::PARAM_ERR,'msg'=>$firstItem[0]];
        }
        if(intval($this->type) === PaymentsModel::TYPE_TRANS){
            //转账时，转入，转出账户不能一样
            if($this->incomeAccount == $this->expenditureAccount){
                return ['code'=>Code::PARAM_ERR,'msg'=>'转账时，账户不能一样'];
            }
        }
        $tran = \Yii::$app->db->beginTransaction();
        try{
            if($this->id > 0){
                $info = PaymentsModel::getById($this->id,false);
                if(empty($info)){
                    throw new \Exception('记录不存在',Code::PARAM_ERR);
                }
                $updateAmount = $this->amount - $info->amount;
            }else{
                $info = new PaymentsModel();
                $updateAmount = $this->amount;
            }
            $info->type = $this->type;
            $info->needBill = $this->needBill;
            $info->departmentId = $this->departmentId;
            $info->date = $this->date;
            $info->paymentsTypeId = $this->paymentsTypeId;
            $info->incomeAccount = $this->incomeAccount;
            $info->expenditureAccount = $this->expenditureAccount;
            $info->amount = PaymentsModel::amountToCent($this->amount);
            $info->describe = $this->describe;
            $info->orderId = $this->orderId;
            $info->clientId = $this->clientId;
            $info->objectId = $this->objectId;
            $info->save();

            //更新订单金额
            if($this->orderId > 0){
                $updateAmount = SalesOrderModel::amountToCent($updateAmount);
                $orderInfo = SalesOrderModel::find()->where(['id'=>$this->orderId,'clientId'=>$this->clientId,'isValid'=>SalesOrderModel::IS_VALID_OK])->one();
                if(empty($orderInfo)){
                    throw new \Exception('订单不存在',Code::PARAM_ERR);
                }
                if($this->type == PaymentsModel::TYPE_INCOME){
                    if(($orderInfo->receiptPrice + $updateAmount) >= ($orderInfo->totalPrice)){
                        $orderInfo->collectionStatus = SalesOrderModel::COLLECTION_STATUS_YES;
                    }
                    //收入
                    $orderInfo->receiptPrice = $orderInfo->receiptPrice + $updateAmount;
                }else if($this->type == PaymentsModel::TYPE_EXPENDITURE){
                    //支出
                    $orderInfo->expenditureAmount = $orderInfo->expenditureAmount + $updateAmount;
                }
                $orderInfo->save();
            }
            //todo 更新账户金额
            if($this->incomeAccount > 0){
                $incomeAccountInfo = PaymentsAccountModel::getById($this->incomeAccount,false);
                if(empty($incomeAccountInfo)){
                    throw  new \Exception('收入账户不存在',Code::PARAM_ERR);
                }
                $incomeAccountInfo->incomeAmount = $incomeAccountInfo->incomeAmount + PaymentsModel::amountToCent($this->amount);
                $incomeAccountInfo->save();
            }
            if($this->expenditureAccount > 0){
                $expenditureAccountInfo = PaymentsAccountModel::getById($this->expenditureAccount,false);
                if(empty($expenditureAccountInfo)){
                    throw  new \Exception('支出账户不存在',Code::PARAM_ERR);
                }
                $expenditureAccountInfo->expenditureAmount = $expenditureAccountInfo->expenditureAmount + PaymentsAccountModel::amountToCent($this->amount);
                $expenditureAccountInfo->save();
            }
            $tran->commit();
        }catch (\Exception $e){
            $tran->rollBack();
            \Yii::info('save payments log fail---'.$e->getMessage().'--file'.$e->getFile().'--line'.$e->getLine());
            $msg = $e->getCode() === Code::PARAM_ERR ? $e->getMessage() : '保存失败';
            return ['code'=>Code::PARAM_ERR,'msg'=>$msg];
        }
        return ['code'=>Code::SUCCESS,'msg'=>'保存成功'];
    }

    public function getData()
    {
        $model = self::find()->where(['isValid'=>self::IS_VALID_OK]);
        if($this->type > 0){
            $model->andWhere(['type'=>$this->type]);
        }
        if($this->startTime > 0){
            $model->andWhere(['>=','date',$this->startTime]);
        }
        if($this->endTime > 0){
            $model->andWhere(['<=','date',$this->endTime]);
        }
        $count = $model->count();
        $data = $model->offset(($this->page - 1) * $this->pageSize)->limit($this->pageSize)->orderBy('id desc')->asArray()->all();
        return ['count'=>$count,'data'=>$data];
    }

    public function formatData($data)
    {
        $returnArr = [];
        if(count($data) > 0){
            $department = SectionModel::find()->select('sectionId,name')
                ->where(['sectionId'=>array_column($data,'departmentId'),'isValid'=>SectionModel::IS_VALID_OK])
                ->indexBy('sectionId')->asArray()->all();
            $paymentsType = PaymentsTypeForm::find()->select('id,name')
                ->where(['id'=>array_column($data,'paymentsTypeId'),'isValid'=>PaymentsTypeForm::IS_VALID_OK])
                ->indexBy('id')->asArray()->all();
            $account = PaymentsAccountModel::find()->select('id,name')
                ->where(['id'=>array_merge(array_column($data,'incomeAccount'),array_column($data,'expenditureAccount')),'isValid'=>PaymentsAccountModel::IS_VALID_OK])
                ->indexBy('id')->asArray()->all();
            $order = SalesOrderModel::find()->select('id,number,contractCode')
                ->where(['id'=>array_unique(array_column($data,'orderId')),'isValid'=>SalesOrderModel::IS_VALID_OK])
                ->indexBy('id')->asArray()->all();
            $client = ClientInfoModel::find()->select('clientId,name')
                ->where(['clientId'=>array_column($data,'clientId'),'isValid'=>ClientInfoModel::IS_VALID_OK])
                ->indexBy('clientId')->asArray()->all();
            $type = PaymentsModel::$typeList;
            foreach ($data as $info){
                $returnArr[] = [
                    'id'=>intval($info['id']),
                    'type'=>intval($info['type']),
                    'typeName'=>isset($type[$info['type']]) ? $type[$info['type']] : '',
                    'department'=>isset($department[$info['departmentId']]) ? $department[$info['departmentId']]['name'] : '',
                    'date'=>$info['date'],
                    'paymentsTypeId'=>intval($info['paymentsTypeId']),
                    'paymentsType'=>isset($paymentsType[$info['paymentsTypeId']]) ? $paymentsType[$info['paymentsTypeId']]['name'] : '',
                    'incomeAccountName'=>isset($account[$info['incomeAccount']]) ? $account[$info['incomeAccount']]['name'] : '',
                    'expenditureAccount'=>isset($account[$info['expenditureAccount']]) ? $account[$info['expenditureAccount']]['name'] : '',
                    'amount'=>self::amountToYuan(intval($info['amount'])),
                    'describe'=>$info['describe'],
                    'clientName'=>isset($client[$info['clientId']]) ? $client[$info['clientId']]['name'] : '',
                    'number'=>isset($order[$info['orderId']]) ? $order[$info['orderId']]['number'] : '',
                    'contactCode'=>isset($order[$info['orderId']]) ? $order[$info['orderId']]['contractCode'] : '',
                    'createTime'=>$info['createTime']
                ];
            }
        }
        return $returnArr;
    }


    public function getSaveConfig()
    {
        //部门数据
        $department = SectionModel::find()->select('sectionId,name')->where(['isValid'=>SectionModel::IS_VALID_OK])->asArray()->all();
        //账户数据
        $account = PaymentsAccountModel::find()->select('id,name')->where(['isValid'=>PaymentsAccountModel::IS_VALID_OK])->asArray()->all();
        //收入类别
        $paymentsTypeIncome = PaymentsTypeModel::find()->select('id,name')->where(['type'=>PaymentsTypeModel::TYPE_INCOME,'isValid'=>PaymentsTypeModel::IS_VALID_OK])->asArray()->all();
        //支出类别
        $paymentsTypeExpenditure = PaymentsTypeModel::find()->select('id,name')->where(['type'=>PaymentsTypeModel::TYPE_EXPENDITURE,'isValid'=>PaymentsTypeModel::IS_VALID_OK])->asArray()->all();
        return [
            'department'=>$department,
            'account'=>$account,
            'paymentsTypeIncome'=>$paymentsTypeIncome,
            'paymentsTypeExpenditure'=>$paymentsTypeExpenditure,
        ];
    }

}