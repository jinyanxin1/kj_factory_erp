<?php
/**
 *
 * author: jinyanxin
 * Date: 2020/11/16
 * Time: 11:46
 * PHP version 7
 */

namespace backend\actions\purchase\wareHouse;


use backend\actions\BaseAction;
use common\models\purchase\WareHouseForm;

class InfoAction extends BaseAction
{

    public function run()
    {
        $id = intval($this->request()->post('id'));

        $wareHouse = new WareHouseForm();
        $wareHouse->id = $id;
        $result = $wareHouse->getInfo();

        return $this->returnApi($result['code'],$result['msg'],['info'=>$result['info']]);
    }

}