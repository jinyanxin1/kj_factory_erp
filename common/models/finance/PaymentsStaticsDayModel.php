<?php
/**
 *
 * author: jinyanxin
 * Date: 2020/9/9
 * Time: 10:30
 * PHP version 7
 *  财务记录统计日表
 */

namespace common\models\finance;


use common\models\BaseModel;
use common\models\project\ProjectInfoModel;
use Yii;

/**
 * This is the model class for table "kj_payments_statics_day".
 *
 * @property int $id
 * @property int|null $type 1收入；2支出
 * @property string|null $day 统计日期
 * @property int|null $amount 金额
 * @property int|null $accountId 账户id
 * @property string|null $creator
 * @property string|null $createTime
 * @property string|null $updater
 * @property string|null $updateTime
 * @property int|null $isValid
 */
class PaymentsStaticsDayModel extends BaseModel
{
    //1收入；2支出
    const TYPE_INCOME = 1;
    const TYPE_EXPENDITURE = 2;
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'kj_payments_statics_day';
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'type' => '类型',
            'day' => '统计日期',
            'amount' => '金额',
            'accountId' => '账户id',
            'creator' => 'Creator',
            'createTime' => 'Create Time',
            'updater' => 'Updater',
            'updateTime' => 'Update Time',
            'isValid' => 'Is Valid',
        ];
    }

    /*
     * 根据日期，统计当天的收入，支出总金额
     * */
    public static function statisticsDay($date)
    {
        if(empty($date)){
            return false;
        }
        $startTime = date('Y-m-d 00:00:00',strtotime($date));
        $endTime = date('Y-m-d 23:59:59',strtotime($date));

        $paymentsLog = PaymentsModel::find()
            ->where(['isValid'=>PaymentsModel::IS_VALID_OK])
            ->andWhere(['and',['>=','date',$startTime],['<=','date',$endTime]])
            ->asArray()->all();
        if(count($paymentsLog) > 0){
            foreach ($paymentsLog as $log){
                $incomeAccount = 0;
                $expenditureAccount = 0;
                $type = intval($log['type']);
                if($type === PaymentsModel::TYPE_INCOME){
                    //收入
                    $incomeAccount = $log['incomeAccount'];
                }else if($type === PaymentsModel::TYPE_EXPENDITURE){
                    //支出
                    $expenditureAccount = $log['expenditureAccount'];
                }else if($type === PaymentsModel::TYPE_TRANS){
                    //转账
                    $incomeAccount = $log['incomeAccount'];
                    $expenditureAccount = $log['expenditureAccount'];
                }else{
                    Yii::info('statics day payments fail error msg type no exist date--'.$date.'---logInfo'.print_r($log,true),'paymentsStaticsDay');
                }
                //收入
                if($incomeAccount > 0){
                    $income = self::find()->where(['day'=>$date,'type'=>self::TYPE_INCOME,'accountId'=>$incomeAccount,'isValid'=>self::IS_VALID_OK])->one();
                    if(empty($income)){
                        $income = new self();
                        $amount = 0;
                    }else{
                        $amount = intval($income->amount);
                    }
                    $income->accountId = $incomeAccount;
                    $income->day = $date;
                    $income->amount = $amount + $log['amount'];
                    $income->type = self::TYPE_INCOME;
                    if(!$income->save()){
                        Yii::info('statics day payments fail date--'.$date.'---logInfo'.print_r($log,true),'paymentsStaticsDay');
                    }
                }
                //支出
                if($expenditureAccount > 0){
                    $expenditure = self::find()->where(['day'=>$date,'type'=>self::TYPE_EXPENDITURE,'accountId'=>$expenditureAccount,'isValid'=>self::IS_VALID_OK])->one();
                    if(empty($expenditure)){
                        $expenditure = new self();
                        $exAmount = 0;
                    }else{
                        $exAmount = intval($expenditure->amount);
                    }
                    $expenditure->accountId = $expenditureAccount;
                    $expenditure->day = $date;
                    $expenditure->amount = $log['amount'] + $exAmount;
                    $expenditure->type = self::TYPE_EXPENDITURE;
                    if(!$expenditure->save()){
                        Yii::info('statics day payments fail date--'.$date.'---logInfo'.print_r($log,true),'paymentsStaticsDay');
                    }
                }
            }
        }

        //更新账户的收入支出
        $totalAmountData = self::find()->select('type,amount,accountId')->where(['isValid'=>self::IS_VALID_OK])->asArray()->all();
        if(count($totalAmountData) > 0){
            foreach($totalAmountData as $totalAmount){
                $account = PaymentsAccountModel::find()->where(['id'=>$totalAmount['accountId'],'isValid'=>PaymentsAccountModel::IS_VALID_OK])->one();
                if(!empty($account)){
                    if(intval($totalAmount['type']) === self::TYPE_INCOME){
                        $account->incomeAmount = $account->incomeAmount + $totalAmount['amount'];

                    }else if(intval($totalAmount['type']) === self::TYPE_EXPENDITURE){
                        $account->expenditureAmount = $account->expenditureAmount + $totalAmount['amount'];
                    }
                    $account->save();
                }
            }
        }

        //更新项目收支金额
        $totalProject = PaymentsModel::find()->select('type,amount,projectId')->where(['isValid'=>self::IS_VALID_OK])->asArray()->all();
        if(count($totalProject) > 0){
            foreach($totalProject as $projectAmount){
                $project = ProjectInfoModel::find()->where(['id'=>$projectAmount['projectId'],'isValid'=>PaymentsAccountModel::IS_VALID_OK])->one();
                if(!empty($project)){
                    if(intval($projectAmount['type']) === self::TYPE_INCOME){
                        $project->receiptPrice = $project->receiptPrice + $projectAmount['amount'];

                    }else if(intval($projectAmount['type']) === self::TYPE_EXPENDITURE){
                        $project->expenditurePrice = $project->expenditurePrice + $projectAmount['amount'];
                    }
                    $account->save();
                }
            }
        }
        return true;
    }


}