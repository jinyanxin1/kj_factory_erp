<?php
/**
 *
 * author: jinyanxin
 * Date: 2020/11/18
 * Time: 10:51
 * PHP version 7
 * 生产入库主表
 */

namespace common\models\purchase\inStorage;


use common\library\helper\Code;
use common\models\BaseModel;
use common\models\goods\GoodsModel;
use Yii;

/**
 * This is the model class for table "kj_goods_in_storage".
 *
 * @property int $storageId
 * @property int|null $workId 职工工单id
 * @property int|null $goodsType 1产品；2物料
 * @property int|null $houseId 仓库id
 * @property string|null $storageDate 入库日期
 * @property string $sn 编号
 * @property int $totalAmount 金额
 * @property string|null $remark 备注
 * @property string|null $userName 经手人
 * @property string|null $supplier 供应商
 * @property int|null $staffId 职工id
 * @property string|null $createTime 创建时间
 * @property string|null $creator 创建者
 * @property string|null $updateTime 修改时间
 * @property string|null $updater 修改者
 * @property int|null $isValid 0正常，1删除
 */

class GoodsInStorageModel extends BaseModel
{
    const SN_PRIX = 'STORE';
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'kj_goods_in_storage';
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'storageId' => 'Storage ID',
            'workId' => '职工工单id',
            'goodsType' => '1产品；2物料',
            'houseId' => '仓库id',
            'storageDate' => '入库日期',
            'sn' => '编号',
            'totalAmount' => '金额',
            'remark' => '备注',
            'userName' => '经手人',
            'supplier' => '供应商',
            'staffId' => '职工id',
            'createTime' => '创建时间',
            'creator' => '创建者',
            'updateTime' => '修改时间',
            'updater' => '修改者',
            'isValid' => '0正常，1删除',
        ];
    }

    /*
     * 保存生产入库信息
     * storageId 主键id
     * houseId  仓库id
     * date  日期
     * data  产品记录
     * remark 备注
     * userName 经手人
     * staffId 职工id
     *
     * 生产入库主表，详情表加数据，流水表加数据，产品库存增加，物料减少
     * */
    public function saveData($storageId,$houseId,$date,$remark,$data,$userName,$staffId)
    {
        $tran = Yii::$app->db->beginTransaction();
        try{
            if($storageId > 0){
                $storageInfo = self::find()->where(['storageId'=>$storageId,'isValid'=>self::IS_VALID_OK])->one();
                if(empty($storageInfo)){
                    throw new \Exception('生产记录不存在');
                }
            }else{
                $storageInfo = new self();
            }
            $storageInfo->goodsType = GoodsModel::TYPE_PRODUCTION;
            $storageInfo->houseId = $houseId;
            $storageInfo->storageDate = $date;
            $storageInfo->sn = self::getNumber(self::SN_PRIX);
            $storageInfo->totalAmount = 0;
            $storageInfo->remark = $remark;
            $storageInfo->userName = $userName;
            $storageInfo->staffId = $staffId;
            if(!$storageInfo->save()){
                throw new \Exception('生产记录保存失败');
            }
            $storageId = $storageInfo->storageId;
            //保存详情记录
            $saveDetail = GoodsInStorageDetailModel::saveData($houseId,$data,$storageId,$remark,$userName,$date,$staffId);
            if($saveDetail['code'] !== Code::SUCCESS){
                throw  new \Exception($saveDetail['msg']);
            }
            $tran->commit();
        }catch (\Exception $e){
            $tran->rollBack();
            Yii::info('production in storage fail ---'.$e->getMessage().'--file--'.$e->getFile().'---line-'.$e->getLine());
            return ['code'=>Code::PARAM_ERR,'msg'=>$e->getMessage()];
        }
        return ['code'=>Code::SUCCESS,'msg'=>'ok'];
    }


}