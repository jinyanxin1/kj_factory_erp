<?php
/**
 * @Author: jinyanxin
 * @Date: 2020/2/13
 * @Time: 10:19
 * 库存变动统计
 */


namespace backend\actions\purchase\store;


use backend\actions\BaseAction;
use common\library\helper\Code;
use common\models\BaseModel;
use common\models\goods\GoodsModel;
use common\models\purchase\StockRecordForm;

class StockStatisticsAction extends BaseAction
{

    public function run()
    {
        $goodsName = $this->request()->post('goodsName');
        $startTime = $this->request()->post('startTime');
        $entTime = $this->request()->post('endTime');
        $page = intval($this->request()->post('page',1));
        $pageSize = intval($this->request()->post('pageSize',10));
        $goodsType = intval($this->request()->post('goodsType',GoodsModel::TYPE_PRODUCTION));//1产品；2物料


        $stockRecord = new StockRecordForm();
        $stockRecord->houseId = BaseModel::HOUSE_ID;
        $stockRecord->goodsName = $goodsName;
        $stockRecord->startTime = $startTime;
        $stockRecord->endTime = $entTime;
        $stockRecord->goodsType = $goodsType;
        $stockRecord->page = $page;
        $stockRecord->pageSize = $pageSize;
        //统计数据
        if($goodsType === GoodsModel::TYPE_PRODUCTION){
            //产品
            $data = $stockRecord->getStatisticsProductionData();
        }else if($goodsType === GoodsModel::TYPE_MATERIEL){
            $data = $stockRecord->getStatisticsMetrailData();
        }else{
            return $this->returnApi(Code::PARAM_ERR,'参数错误');
        }


        $count = $data['count'];
        $showList = $data['showList'];
        return $this->returnApi(Code::SUCCESS,'ok',[
            'count'=>$count,
            'showList'=>$showList,
            'table'=>$data['table'],
            'pageInfo'=>$this->getPageInfo($count,$pageSize,$page)
        ]);

    }

}