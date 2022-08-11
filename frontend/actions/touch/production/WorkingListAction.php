<?php
/**
 *
 * author: jinyanxin
 * Date: 2021/7/29
 * Time: 10:45
 * PHP version 7
 */

namespace frontend\actions\touch\production;


use common\library\helper\Code;
use common\models\workingProcedure\GoodsWorkingProcedureForm;
use frontend\actions\BaseAction;

class WorkingListAction extends BaseAction
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