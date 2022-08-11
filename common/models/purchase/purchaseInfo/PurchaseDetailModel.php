<?php
/**
 * @Author: jinyanxin
 * @Date: 2020/2/5
 * @Time: 9:59
 * 进货主表详情表
 */


namespace common\models\purchase\purchaseInfo;


use common\library\helper\Code;
use common\models\BaseForm;
use common\models\BaseModel;
use common\models\goods\GoodsModel;
use common\models\purchase\GoodsStockModel;
use common\models\stock\StockModel;

class PurchaseDetailModel extends BaseModel
{

    public static function tableName()
    {
        return 'kj_goods_purchase_detail';
    }

    //根据主键id得到详情
    public static function getById($id,$isArr = true)
    {
        $info = self::find()->where(['purchaseDetailId'=>$id,'isValid'=>self::IS_VALID_OK]);
        if($isArr === true){
            $info->asArray();
        }
        return $info->one();
    }

    //根据主表id得到详情
    public static function getDataByPurchaseId($id)
    {

        $data = self::find()->where(['purchaseId'=>$id,'isValid'=>self::IS_VALID_OK])->asArray()->all();
        return $data;
    }

    //保存数据
    public static function saveData($data,$purchaseId,$houseId,$goodsType)
    {
        $returnArr = ['code'=>Code::SUCCESS,'msg'=>'保存成功'];
        if(count($data) > 0){
            //得到之前的记录
            $detail = self::getDataByPurchaseId($purchaseId);
            $detailList = count($detail) > 0 ? array_combine(array_column($detail,'purchaseDetailId'),$detail) : [];
            $detailIds = count($detail) > 0 ? array_column($detail,'purchaseDetailId') : [];
            $numData = [];
            foreach($data as $info){
                $newInfo = $info;
                $id = intval($info['detailId']);
                if($id > 0){
                    $detail = PurchaseDetailModel::getById($id,false);
                    if($detail === null){
                        $returnArr['code'] = Code::PARAM_ERR;
                        $returnArr['msg'] = '详情记录不存在';
                        break;
                    }
                    $newInfo['updateNum'] = $info['num'] - $detail->num;
                    $detailIds = array_diff($detailIds,[$id]);
                }else{
                    $detail = new PurchaseDetailModel();
                    $newInfo['updateNum'] = $info['num'];
                }
                $numData[] = $newInfo;
                $detail->purchaseId = $purchaseId;
                $detail->goodsId = intval($info['goodsId']);
                $detail->num = intval($info['num']);
                $detail->price = BaseForm::amountToCent($info['price']);
                $detail->goodsType = $goodsType;
                if(!$detail->save()){
                    $returnArr['code'] = Code::PARAM_ERR;
                    $returnArr['msg'] = '详情保存失败';
                    break;
                }
            }
            if(count($detailIds) > 0){//编辑时，一条进货记录中，如果某个商品在这条进货记录中删掉，那么，之前这个商品的进货记录也需要删掉，库存需要更新
                //更新库存
                foreach($detailIds as $item){
                    if(isset($detailList[$item])){
                        $goodsId = $detailList[$item]['goodsId'];
                        $num = $detailList[$item]['num'];
                        $stock = GoodsStockModel::find()->where(['wareHouseId'=>$houseId,'goodsId'=>$goodsId,'isValid'=>GoodsStockModel::IS_VALID_OK])->one();
                        if(!empty($stock)){
                            $stock->num = $stock->num - $num;
                            if(!$stock->save()){
                                $returnArr['code'] = Code::PARAM_ERR;
                                $returnArr['msg'] = '编辑时,更新库存失败';
                                break;
                            }
                        }
                    }
                }
                PurchaseDetailModel::updateAll(['isValid'=>self::IS_VALID_NO,'updateTime'=>date('Y-m-d H:i:s')],['purchaseDetailId'=>$detailIds]);
            }
            $returnArr['numData'] = $numData;
        }
        return $returnArr;
    }

    //格式化数据
    public static function format($data)
    {
        $returnArr = [];
        if(count($data) > 0){
            $goodsIds = array_column($data,'goodsId');
            $goods = GoodsModel::getByIdList($goodsIds);
            foreach($data as $dataInfo){
                $info = [
                    'detailId'=>intval($dataInfo['purchaseDetailId']),
                    'goodsId'=>intval($dataInfo['goodsId']),
                    'num'=>$dataInfo['num'],
                    'price'=>BaseForm::amountToYuan(intval($dataInfo['price'])),
                    'amount'=>BaseForm::amountToYuan($dataInfo['num'] * intval($dataInfo['price'])),
                    'goodsName'=>'',
                    'attr'=>'',
                    'unit'=>'',
                ];
                if(isset($goods[$dataInfo['goodsId']])){
                    $goodsInfo = $goods[$dataInfo['goodsId']];
                    $info['goodsName'] = $goodsInfo['name'];
                    $info['unit'] = $goodsInfo['unit'];
                    $info['attr'] = $goodsInfo['attr'];
                }
                $returnArr[] = $info;
            }
        }
        return $returnArr;
    }


}