<?php
/**
 *
 * author: jinyanxin
 * Date: 2020/11/16
 * Time: 11:53
 * PHP version 7
 */

namespace backend\actions\purchase\stock;


use backend\actions\BaseAction;
use common\library\helper\Code;
use common\models\goods\GoodsForm;

class GoodsListAction extends BaseAction
{

    public function run()
    {
        //物品名称
        $name = $this->request()->post('goodsName','');
        //仓库id
        $houseId = intval($this->request()->post('houseId',1));
        //物品类别
        $categoryId = intval($this->request()->post('categoryId',0));
        //1产品；2物料
        $goodsType = intval($this->request()->post('goodsType',1));
        $page = intval($this->request()->post('page',1));
        $pageSize = intval($this->request()->post('pageSize',10));

        $goodsForm = new GoodsForm();
        $goodsForm->name = $name;
        $goodsForm->houseId = $houseId;
        $goodsForm->categoryId = $categoryId;
        $goodsForm->page = $page;
        $goodsForm->pageSize = $pageSize;
        $goodsForm->type = $goodsType;

        $goodsList = $goodsForm->getData();
        $data = $goodsList['data'];
        $count = $goodsList['count'];


        return $this->returnApi(Code::SUCCESS,'ok',[
            'showList'=>$goodsForm->formatData($data),
            'pageInfo'=>$this->getPageInfo($count,$pageSize,$page)
        ]);
    }

}