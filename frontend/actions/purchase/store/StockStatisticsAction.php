<?php
/**
 * @Author: jinyanxin
 * @Date: 2020/2/13
 * @Time: 10:19
 * 库存变动统计
 */


namespace frontend\actions\purchase\store;


use frontend\actions\WxAction;
use frontend\models\purchase\stock\StockRecordForm;
use common\library\helper\Code;
use common\models\goods\GoodsModel;

class StockStatisticsAction extends WxAction
{

    public function run()
    {

        $houseId = intval($this->request()->post('houseId'));
        $categoryId = intval($this->request()->post('categoryId'));
        $goodsName = $this->request()->post('goodsName');
        $startTime = $this->request()->post('startTime');
        $entTime = $this->request()->post('endTime');
        $page = intval($this->request()->post('page',1));
        $pageSize = intval($this->request()->post('pageSize',10));
//        $status = intval($this->request()->post('status',GoodsModel::QI_YONG));
        $campusId = $this->campusId;
        if(is_array($campusId)){
            $campusId[] = [-1];
        }else{
            $campusId = [$campusId,-1];
        }

        $stockRecord = new StockRecordForm();
        $stockRecord->campusId = $campusId;
        $stockRecord->houseId = $houseId;
        $stockRecord->categoryId = $categoryId;
        $stockRecord->goodsName = $goodsName;
        $stockRecord->startTime = $startTime;
        $stockRecord->endTime = $entTime;
//        $stockRecord->status = $status;
        $stockRecord->page = $page;
        $stockRecord->pageSize = $pageSize;
        //统计数据
        $data = $stockRecord->getStatisticsData();
        $count = $data['count'];
        $showList = $data['showList'];
        return $this->returnApi(Code::SUCCESS,'ok',[
            'count'=>$count,
            'showList'=>$showList,
            'pageInfo'=>$this->getPageInfo($count,$pageSize,$page)
        ]);

    }

}