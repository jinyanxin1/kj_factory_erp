<?php
/**
 *
 * author: jinyanxin
 * Date: 2021/7/27
 * Time: 15:21
 * PHP version 7
 */

namespace backend\actions\goods\working;


use backend\actions\BaseAction;
use common\library\helper\Code;
use common\models\workingProcedure\GoodsWorkingProcedureForm;

class ListAction extends BaseAction
{

    public function run()
    {
        $page = intval($this->request()->post('page'));
        $pageSize = intval($this->request()->post('pageSize'));
        $goodsId = intval($this->request()->post('goodsId'));

        $working = new GoodsWorkingProcedureForm();
        $working->goodsId = $goodsId;
        $working->page = $page;
        $working->pageSize = $pageSize;
        $result = $working->getData();

        return $this->returnApi(Code::SUCCESS,'ok',[
            'list'=>$working->formatData($result['data']),
            'pageInfo'=>$this->getPageInfo($result['count'],$pageSize,$page)
        ]);
    }

}