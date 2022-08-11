<?php
/**
 * @Author: jinyanxin
 * @Date: 2020/1/7
 * @Time: 11:47
 * 商品列表
 */


namespace backend\actions\purchase\goods;


use backend\actions\BaseAction;
use backend\models\purchase\goods\GoodsForm;
use common\library\helper\Code;
use common\models\goods\GoodsModel;

class ListGoodsAction extends BaseAction
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
//        $goods->campusIds = $this->campusId;
//        $goods->schoolId = $this->schoolId;
        $data = $goods->getData();
        $count = $data['count'];
        $showList = $data['data'];

        return $this->returnApi(Code::SUCCESS,'ok',[
            'showList'=>$showList,
            'pageInfo'=>$this->getPageInfo($count,$pageSize,$page)
        ]);
    }

}