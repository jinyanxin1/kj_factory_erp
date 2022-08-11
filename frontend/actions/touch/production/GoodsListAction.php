<?php
/**
 *
 * author: jinyanxin
 * Date: 2020/11/23
 * Time: 11:33
 * PHP version 7
 */

namespace frontend\actions\touch\production;


use common\library\helper\Code;
use common\models\goods\GoodsModel;
use common\models\goods\GoodsStationModel;
use common\models\staffInfo\StaffInfoModel;
use frontend\actions\BaseAction;

class GoodsListAction extends BaseAction
{

    public function run()
    {
        $staffId = intval($this->request()->post('staffId'));
        if($staffId <= 0){
            return $this->returnApi(Code::PARAM_ERR,'请选择员工');
        }
        $staffInfo = StaffInfoModel::find()->where(['staffId'=>$staffId,'isValid'=>StaffInfoModel::IS_VALID_OK])->asArray()->one();
        if(empty($staffInfo)){
            return $this->returnApi(Code::PARAM_ERR,'员工不存在');
        }
        $goodsStation = GoodsStationModel::find()->where(['groupId'=>$staffInfo['positionId'],'isValid'=>GoodsStationModel::IS_VALID_OK])->asArray()->one();
        $returnList = [];
        if(count($goodsStation) > 0){
            $goodsIds = !empty($goodsStation['goodsId']) ? explode(',',$goodsStation['goodsId']) : [];
            $goods = GoodsModel::find()->select('id,name,attr')->where(['id'=>$goodsIds,'isValid'=>GoodsModel::IS_VALID_OK])
                ->orderBy('name desc')
                ->asArray()->all();
            $returnList = $goods;
        }
        return $this->returnApi(Code::SUCCESS,'ok',['list'=>$returnList]);
    }

}