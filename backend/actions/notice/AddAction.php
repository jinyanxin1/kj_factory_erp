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

class AddAction extends BaseAction
{
    public function run()
    {
        //获取传参
        $title = $this->request()->post('title');
        $time = $this->request()->post('time');
        $content = $this->request()->post('content');
        $staffId = $this->request()->post('staffId');
        //判断传参
        if (empty($title)) {
            return $this->returnApi(Code::PARAM_ERR, '请输入标题');
        }
        /*if (empty($time)) {
            return $this->returnApi(Code::PARAM_ERR, '请选择面试时间');
        }*/
        $model = new NoticeModel();

        $model->title = $title;
        $model->time = $time;
        $model->content = $content;
        $model->staffId = $staffId;
        $bool = $model->save();
        if (!$bool) {
            return $this->returnApi(Code::PARAM_ERR, '新增失败');
        }
        return $this->returnApi(Code::SUCCESS, '新增成功');

    }
}