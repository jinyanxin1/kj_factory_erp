<?php
/**
 *
 * author: jinyanxin
 * Date: 2020/11/16
 * Time: 11:40
 * PHP version 7
 */

namespace backend\actions\purchase\wareHouse;


use backend\actions\BaseAction;
use common\library\helper\Code;
use common\models\purchase\WareHouseForm;

class ListAction extends BaseAction
{


    public function run()
    {
        $page = intval($this->request()->post('page',1));
        $pageSize = intval($this->request()->post('pageSize',10));
        $post = $this->request()->post();

        $wareHouse = new WareHouseForm();
        $wareHouse->attributes = $post;
        $wareHouse->page = $page;
        $wareHouse->pageSize = $pageSize;
        $result = $wareHouse->getData();

        return $this->returnApi(Code::SUCCESS,'ok',[
            'list'=>$wareHouse->formatData($result['data']),
            'pageInfo'=>$this->getPageInfo($result['count'],$pageSize,$page)
        ]);
    }

}