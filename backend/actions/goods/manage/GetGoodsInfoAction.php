<?php
/**
 *
 * author: jinyanxin
 * Date: 2021/3/6
 * Time: 9:44
 * PHP version 7
 */

namespace backend\actions\goods\manage;


use backend\actions\BaseAction;
use common\library\helper\Code;
use common\models\goods\GoodsInfoModel;

class GetGoodsInfoAction extends BaseAction
{

    public function run()
    {
        $goodsName = $this->request()->post('goodsName');
        $detail = [];
        if(!empty($goodsName)){
            $detail = GoodsInfoModel::find()->where(['name'=>$goodsName,'isValid'=>GoodsInfoModel::IS_VALID_OK])->asArray()->one();
        }
        return $this->returnApi(Code::SUCCESS,'ok',['detail'=>$detail]);
    }

}