<?php
/**
 *
 * author: jinyanxin
 * Date: 2020/9/2
 * Time: 9:47
 * PHP version 7
 */

namespace backend\actions\project\manage;


use backend\actions\BaseAction;
use backend\models\project\ProjectForm;
use common\library\helper\Code;

class ListAction extends BaseAction
{
    /*
     * 项目列表
     * */
    public function run()
    {
        $postData = $this->request()->post();

        $project = new ProjectForm();
        $project->attributes = $postData;

        $result = $project->getData();

        return $this->returnApi(Code::SUCCESS,'ok',[
            'list'=>$project->formatData($result['data']),
            'pageInfo'=>$this->getPageInfo($result['count'],$project->pageSize,$project->page)
        ]);

    }

}