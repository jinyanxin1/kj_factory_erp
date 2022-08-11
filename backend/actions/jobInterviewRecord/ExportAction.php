<?php
/**
 * User: cqj
 * Date: 2020/8/10
 * Time: 2:06 下午
 */

namespace backend\actions\jobInterviewRecord;


use backend\actions\BaseAction;
use common\models\jobInterviewRecord\JobInterviewRecordForm;

class ExportAction extends BaseAction
{
    public function run () {
        $model = new JobInterviewRecordForm() ;

        $model->clientId = intval(\Yii::$app->request->get('clientId')) ;
        $model->staffId = $this->staffId ;
        $model->status	 = intval(\Yii::$app->request->get('status',0)) ;
        $startTime	 = (\Yii::$app->request->get('startTime')) ;
        $endTime	 = (\Yii::$app->request->get('endTime')) ;
        $where = [];
        $where[] = [
            'staffId' => $model->staffId
        ];
        if (!empty($startTime)) {
            $where[] = ['>=','time',$startTime];
        }

        if (!empty($endTime)) {
            $where[] = ['<=','time',$endTime];
        }

        if (!in_array($model->status,[-1,0])) {
            $where[] = [
                'status' => $model->status
            ];
        }

        if (!empty($model->clientId)) {
            $where[] = [
                'clientId' => $model->clientId
            ];
        }

        $ret = $model->getAll($where) ;
        $data = $model->list;
        $list = [];
        if (!empty($data)) {
            $list = $model->formatPage() ;
        }
        $exportData = [];
        foreach ($list as $value) {
            $item = [] ;
            $item[0] = $value['jobName'];
            $item[1] = $value['age'];
            $item[2] = $value['sexName'];
            $item[3] = $value['phone'];
            $item[4] = $value['client'];
            $item[5] = $value['position'];
            $item[6] = $value['time'];
            $item[7] = $value['statusName'];
            $exportData[] = $item;
        }
        $fileName =  iconv('utf-8', 'gbk', '邀约记录');
        $this->exportData($exportData,$fileName,['姓名','年龄','性别','手机号','公司/工厂','面试岗位','面试时间','状态']);
        exit();
    }


}