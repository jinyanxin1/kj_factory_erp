<?php
/**
 *
 * author: jinyanxin
 * Date: 2021/7/27
 * Time: 17:02
 * PHP version 7
 */

namespace backend\actions\workRecord;


use backend\actions\BaseAction;
use common\library\helper\Code;
use common\models\workRecord\WorkRecordForm;

class ListAction extends BaseAction
{

    public function run()
    {
        $page = intval($this->request()->post('page'));
        $pageSize = intval($this->request()->post('pageSize'));
        $staffName = $this->request()->post('staffName');
        $startDate = $this->request()->post('startDate');
        $endDate = $this->request()->post('endDate');
        $goodsName = $this->request()->post('goodsName');
        $type = intval($this->request()->post('type'));

        $work = new WorkRecordForm();
        $work->page = $page;
        $work->pageSize = $pageSize;
        $work->staffName = $staffName;
        $work->startDate = $startDate;
        $work->endDate = $endDate;
        $work->goodsName = $goodsName;
        $work->type = $type;
        $result = $work->getData();

        return $this->returnApi(Code::SUCCESS,'ok',[
            'list'=>$work->formatData($result['data']),
            'pageInfo'=>$this->getPageInfo($result['count'],$pageSize,$page)
        ]);
    }


}