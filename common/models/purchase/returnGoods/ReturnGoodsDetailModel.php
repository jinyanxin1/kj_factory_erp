<?php
/**
 * @Author: jinyanxin
 * @Date: 2020/2/10
 * @Time: 11:21
 * 退货详情表
 */


namespace common\models\purchase\returnGoods;


use common\library\helper\Code;
use common\models\BaseForm;
use common\models\BaseModel;
use common\models\goods\GoodsModel;
use common\models\purchase\GoodsStockModel;
use common\models\stock\StockModel;
use common\models\workingProcedure\GoodsWorkingProcedureModel;

class ReturnGoodsDetailModel extends BaseModel
{

    public static function tableName()
    {
        return 'kj_goods_return_goods_detail';
    }

    //根据id得到数据
    public static function getById($id,$isArr = true)
    {
        $info = self::find()->where(['returnDetailId'=>$id,'isValid'=>self::IS_VALID_OK]);
        if($isArr === true){
            $info->asArray();
        }
        return $info->one();
    }

    //根据退货主表id得到详情表数据
    public static function getDataByReturnId($returnId)
    {
        $data = self::find()->where(['returnId'=>$returnId,'isValid'=>self::IS_VALID_OK])->asArray()->all();
        return $data;
    }

    /*
     * 格式化数据
     * */
    public static function format($data)
    {
        $returnArr = [];
        if(count($data) > 0){
            $goodsIds = array_unique(array_column($data,'goodsId'));
            $goods = GoodsModel::getByIdList($goodsIds);
            $workingIds = array_unique(array_column($data,'workingId'));
            $working = GoodsWorkingProcedureModel::getByIdList($workingIds);
            foreach($data as $dataInfo){
                $info = [
                    'detailId'=>intval($dataInfo['returnDetailId']),
                    'goodsId'=>intval($dataInfo['goodsId']),
                    'workingId'=>intval($dataInfo['workingId']),
                    'num'=>$dataInfo['num'],
                    'price'=>BaseForm::amountToYuan(intval($dataInfo['price'])),
                    'amount'=>BaseForm::amountToYuan($dataInfo['num'] * intval($dataInfo['price'])),
                    'goodsName'=>'',
                    'workingName'=>isset($working[$dataInfo['workingId']]) ? $working[$dataInfo['workingId']]['name'] : '',
                    'unit'=>'',
                    'attr'=>'',
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

    /*
     * 保存数据
     * */
    public static function saveData($data,$returnId,$houseId,$goodsType)
    {
        $returnArr = ['code'=>Code::SUCCESS,'msg'=>'保存成功'];
        if(count($data) > 0){
            //得到之前的记录
            $detail = self::getDataByReturnId($returnId);
            $detailList = count($detail) > 0 ? array_combine(array_column($detail,'returnDetailId'),$detail) : [];
            $detailIds = count($detail) > 0 ? array_column($detail,'returnDetailId') : [];
            $numData = [];
            foreach($data as $info){
                $newInfo = $info;
                $id = intval($info['detailId']);
                if($id > 0){
                    $detail = self::getById($id,false);
                    if($detail === null){
                        $returnArr['code'] = Code::PARAM_ERR;
                        $returnArr['msg'] = '详情记录不存在';
                        break;
                    }
                    $newInfo['updateNum'] = $info['num'] - $detail->num;
                    $detailIds = array_diff($detailIds,[$id]);
                }else{
                    $detail = new self();
                    $newInfo['updateNum'] = $info['num'];
                }
                $numData[] = $newInfo;
                $detail->returnId = $returnId;
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
                            $stock->num = $stock->num + $num;
                            if(!$stock->save()){
                                $returnArr['code'] = Code::PARAM_ERR;
                                $returnArr['msg'] = '退货编辑时,更新库存失败';
                                break;
                            }
                        }
                    }
                }
                self::updateAll(['isValid'=>self::IS_VALID_NO,'updateTime'=>date('Y-m-d H:i:s')],['returnDetailId'=>$detailIds]);
            }
            $returnArr['numData'] = $numData;
        }
        return $returnArr;
    }

}