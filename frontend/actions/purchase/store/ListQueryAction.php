<?php
/**
 * @Author: jinyanxin
 * @Date: 2020/2/13
 * @Time: 9:41
 * 库存查询列表
 */


namespace frontend\actions\purchase\store;


use frontend\actions\WxAction;
use frontend\models\purchase\stock\StockRecordForm;
use common\library\helper\Code;

class ListQueryAction extends WxAction
{

    public function run()
    {
        $houseId = intval($this->request()->post('houseId'));
        $categoryId = intval($this->request()->post('categoryId'));
        $goodsName = $this->request()->post('goodsName');
        $startTime = $this->request()->post('startTime');
        $endTime = $this->request()->post('endTime');
        $page = intval($this->request()->post('page',1));
        $pageSize = intval($this->request()->post('pageSize',10));
        $type = intval($this->request()->post('type'));

        $stockRecord = new StockRecordForm();
        $stockRecord->houseId = $houseId;
        $stockRecord->categoryId = $categoryId;
        $stockRecord->goodsName = $goodsName;
        $stockRecord->startTime = $startTime;
        $stockRecord->endTime = $endTime;
        $stockRecord->page = $page;
        $stockRecord->pageSize = $pageSize;
        $stockRecord->type = $type;

        $data = $stockRecord->getQueryData();

        $count = $data['count'];
        $showList = $data['showList'];

        return $this->returnApi(Code::SUCCESS,'ok',[
            'showList'=>$showList,
            'pageInfo'=>$this->getPageInfo($count,$pageSize,$page)
        ]);
    }

}