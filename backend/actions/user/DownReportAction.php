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

class DownReportAction extends BaseAction
{

    public function run()
    {

        $entrustId = intval($this->request()->post('entrustId'));
        $type = intval($this->request()->post('type'));
        $entrust = new EntrustBaseForm();
        $entrust->entrustId = $entrustId;

        $result = $entrust->createPdf($type);
        if($result['code'] !== 0){
            return $this->returnApi($result['code'],$result['msg']);
        }
        $file = $result['file'];
        return $this->returnApi(0,'ok',['downUrl'=>$file]);
    }

}