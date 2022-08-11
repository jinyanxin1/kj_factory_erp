<?php
/**
 *
 * author: jinyanxin
 * Date: 2020/11/20
 * Time: 9:55
 * PHP version 7
 */

namespace backend\actions\goods\manage;


use backend\actions\BaseAction;
use common\models\goods\GoodsStationForm;

class StationGoodsInfoAction extends BaseAction
{

    public function run()
    {
        $groupId = intval($this->request()->post('groupId'));

        $goodsStation = new GoodsStationForm();
        $goodsStation->groupId = $groupId;
        $result = $goodsStation->getInfo();

        return $this->returnApi($result['code'],$result['msg'],['list'=>$result['list']]);
    }

}