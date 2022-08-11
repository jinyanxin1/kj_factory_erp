<?php
/**
 * @Author: jinyanxin
 * @Date: 2020/2/5
 * @Time: 9:26
 */


namespace backend\actions\purchase\store;


use backend\actions\BaseAction;
use common\library\helper\Code;
use common\models\purchase\StockRecordForm;

class StoreManageAction  extends BaseAction
{

    public function run()
    {
        //仓库id
        $houseId = intval($this->request()->post('houseId'));
        //类型
        $type = intval($this->request()->post('type'));
        $userName = $this->request()->post('userName');
        $startTime = $this->request()->post('startTime');
        $endTime = $this->request()->post('endTime');
        $page = intval($this->request()->post('page',1));
        $pageSize = intval($this->request()->post('pageSize',10));
        $goodsType = intval($this->request()->post('goodsType'));//1产品；2物料

        if($houseId <= 0){
            return $this->returnApi(Code::PARAM_ERR,'请选择仓库');
        }
        if($type <= 0){
            return $this->returnApi(Code::PARAM_ERR,'类型错误');
        }
        if(!empty($startTime)){
            $startTime = date('Y-m-d 00:00:00',strtotime($startTime));
        }
        if(!empty($endTime)){
            $endTime = date('Y-m-d 23:59:59',strtotime($endTime));
        }
        $stockRecord = new StockRecordForm();
        $stockRecord->houseId = $houseId;
        $stockRecord->type = $type;
        $stockRecord->recordUserName = $userName;
        $stockRecord->startTime = $startTime;
        $stockRecord->endTime = $endTime;
        $stockRecord->page = $page;
        $stockRecord->pageSize = $pageSize;
        $stockRecord->goodsType = $goodsType;

        $data = $stockRecord->getData();

        $count = $data['count'];
        $showList = $data['showList'];

        return $this->returnApi(Code::SUCCESS,'ok',[
            'showList'=>$showList,
            'pageInfo'=>$this->getPageInfo($count,$pageSize,$page)
        ]);
    }

}