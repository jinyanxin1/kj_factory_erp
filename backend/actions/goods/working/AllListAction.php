<?php
/**
 * 77499
 * 2021/9/10
 */


namespace backend\actions\goods\working;


use backend\actions\BaseAction;
use common\library\helper\Code;
use common\models\goods\GoodsModel;
use common\models\workingProcedure\GoodsWorkingProcedureForm;

class AllListAction extends BaseAction
{

    /**
     * 根据产品id，得到这个产品下的所有工序
     */
    public function run()
    {
        $goodsId = intval($this->request()->post('goodsId'));
        if($goodsId <= 0){
            return $this->returnApi(Code::SUCCESS,'ok');
        }

        $working = new GoodsWorkingProcedureForm();
        $working->goodsId = $goodsId;
        $result = $working->getData();
        $data = [];
        if(count($result['data']) > 0){
            $goods = GoodsModel::getById($goodsId,true);
            $goodsName = !empty($goods) ? $goods['name'] : '';
            $unit = !empty($goods) ? $goods['unit'] : '';
            foreach ($result['data'] as $datum) {
                $data[] = [
                    'goodsId'=>$goodsId,
                    'goodsWorkingId'=>$datum['id'],
                    'name'=>$goodsName,
                    'unit'=>$unit,
                    'workingName'=>$datum['name']
                ];
            }
        }
        return $this->returnApi(Code::SUCCESS,'ok',['data'=>$data]);
    }

}