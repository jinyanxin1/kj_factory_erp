<?php
/**
 *
 * author: jinyanxin
 * Date: 2020/9/2
 * Time: 9:46
 * PHP version 7
 */

namespace backend\actions\project\manage;


use backend\actions\BaseAction;
use backend\models\project\ProjectForm;

class SaveAction extends BaseAction
{
    /*
     * 项目信息保存
     * */
    public function run()
    {
        $postData = $this->request()->post();

        $project = new ProjectForm();
        $project->attributes = $postData;
        $result = $project->saveInfo();

        return $this->returnApi($result['code'],$result['msg']);
    }

}