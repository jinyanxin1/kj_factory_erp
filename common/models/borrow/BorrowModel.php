<?php
/**
 * @Author: jinyanxin
 * @Date: 2020/2/12
 * @Time: 15:19
 * 领用，退领主表
 */


namespace common\models\borrow;


use backend\models\purchase\stock\StockRecordForm;
use common\library\helper\Code;
use common\models\BaseModel;
use common\models\goods\GoodsModel;
use common\models\stock\StockModel;
use common\models\stock\StockRecordModel;

class BorrowModel extends BaseModel
{

    const TYPE_COLLAR_USE = 1;//领用
    const TYPE_WITHDRAWAL_OF_COLLAR = 2;//退领

    public static function tableName()
    {
        return 'jxt_jxc_borrow';
    }

    public static function getById($id,$isArr = true)
    {
        $info = self::find()->where(['borrowId'=>$id,'isValid'=>self::IS_VALID_OK]);
        if($isArr === true){
            $info->asArray();
        }
        return $info->one();
    }

    /*
     * 根据id删除记录
     *              删除领用表，详情表记录。更新库存，删除库存记录
     * */
    public static function delById($id)
    {
        $bol = false;
        $transaction = \Yii::$app->db->beginTransaction();
        try{
            $borrowInfo = BorrowModel::getById($id,true);
            if($borrowInfo === null){
                throw  new \Exception('记录不存在');
            }
            $type = $borrowInfo['type'];
            $houseId = $borrowInfo['houseId'];
            $data = BorrowDetailModel::getByBorrowId($id);
            if(count($data) > 0){
                foreach($data as $dataInfo){
                    $goodsId = intval($dataInfo['goodsId']);
                    $goods = GoodsModel::getById($goodsId);
                    if(!empty($goods)){
                        $num = intval($dataInfo['num']);
                        //更新库存
                        $stock = StockModel::find()->where(['warehouseId'=>$houseId,'goodsId'=>$goodsId,'isValid'=>StockModel::IS_VALID_OK])->one();
                        if($stock === null){
                            throw  new \Exception('库存不存在');
                            break;
                        }
                        if($type === self::TYPE_COLLAR_USE){
                            //领用
                            $stock->stockNum = $stock->stockNum + $num;
                        }else if($type === self::TYPE_WITHDRAWAL_OF_COLLAR){
                            //退领
                            $stock->stockNum = $stock->stockNum - $num;
                        }else{
                            throw  new \Exception('领用类型错误');
                            break;
                        }
                        if(intval($stock->stockNum) < 0){
                            throw  new \Exception('记录删除后库存小于0，删除失败');
                            break;
                        }
                        if(!$stock->save()){
                            throw  new \Exception('库存更新失败');
                            break;
                        }
                    }
                }
            }
            //删除领用，领用详情表
            BorrowModel::updateAll(['isValid'=>self::IS_VALID_NO],['borrowId'=>$id]);
            BorrowDetailModel::updateAll(['isValid'=>BorrowDetailModel::IS_VALID_NO],['borrowId'=>$id]);
            //删除库存记录
            if($type === self::TYPE_COLLAR_USE){
                //领用
               StockRecordModel::updateAll(['isValid'=>StockRecordModel::IS_VALID_NO],['type'=>StockRecordModel::TYPE_COLLAR_USE,'unionId'=>$id]);
            }else if($type === self::TYPE_WITHDRAWAL_OF_COLLAR){
                //退领
                StockRecordModel::updateAll(['isValid'=>StockRecordModel::IS_VALID_NO],['type'=>StockRecordModel::TYPE_WITHDRAWAL_OF_COLLAR,'unionId'=>$id]);
            }else{
                throw  new \Exception('领用类型错误');
            }
            $transaction->commit();
            $bol = true;
        }catch (\Exception $e){
            $transaction->rollBack();
            \Yii::info('----del borrow error msg'.$e->getMessage());
        }
        return $bol;
    }

    /*
     * 保存领用数据
     *              领用表，领用详情表增加数据，判断领用数量是否在库存范围内，若是，库存量更新减少，增加库存记录；若不是，错误返回。
     * */
    public function saveData($borrowId,$data,$houseId,$remark,$userName,$date,$borrowName,$type)
    {
        $returnArr = ['code'=>Code::PARAM_ERR,'msg'=>'保存失败'];
        $transaction = \Yii::$app->db->beginTransaction();
        try{
            if($borrowId > 0){
                $borrowInfo = self::getById($borrowId,false);
                if($borrowInfo === null){
                    throw new \Exception('记录为空');
                }
            }else{
                $borrowInfo = new self();
            }
            $borrowInfo->houseId = $houseId;
            $borrowInfo->sn = date('YmdHis');
            $borrowInfo->borrowUser = $borrowName;
            $borrowInfo->userName = $userName;
            $borrowInfo->remark = $remark;
            $borrowInfo->type = $type;
            $borrowInfo->date = $date;
            if(!$borrowInfo->save()){
                throw  new \Exception('记录保存失败');
            }
            $borrowId = $borrowInfo->borrowId;

            //保存详情
            $saveDetail = BorrowDetailModel::saveData($houseId,$data,$borrowId,$type,$userName,$remark,$date);
            if($saveDetail['code'] !== Code::SUCCESS){
                $returnArr['msg'] = $saveDetail['msg'];
                throw  new \Exception($saveDetail['msg']);
            }
            $transaction->commit();
            $returnArr['code'] = Code::SUCCESS;
            $returnArr['msg'] = '保存成功';
        }catch(\Exception $e){
            $transaction->rollBack();
            \Yii::info('----save borrow fail error msg'.$e->getMessage().'----file-'.$e->getFile().'---line'.$e->getLine());
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
                    'borrowId'=>intval($info['borrowId']),
                    'date'=>$info['date'],
                    'userName'=>$info['userName'],
                    'borrowName'=>$info['borrowUser'],
                    'createTime'=>$info['createTime'],
                    'remark'=>$info['remark']
                ];
            }
        }
        return $returnArr;
    }


}