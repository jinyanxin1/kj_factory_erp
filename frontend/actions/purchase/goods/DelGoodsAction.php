<?php
/**
 * @Author: jinyanxin
 * @Date: 2020/1/7
 * @Time: 12:53
 */


namespace frontend\actions\purchase\goods;


use frontend\actions\WxAction;
use common\library\helper\Code;
use common\models\goods\GoodsModel;

class DelGoodsAction extends WxAction
{

    public function run()
    {
        $goodsIds = $this->request()->post('goodsIds');
        if((!is_array($goodsIds)) || (count($goodsIds)<=0)){
            return $this->returnApi(Code::PARAM_ERR,'请选择删除的商品');
        }
        GoodsModel::updateAll(['isValid'=>GoodsModel::IS_VALID_NO],['goodsId'=>$goodsIds]);
        return $this->returnApi(Code::SUCCESS,'删除成功');
    }

}