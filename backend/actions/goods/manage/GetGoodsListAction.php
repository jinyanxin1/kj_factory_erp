<?php
/**
 *
 * author: jinyanxin
 * Date: 2021/3/6
 * Time: 9:47
 * PHP version 7
 */

namespace backend\actions\goods\manage;


use backend\actions\BaseAction;
use common\library\helper\Code;
use common\models\goods\GoodsInfoModel;

class GetGoodsListAction extends BaseAction
{

    public function run()
    {
        $type = intval($this->request()->post('type'));
        $isFinished = intval($this->request()->post('isFinished'));

        $data = GoodsInfoModel::find()->select('id,name')->where([
            'type'=>$type,
            'isFinished'=>$isFinished,
            'isValid'=>GoodsInfoModel::IS_VALID_OK
        ])->asArray()->all();

        return $this->returnApi(Code::SUCCESS,'ok',['list'=>$data]);
    }

}