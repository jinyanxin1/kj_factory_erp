<?php
/**
 * @Author: jinyanxin
 * @Date: 2020/1/7
 * @Time: 11:47
 * 商品列表
 */


namespace frontend\actions\purchase\goods;


use frontend\actions\WxAction;
use frontend\models\purchase\goods\GoodsForm;
use common\library\helper\Code;
use common\models\goods\GoodsModel;

class ListGoodsAction extends WxAction
{

    public function run()
    {
        $goodsName = $this->request()->post('goodsName','');
        $status = $this->request()->post('status');
        $page = intval($this->request()->post('page',1));
        $pageSize = intval($this->request()->post('pageSize',10));
        $categoryId = intval($this->request()->post('categoryId'));
        $houseId = intval($this->request()->post('houseId'));

        $goods = new GoodsForm();
        $goods->page = $page;
        $goods->pageSize = $pageSize;
        $goods->goodsName = $goodsName;
        $goods->status = $status;
        $goods->categoryId = $categoryId;
        $goods->houseId = $houseId;
        $goods->export = false;
        $data = $goods->getData();
        $count = $data['count'];
        $showList = $data['data'];

        return $this->returnApi(Code::SUCCESS,'ok',[
            'showList'=>$showList,
            'pageInfo'=>$this->getPageInfo($count,$pageSize,$page)
        ]);
    }

}