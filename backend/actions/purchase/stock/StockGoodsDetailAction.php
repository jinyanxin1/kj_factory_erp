<?php
/**
 *
 * author: jinyanxin
 * Date: 2020/11/16
 * Time: 14:01
 * PHP version 7
 */

namespace backend\actions\purchase\stock;


use backend\actions\BaseAction;
use common\library\helper\Code;
use common\models\purchase\GoodsStockForm;
use common\models\purchase\GoodsStockModel;

class StockGoodsDetailAction extends BaseAction
{

    public function run()
    {
        $id = intval($this->request()->post('goodsId'));
        if($id <= 0){
            return $this->returnApi(Code::PARAM_ERR,'请选择商品');
        }
        $page = intval($this->request()->post('page',1));
        $pageSize = intval($this->request()->post('pageSize',10));

        $stock = new GoodsStockForm();
        $stock->goodsId = $id;
        $stock->page = $page;
        $stock->pageSize = $pageSize;
        $result = $stock->getData();
        $stockNum = GoodsStockModel::countStockNumByGoodsId($id);
        return $this->returnApi(Code::SUCCESS,'ok',[
            'stockNum'=>$stockNum,
            'showList'=>$stock->formatData($result['data']),
            'pageInfo'=>$this->getPageInfo($result['count'],$pageSize,$page),
        ]);
    }

}