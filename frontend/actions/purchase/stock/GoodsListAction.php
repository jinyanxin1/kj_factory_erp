<?php
/**
 * @Author: jinyanxin
 * @Date: 2020/2/3
 * @Time: 15:09
 * 库存列表
 */


namespace frontend\actions\purchase\stock;


use frontend\actions\WxAction;
use frontend\models\purchase\goods\GoodsForm;
use common\library\helper\Code;
use common\models\goods\GoodsModel;

class GoodsListAction  extends WxAction
{
    /*
     * 库存列表  展示所有商品的库存，商品信息
     *
     * */
    public function run()
    {
        //物品名称
        $goodsName = $this->request()->post('goodsName','');
        //仓库id
        $houseId = intval($this->request()->post('houseId',0));
        //物品类别
        $categoryId = intval($this->request()->post('categoryId',0));
        //状态
        $status = intval($this->request()->post('status',GoodsModel::QI_YONG));

        $page = intval($this->request()->post('page',1));
        $pageSize = intval($this->request()->post('pageSize',10));

        $goodsForm = new GoodsForm();
        $goodsForm->goodsName = $goodsName;
        $goodsForm->houseId = $houseId;
        $goodsForm->categoryId = $categoryId;
        $goodsForm->status = $status;
        $goodsForm->page = $page;
        $goodsForm->pageSize = $pageSize;
        $goodsForm->export = false;

        $goodsList = $goodsForm->getData();
        $data = $goodsList['data'];
        $count = $goodsList['count'];


        return $this->returnApi(Code::SUCCESS,'ok',[
            'showList'=>$data,
            'pageInfo'=>$this->getPageInfo($count,$pageSize,$page)
        ]);
    }

}