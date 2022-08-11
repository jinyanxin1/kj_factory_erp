<?php
/**
 * @Author: jinyanxin
 * @Date: 2020/2/5
 * @Time: 9:58
 * 进货主表
 */


namespace common\models\purchase;


use common\library\helper\Code;
use common\models\BaseForm;
use common\models\BaseModel;
use common\models\goods\GoodsModel;
use common\models\stock\StockModel;
use common\models\stock\StockRecordModel;
use yii\db\Exception;
use yii\web\IdentityInterface;

class PurchaseModel  extends BaseModel
{

    public static function tableName()
    {
        return 'jxt_jxc_purchase';
    }

    //根据id得到数据
    public static function getById($id,$isArr = true)
    {
        $info = self::find()->where(['purchaseId'=>$id,'isValid'=>self::IS_VALID_OK]);
        if($isArr === true){
            $info->asArray();
        }
        return $info->one();
    }

    /*
     * 根据id删除记录：主表，详情表都删除
     * 库存要更新，库存记录要删除
     * */
    public static function delById($id)
    {
        $bol = true;
        $transaction = \Yii::$app->db->beginTransaction();
        try{
            $purchaseInfo = PurchaseModel::getById($id,true);
            if($purchaseInfo === null){
                throw new Exception('----进货主记录未找到--');
            }
            $houseId = $purchaseInfo['houseId'];
            $purchaseDetail = PurchaseDetailModel::getDataByPurchaseId($id);
            if(count($purchaseDetail) > 0){
                foreach($purchaseDetail as $info){
                    $num = intval($info['num']);
                    $goodsId = intval($info['goodsId']);
                    if($goodsId > 0){
                        $goods = GoodsModel::getById($goodsId);
                        if(!empty($goods)){
                            $stock = StockModel::find()->where(['warehouseId'=>$houseId,'goodsId'=>$goodsId,'isValid'=>StockModel::IS_VALID_OK])->one();
                            if($stock === null){
                                $bol = false;
                                break;
                            }
                            $stock->stockNum = $stock->stockNum - $num;
                            if(intval($stock->stockNum) < 0){
                                throw  new \Exception('记录删除后库存小于0，删除失败');
                                break;
                            }
                            if(!$stock->save()){
                                $bol = false;
                                break;
                            }
                        }
                    }
                }
            }
            PurchaseModel::updateAll(['isValid'=>self::IS_VALID_NO],['purchaseId'=>$id]);
            PurchaseDetailModel::updateAll(['isValid'=>PurchaseDetailModel::IS_VALID_NO],['purchaseId'=>$id]);
            StockRecordModel::updateAll(['isValid'=>StockRecordModel::IS_VALID_NO],['unionId'=>$id,'type'=>StockRecordModel::TYPE_PURCHASE]);
            $transaction->commit();
        }catch (\Exception $e){
            $transaction->rollBack();
            \Yii::info('------del stock manage by id fail'.$e->getMessage());
            $bol = false;
        }
        return $bol;
    }

    /*
     * 新增进货记录
     * stock 库存表修改商品库存；stock_detail 库存记录表增加记录；purchase进货主表增加记录，purchase_detail进货详情表增加记录
     * 编辑进货记录
     * stock 修改商品库存，stock_detail修改记录，purchase，purchase_detail修改记录
     * */
    public static function saveData($data,$houseId,$remark,$userName,$supplier,$date,$id)
    {
        $returnArr = ['code'=>Code::PARAM_ERR,'没有数据'];
        if(count($data) > 0){
            $transaction = \Yii::$app->db->beginTransaction();
            try{
                $amount = 0;
                foreach($data as $item){
                    if(intval($item['num']) <= 0){
                        throw  new Exception('-----进货数量不能为空---');
                        break;
                    }
                    $amount += $item['amount'];
                }
                if($id > 0){
                    $purchase = self::getById($id,false);
                    if($purchase === null){
                        \Yii::info('-----save purchase fail 进货主表记录不存在------ ');
                        throw new Exception('进货主表记录不存在');
                    }
                }else{
                    $purchase = new self();
                }
                $purchase->houseId = $houseId;
                $purchase->sn = date('YmdHis');
                $purchase->totalAmount = BaseForm::amountToCent($amount);
                $purchase->remark = $remark;
                $purchase->userName = $userName;
                $purchase->supplier = $supplier;
                $purchase->purchaseDate = $date;
                if(!$purchase->save()){
                    \Yii::info('-----save purchase fail 进货主表保存失败------ ');
                    throw new Exception('进货主表保存失败');
                }
                $purchaseId = $purchase->purchaseId;
                //保存进货详情表
                $saveDetail = PurchaseDetailModel::saveData($data,$purchaseId,$houseId);
                if($saveDetail['code'] !== Code::SUCCESS){
                    \Yii::info('---save purchase fail--'.$saveDetail['msg']);
                    throw new Exception($saveDetail['msg']);
                }
                $numData = $saveDetail['numData'];//如果是编辑时，进货的商品数量需要与原来的更新，如果是更新时不变
                //修改商品的库存
                $saveStock = StockModel::saveData($houseId,$numData,$purchaseId,$type=StockRecordModel::TYPE_PURCHASE,$remark,$userName,$date);
                if($saveStock['code'] !== Code::SUCCESS){
                    \Yii::info('---save purchase fail--'.$saveStock['msg']);
                    throw new Exception($saveStock['msg']);
                }
                $returnArr['code'] = Code::SUCCESS;
                $returnArr['msg'] = '保存成功';
                $transaction->commit();
            }catch (\Exception $e){
                \Yii::info('------进货数据保存--error msg-'.$e->getMessage().'---file--'.$e->getFile().'---line--'.$e->getLine());
                $transaction->rollBack();
                $returnArr['code'] = Code::PARAM_ERR;
                $returnArr['msg'] = $e->getMessage();
            }
        }
        return $returnArr;
    }

    //格式化数据
    public static function format($data)
    {
        $returnArr = [];
        if(count($data) > 0){
            foreach($data as $info){
                $returnArr[] = [
                    'purchaseId'=>intval($info['purchaseId']),
                    'date'=>$info['purchaseDate'],
                    'totalAmount'=>BaseForm::amountToYuan(intval($info['totalAmount'])),
                    'userName'=>$info['userName'],
                    'supplier'=>$info['supplier'],
                    'createTime'=>$info['createTime'],
                    'remark'=>$info['remark']
                ];
            }
        }
        return $returnArr;
    }

}