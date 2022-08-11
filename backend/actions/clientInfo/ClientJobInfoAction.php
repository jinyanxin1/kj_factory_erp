<?php
/**
 * User: cqj
 * Date: 2020/7/10
 * Time: 11:06 上午
 */

namespace backend\actions\clientInfo;


use backend\actions\BaseAction;
use common\library\helper\Code;
use common\models\jobInfo\JobInfoForm;

class ClientJobInfoAction extends BaseAction
{
    public function run() {
        $model = new JobInfoForm() ;
        $model->jobId = intval(\Yii::$app->request->post('jobId')) ;
        $data = $model->getClientJobInfo() ;
        return $this->returnApi(Code::SUCCESS, 'ok', [ 'info' => $data ]) ;
    }
}