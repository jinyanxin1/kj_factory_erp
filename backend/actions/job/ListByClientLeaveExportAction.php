<?php
/**
 * Created by cqj
 * User: cqj
 * Date: 2021/11/11
 * Time: 上午10:17
 * Function:
 */

namespace backend\actions\job;


use backend\actions\BaseAction;
use common\library\helper\Code;
use common\models\jobCareerRecord\JobCareerRecordForm;
use common\models\jobInfo\JobInfoForm;
use yii\helpers\Json;

class ListByClientLeaveExportAction extends BaseAction
{
    public function run() {
        $model = new JobCareerRecordForm() ;
        $list = [] ;
        //TODO 具体情况接收条件参数
        $model->attributes = $this->request()->get() ;
        $model->loginUserId = $this->loginUserId ;
        $model->clientId = intval(\Yii::$app->request->get('clientId',0)) ;
        $model->skillId = \Yii::$app->request->get('skillId') ;
        $model->phone = \Yii::$app->request->get('phone');
        $model->name = \Yii::$app->request->get('name');
        $model->idCard = \Yii::$app->request->get('idCard');

        \Yii::info('数据:'.Json::encode(\Yii::$app->request->get()));
        $ret = $model->getLeaveByClient() ;
        $data = isset($ret['list']) ? $ret['list'] : [] ;
        if (!empty($data)) {
            $model2 = new JobInfoForm() ;
            $model2->list = $data;
            $list = $model2->formatExport() ;
        }
        $fileName =  iconv('utf-8', 'gbk', '人才');
        $columeArr = [
            '序号',
            '姓名',
            '工号',
            '工厂',
            '部门',
            '性别',
            '出生年月日',
            '年龄',
            '身份证号码',
            '家庭住址',
            '联系方式',
            '工作所在地',
            '培训时间',
            '面试时间',
            '合同起止时间',
            '招商银行卡',
            '政治面貌',
            '紧急联系人',
            '联系电话',
            '是否为第一次购买五险',
            '备注',
        ];
        $this->exportData($list,$fileName,$columeArr);
        exit();
    }
}
