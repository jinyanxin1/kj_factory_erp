<?php
/**
 *
 * author: jinyanxin
 * Date: 2020/11/16
 * Time: 11:27
 * PHP version 7
 */

namespace backend\actions\purchase\wareHouse;


use backend\actions\BaseAction;
use common\models\purchase\WareHouseForm;

class SaveAction extends BaseAction
{

    public function run()
    {
        $post = $this->request()->post();

        $wareHouse = new WareHouseForm();
        $wareHouse->attributes = $post;
        $result = $wareHouse->saveInfo();

        return $this->returnApi($result['code'],$result['msg']);
    }

}