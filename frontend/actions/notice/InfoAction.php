<?php
/**
 * User: pyj
 * Date: 2020/7/27
 * Time: 15:02
 * 通知详情
 */

namespace frontend\actions\notice;


use frontend\actions\WxAction;
use common\library\helper\Code;
use common\models\notice\NoticeModel;
use common\models\staffInfo\StaffInfoModel;

class InfoAction extends WxAction
{
    public function run(){
        //接受传参
        $noticeId = $this->request()->post('noticeId');
        //判断传参
        if(empty($noticeId)){
            return $this->returnApi(Code::PARAM_ERR,'请输入公告编号');
        }
        //查询模型
        $model = NoticeModel::find()
            ->select('title,time,content,staffId,createTime')
            ->where(['isValid'=>NoticeModel::IS_VALID_OK])
            ->andWhere(['noticeId'=>$noticeId])
            ->asArray()
            ->limit(1)
            ->one();

        //判断查询结果
        if(empty($model)){
            return $this->returnApi(Code::PARAM_ERR,'查询无结果');
        }
        //格式化数据
        $stf = StaffInfoModel::find()
            ->select('name,staffId')
            ->where(['staffId'=>$model['staffId']])
            ->asArray()
            ->limit(1)
            ->one();

        $model['staffName'] = isset($stf['name']) ? $stf['name']:'不存在';
        //返回结果
        return $this->returnApi(Code::SUCCESS,'ok',['info' => $model]);
    }
}