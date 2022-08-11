<?php
/**
 *
 * author: jinyanxin
 * Date: 2020/6/8
 * Time: 9:31
 * PHP version 7
 */

namespace backend\actions\user;


use backend\actions\BaseAction;
use backend\models\pdf\GreatePDF;
use common\models\entrust\EntrustBaseForm;

class SendReportAction extends  BaseAction
{

    public function run()
    {
        $entrustId = intval($this->request()->post('entrustId'));
        $type = intval($this->request()->post('type'));

        $entrust = new EntrustBaseForm();
        $entrust->entrustId = $entrustId;
        $result = $entrust->send($this->userAccount,$type);
        return $this->returnApi($result['code'],$result['msg']);

    }

}