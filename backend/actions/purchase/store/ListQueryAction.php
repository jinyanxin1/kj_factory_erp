<?php
/**
 * @Author: jinyanxin
 * @Date: 2020/2/13
 * @Time: 9:41
 * 库存查询列表
 */


namespace backend\actions\purchase\store;


use backend\actions\BaseAction;
use common\library\helper\Code;
use common\models\BaseModel;
use common\models\purchase\StockRecordForm;

class ListQueryAction extends BaseAction
{

    public function run()
    {
        $categoryId = intval($this->request()->post('categoryId'));
        $goodsName = $this->request()->post('goodsName');
        $startTime = $this->request()->post('startTime');
        $endTime = $this->request()->post('endTime');
        $page = intval($this->request()->post('page',1));
        $pageSize = intval($this->request()->post('pageSize',10));
        $type = intval($this->request()->post('type'));
        $goodsType = intval($this->request()->post('goodsType'));

        $houseId = BaseModel::HOUSE_ID;//仓库默认1
        $stockRecord = new StockRecordForm();
        $stockRecord->goodsType = $goodsType;
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