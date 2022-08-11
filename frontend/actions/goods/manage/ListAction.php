<?php
/**
 *
 * author: jinyanxin
 * Date: 2020/9/7
 * Time: 9:32
 * PHP version 7
 */

namespace frontend\actions\goods\manage;


use frontend\actions\BaseAction;
use common\library\helper\Code;
use common\models\goods\GoodsForm;

class ListAction extends BaseAction
{

    public function run()
    {
        $page = intval($this->request()->post('page',1));
        $pageSize = intval($this->request()->post('pageSize',10));
        $name = $this->request()->post('name');
        $isFinished = intval($this->request()->post('isFinished'));
        $type = intval($this->request()->post('type'));
        $goods = new GoodsForm();
        $goods->page = $page;
        $goods->pageSize = $pageSize;
        $goods->name = $name;
        $goods->isFinished = $isFinished;
        $goods->type = $type;
        $result = $goods->getData();

        return $this->returnApi(Code::SUCCESS,'ok',[
            'list'=>$goods->formatData($result['data']),
            'pageInfo'=>$this->getPageInfo($result['count'],$goods->pageSize,$goods->page)
        ]);
    }

}