<?php
/**
 * @Author: jinyanxin
 * @Date: 2020/1/7
 * @Time: 13:06
 * 导出商品
 */


namespace frontend\actions\purchase\goods;


use frontend\actions\WxAction;
use common\library\helper\Code;
use common\models\goods\GoodsExportModel;
use common\models\goods\GoodsModel;

class ExportGoodsAction extends WxAction
{

    public function run()
    {
        $goodsName = $this->request()->get('goodsName');
        $status = $this->request()->get('status',1);

        $model = GoodsModel::find()->where(['status'=>$status,'isValid'=>GoodsModel::IS_VALID_OK]);
        if( !empty($goodsName) ){
            $model->andFilterWhere(['like','goodsName',$goodsName]);
        }
        $data = $model->asArray()->all();
        //导出
        $exportData = GoodsModel::format($data,true,[],1);
        if( count($exportData)<= 0 ){
            return $this->returnApi(Code::PARAM_ERR, '没有数据导出');
        }
        GoodsExportModel::export($exportData);
        exit();
    }

}