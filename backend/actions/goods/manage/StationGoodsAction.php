<?php
/**
 *
 * author: jinyanxin
 * Date: 2020/11/18
 * Time: 9:21
 * PHP version 7
 */

namespace backend\actions\goods\manage;


use backend\actions\BaseAction;
use common\models\goods\GoodsStationForm;

class StationGoodsAction extends BaseAction
{


    public function run()
    {
        $post = $this->request()->post();

        $goodsStation = new GoodsStationForm();
        $goodsStation->attributes = $post;
        $result = $goodsStation->saveInfo();

        return $this->returnApi($result['code'],$result['msg']);
    }



}