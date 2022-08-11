<?php
/**
 * User: pyj
 * Date: 2020/7/29
 * Time: 9:58
 * 通知批量删除
 */

namespace backend\actions\notice;


use backend\actions\BaseAction;
use common\library\helper\Code;
use common\models\notice\NoticeModel;

class DelsAction extends BaseAction
{
    public function run(){
        //获取参数
        $noticeId  = $this->request()->post('noticeId');
//        判断传参
        if(empty($noticeId)){
           return $this->returnApi(Code::PARAM_ERR,'通知编号不能为空');
        }
//        修改模型
        NoticeModel::updateAll(['isValid'=>NoticeModel::IS_VALID_NO],['noticeId'=>$noticeId]);
//        返回结果
        return $this->returnApi(Code::SUCCESS,'删除成功');
    }

}