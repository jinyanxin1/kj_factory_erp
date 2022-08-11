<?php
/**
 * User: pyj
 * Date: 2020/7/28
 * Time: 15:13
 * 通知删除
 */

namespace backend\actions\notice;


use backend\actions\BaseAction;
use common\library\helper\Code;
use common\models\notice\NoticeModel;

class DeleteAction extends BaseAction
{
    public function run(){
        //接收传参
        $noticeId = $this->request()->post('noticeId');
        //判断传参
        if(empty($noticeId)){
            return $this->returnApi(Code::PARAM_ERR,'请输入编号');
        }
        //修改模型
        $model = NoticeModel::find()
            ->where(['isValid'=>NoticeModel::IS_VALID_OK])
            ->andwhere(['noticeId'=>$noticeId])
            ->limit(1)
            ->one();

        $model->isValid = NoticeModel::IS_VALID_NO;
        $bool = $model->save();
        //判断结果
        if(!$bool){
            return $this->returnApi(Code::PARAM_ERR,'删除失败');
        }
            return $this->returnApi(Code::SUCCESS,'删除成功');

    }
}