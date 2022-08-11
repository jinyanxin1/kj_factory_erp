<?php
/**
 * @Author: jinyanxin
 * @Date: 2020/2/17
 * @Time: 10:04
 * 库存查询导出
 */


namespace frontend\actions\purchase\stock;


use frontend\actions\WxAction;
use frontend\models\purchase\goods\GoodsForm;
use common\models\goods\GoodsModel;

class ExportListAction extends WxAction
{

    public function run()
    {
        //物品名称
        $goodsName = $this->request()->get('goodsName','');
        //仓库id
        $houseId = intval($this->request()->get('houseId',0));
        //物品类别
        $categoryId = intval($this->request()->get('categoryId',0));
        //状态
        $status = intval($this->request()->get('status',GoodsModel::QI_YONG));

        $goodsForm = new GoodsForm();
        $goodsForm->goodsName = $goodsName;
        $goodsForm->houseId = $houseId;
        $goodsForm->categoryId = $categoryId;
        $goodsForm->status = $status;
        $goodsForm->export = true;
        $goodsForm->exportType = 2;

        $goodsList = $goodsForm->getData();
        $data = $goodsList['data'];
        $count = $goodsList['count'];

    }

}