<?php
/**
 * @Author: jinyanxin
 * @Date: 2020/2/4
 * @Time: 9:27
 * 商品库存详情
 */


namespace frontend\actions\purchase\stock;


use frontend\actions\WxAction;
use frontend\models\purchase\stock\StockForm;
use common\library\helper\Code;
use common\models\stock\StockModel;

class StockGoodsDetailAction extends WxAction
{

    public function run()
    {

        $goodsId = intval($this->request()->post('goodsId'));
        if($goodsId <= 0){
            return $this->returnApi(Code::PARAM_ERR,'请选择商品');
        }
        $page = intval($this->request()->post('page',1));
        $pageSize = intval($this->request()->post('pageSize',10));

        $stock = new StockForm();
        $stock->goodsId = $goodsId;
        $stock->page = $page;
        $stock->pageSize = $pageSize;

        $data = $stock->getData();
        $count = $data['count'];
        $showList = $data['data'];
        $stockNum =  StockModel::countStockNumByGoodsId($goodsId);
        return $this->returnApi(Code::SUCCESS,'ok',[
            'stockNum'=>$stockNum,
            'showList'=>$showList,
            'pageInfo'=>$this->getPageInfo($count,$pageSize,$page)
        ]);
    }

}