<?php
/**
 *
 * author: jinyanxin
 * Date: 2020/11/18
 * Time: 11:47
 * PHP version 7
 * 生产物料消耗主表
 */
namespace common\models\purchase\consumption;

use common\library\helper\Code;
use common\models\BaseModel;
use common\models\goods\GoodsModel;
use Yii;

/**
 * This is the model class for table "kj_goods_production_consumption".
 *
 * @property int $consumptionId
 * @property int|null $goodsType 1产品；2物料
 * @property int|null $houseId 仓库id
 * @property string|null $consumptionDate 生产消耗日期
 * @property string $sn 编号
 * @property int $totalAmount 金额
 * @property string|null $remark 备注
 * @property string|null $userName 经手人
 * @property string|null $supplier 供应商
 * @property int|null $staffId 职工id
 * @property int|null $storageId 生产入库id
 * @property string|null $createTime 创建时间
 * @property string|null $creator 创建者
 * @property string|null $updateTime 修改时间
 * @property string|null $updater 修改者
 * @property int|null $isValid 0正常，1删除
 */
class GoodsConsumptionModel extends BaseModel
{
    const SN_PRIX = 'CON';
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'kj_goods_production_consumption';
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'consumptionId' => 'Consumption ID',
            'goodsType' => '1产品；2物料',
            'houseId' => '仓库id',
            'consumptionDate' => '生产消耗日期',
            'sn' => '编号',
            'totalAmount' => '金额',
            'remark' => '备注',
            'userName' => '经手人',
            'supplier' => '供应商',
            'staffId' => '职工id',
            'storageId' => '生产入库id',
            'createTime' => '创建时间',
            'creator' => '创建者',
            'updateTime' => '修改时间',
            'updater' => '修改者',
            'isValid' => '0正常，1删除',
        ];
    }

    /*
     * 保存物料消耗信息
     * data=>['houseId'=>,'date'=>,'remark'=>,'userName'=>,'staffId'=>,'storageId'=>,'consumptionId'=>,'data'=>]
     *
     * */
    public function saveData($houseId,$date,$remark,$userName,$staffId,$storageId,$consumptionId,$data)
    {
        $logData = ['houseId'=>$houseId,'date'=>$date,'remark'=>$remark,'userName'=>$userName,'staffId'=>$staffId,'storageId'=>$storageId,'consumptionId'=>$consumptionId,'data'=>$data];
        Yii::info('----save consumption data---'.print_r($logData,true));
        if($consumptionId > 0){
            $consumptionInfo = GoodsConsumptionModel::find()->where(['consumptionId'=>$consumptionId,'isValid'=>GoodsConsumptionModel::IS_VALID_OK])->one();
            if(empty($consumptionInfo)){
                return ['code'=>Code::PARAM_ERR,'msg'=>'消耗记录不存在'];
            }
        }else{
            $consumptionInfo = GoodsConsumptionModel::find()->where(['storageId'=>$storageId,'isValid'=>GoodsConsumptionModel::IS_VALID_OK])->one();
            if(empty($consumptionInfo)){
                $consumptionInfo = new GoodsConsumptionModel();
            }
        }
        $consumptionInfo->goodsType = GoodsModel::TYPE_MATERIEL;
        $consumptionInfo->houseId = $houseId;
        $consumptionInfo->consumptionDate = $date;
        $consumptionInfo->sn = GoodsConsumptionModel::getNumber(self::SN_PRIX);
        $consumptionInfo->totalAmount = 0;
        $consumptionInfo->remark = $remark;
        $consumptionInfo->userName = $userName;
        $consumptionInfo->staffId = $staffId;
        if(!$consumptionInfo->save()){
            return ['code'=>Code::PARAM_ERR,'msg'=>'消耗记录保存失败'];
        }
        $consumptionId = $consumptionInfo->consumptionId;
        //保存消耗详情记录
    }


}