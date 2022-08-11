<?php
/**
 *
 * author: jinyanxin
 * Date: 2020/9/7
 * Time: 10:17
 * PHP version 7
 */

namespace backend\actions\goods\manage;


use backend\actions\BaseAction;
use common\library\helper\Code;
use common\models\goods\GoodsForm;
use yii\helpers\Json;

class InfoAction extends BaseAction
{

    public function run()
    {
        $id = intval($this->request()->post('id'));
        if($id <= 0){
            return $this->returnApi(Code::PARAM_ERR,'请选择物品');
        }

        $goods = new GoodsForm();
        $goods->id = $id;
        $result = $goods->getInfo();

        return $this->returnApi($result['code'],$result['msg'],['info'=>$result['info']]);

    }

}