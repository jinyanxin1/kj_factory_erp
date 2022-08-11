<?php
/**
 * User: pyj
 * Date: 2020/7/27
 * Time: 15:01
 * 通知新增
 */


namespace backend\actions\notice;


use backend\actions\BaseAction;
use common\library\helper\Code;
use common\models\notice\NoticeModel;

class SaveAction extends BaseAction
{
    public function run()
    {
        //获取传参
        $noticeId = $this->request()->post('noticeId');
        $title = $this->request()->post('title');
        $time = $this->request()->post('time');
        $content = $this->request()->post('content');
        $staffId = $this->request()->post('staffId');
        //判断传参
        if (empty($title)) {
            return $this->returnApi(Code::PARAM_ERR, '请输入标题');
        }
       /* if (empty($time)) {
            return $this->returnApi(Code::PARAM_ERR, '请选择面试时间');
        }*/
        $model = NoticeModel::find()
            ->where(['noticeId' => $noticeId])
            ->limit(1)
            ->one();
        if (empty($model)) {
            return $this->returnApi(Code::PARAM_ERR, '编号错误');
        }


        $model->title = $title;
        $model->time = $time;
        $model->content = $content;
        $model->staffId = $staffId;
        $bool = $model->save();
        if (!$bool) {
            return $this->returnApi(Code::PARAM_ERR, '修改失败');
        }
        return $this->returnApi(Code::SUCCESS, '修改成功');

    }
}