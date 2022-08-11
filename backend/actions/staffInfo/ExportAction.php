<?php
/**
 *
 * author: jinyanxin
 * Date: 2020/12/9
 * Time: 9:31
 * PHP version 7
 */

namespace backend\actions\staffInfo;


use backend\actions\BaseAction;
use common\library\helper\Code;
use common\models\staffInfo\StaffInfoForm;

class ExportAction extends BaseAction
{

    public function run()
    {
        $model = new StaffInfoForm() ;
        $list = [] ;
        //TODO 具体情况接收条件参数
        $model->attributes = $this->request()->post() ;
        $model->status = intval(\Yii::$app->request->post('status',-1)) ;
        $model->sex = intval(\Yii::$app->request->post('sex',-1)) ;
        $model->sectionId = intval(\Yii::$app->request->post('sectionId')) ;
        $model->positionId = intval(\Yii::$app->request->post('positionId')) ;
        $model->staffId = \Yii::$app->request->post('staffId') ;
        $model->name = \Yii::$app->request->post('name') ;
        $model->phone = $this->request()->post('phone');
        $where = [];

        if ($model->status != -1) {
            $where[] = ['status' => $model->status];
        }

        if ($model->sex != -1) {
            $where[] = ['sex' => $model->sex];
        }

        if (!empty($model->staffId)) {
            $where[] = ['staffId' => $model->staffId];
        }

        if (!empty($model->sectionId)) {
            $where[] = ['sectionId' => $model->sectionId];
        }
        if (!empty($model->positionId)) {
            $where[] = ['positionId' => $model->positionId];
        }
        if (!empty($model->name)) {
            $where[] = ['like' ,'name',$model->name];
        }
        if(!empty($model->phone)){
            $where[] = ['phone'=>$model->phone];
        }
        $ret = $model->getPage($where) ;
        $data = isset($ret['list']) ? $ret['list'] : [] ;
        if (!empty($data)) {
            $list = $model->formatExport() ;
        }
        //导出
        $fileName =  iconv('utf-8', 'gbk', '职工');
        //入职时间，合同日期，工龄、婚姻状态，政治面貌，住址，学历信息，银行卡信息，紧急联系人
        $this->exportData($list,$fileName,[
            '员工姓名','电话','身份证号','入职日期'
        ]);
        exit();
    }

}