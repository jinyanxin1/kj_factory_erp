<?php
/**
 *
 * author: jinyanxin
 * Date: 2020/10/23
 * Time: 11:33
 * PHP version 7
 */

namespace common\models\operateLog;


use common\models\clientInfo\ClientInfoModel;
use common\models\jobInfo\JobInfoModel;
use common\models\jobInterviewRecord\JobInterviewRecordModel;
use yii\base\Model;

class OperateLogForm extends OperateLogModel
{
    public $page;
    public $pageSize;

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [
                [
                    'id','type','eventId','clientId','jobId','supplierId','content',
                ],
                'safe'
            ],

        ];
    }


    public function getData()
    {
        $model = OperateLogModel::find()->where(['isValid'=>OperateLogModel::IS_VALID_OK]);
        if($this->type > 0){
            $model->andWhere(['type'=>$this->type]);
        }
        if($this->jobId > 0){
            $model->andWhere(['jobId'=>$this->jobId]);
        }
        $count = $model->count();
        $data = $model->offset(($this->page - 1) * $this->pageSize)->limit('pageSize')->orderBy('createTime desc')->asArray()->all();
        return ['count'=>$count,'data'=>$data];
    }

    public function formatInterviewData($data)
    {
        $returnArr = [];
        if(count($data) > 0){
            $client = ClientInfoModel::find()->where(['clientId'=>array_column($data,'clientId'),'isValid'=>ClientInfoModel::IS_VALID_OK])
                ->indexBy('clientId')->asArray()->all();
            $interview = JobInterviewRecordModel::find()->where(['interviewId'=>array_column($data,'eventId')])
                ->indexBy('interviewId')->asArray()->all();
            foreach ($data as $datum) {
                $returnArr[] = [
                    'clientLogo'=>isset($client[$datum['clientId']]) ? $client[$datum['clientId']]['logo'] : '',
                    'createTime'=>$datum['createTime'],
                    'client'=>isset($client[$datum['clientId']]) ? $client[$datum['clientId']]['name'] : '',
                    'position'=>isset($interview[$datum['eventId']]) ? $interview[$datum['eventId']]['position'] : '',
                    'time'=>isset($interview[$datum['eventId']]) ? $interview[$datum['eventId']]['time'] : '',
                ];
            }
        }
        return $returnArr;
    }

}