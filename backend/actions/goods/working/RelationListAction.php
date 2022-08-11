<?php
/**
 *
 * author: jinyanxin
 * Date: 2021/7/30
 * Time: 15:07
 * PHP version 7
 */

namespace backend\actions\goods\working;



use backend\actions\BaseAction;
use common\library\helper\Code;
use common\models\BaseModel;
use common\models\goods\GoodsModel;
use common\models\purchase\GoodsStockModel;
use common\models\workingProcedure\GoodsWorkingProcedureModel;

class RelationListAction extends BaseAction
{

    public function run()
    {
        $page = intval($this->request()->post('page'));
        $pageSize = intval($this->request()->post('pageSize'));
        $name = $this->request()->post('name');
        $type = intval($this->request()->post('type'));
        $isFinished = intval($this->request()->post('isFinished'));

        $goods = GoodsModel::find()->where(['type'=>$type,'isValid'=>GoodsModel::IS_VALID_OK]);
        if(!empty($name)){
            if(strpos($name,'(')){
                $name = substr($name,0,strpos($name,'(')-1);
            }
            if(!empty($name)){
                $goods->andWhere(['like','name',$name]);
            }
        }
        if($isFinished > 0){
            $goods->andWhere(['isFinished'=>$isFinished]);
        }
        $goods = $goods->asArray()->all();
        $goodsIds = array_column($goods,'id');
        //产品的所有工序
        $workingList = [];
        $working = GoodsWorkingProcedureModel::find()
            ->where(['goodsId'=>$goodsIds,'isValid'=>GoodsWorkingProcedureModel::IS_VALID_OK])
            ->orderBy('goodsId desc,sort asc')->asArray()->all();
        if(count($working) > 0){
            foreach ($working as $item) {
                $item['id'] = intval($item['id']);
                $workingList[$item['goodsId']][] = $item;
            }
        }
        //库存
        $stockList = [];
        $stock = GoodsStockModel::find()
            ->where(['goodsId'=>$goodsIds,'wareHouseId'=>BaseModel::HOUSE_ID,'isValid'=>GoodsStockModel::IS_VALID_OK])
            ->asArray()->all();
        if(count($stock) > 0){
            foreach ($stock as $item) {
                $stockList[$item['goodsId'].'-'.$item['workingId']] = intval($item['num']);
            }
        }

        /*
         * 格式化数据
         * */
        $goodsList = [];
        if(count($goods) > 0){
            foreach ($goods as $good) {
                if($good['type'] == GoodsModel::TYPE_MATERIEL){
                    $key = $good['id'].'-0';
                    $goodsList[] = [
                        'id'=>intval($good['id']),
                        'workingId'=>0,
                        'name'=>$good['name'],
                        'workingName'=>'',
                        'unit'=>$good['unit'],
                        'attr'=>$good['attr'],
                        'stock'=>isset($stockList[$key]) ? $stockList[$key] : 0,
                    ];
                }else{
                    if(isset($workingList[$good['id']]) && count($workingList[$good['id']]) > 0){
                        foreach ($workingList[$good['id']] as $item) {
                            $key = $good['id'].'-'.$item['id'];
                            $goodsList[] = [
                                'id'=>intval($good['id']),
                                'workingId'=>$item['id'],
                                'name'=>$good['name'],
                                'workingName'=>$item['name'],
                                'unit'=>$good['unit'],
                                'attr'=>$good['attr'],
                                'stock'=>isset($stockList[$key]) ? $stockList[$key] : 0,
                            ];
                        }
                    }
                }
            }
        }
        $count = count($goodsList);
        if($page > 0 && $pageSize > 0){
            $goodsList = array_slice($goodsList,($page - 1) * $pageSize,$pageSize);
        }
        return $this->returnApi(Code::SUCCESS,'ok',[
            'list'=>$goodsList,
            'pageInfo'=>$this->getPageInfo($count,$pageSize,$page)
        ]);
    }

}