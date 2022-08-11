<?php
/**
 *
 * author: jinyanxin
 * Date: 2020/9/7
 * Time: 9:01
 * PHP version 7
 */

namespace backend\actions\goods\manage;


use backend\actions\BaseAction;
use common\models\goods\GoodsForm;

class SaveAction extends BaseAction
{

    public function run()
    {

        $postData = $this->request()->post();

        $goods = new GoodsForm();
        $goods->attributes = $postData;
        $result = $goods->saveInfo();

        return $this->returnApi($result['code'],$result['msg']);
    }

}