<?php
/**
 *
 * author: jinyanxin
 * Date: 2020/10/24
 * Time: 11:12
 * PHP version 7
 */

namespace common\models\system\statistical;


use common\library\helper\Code;

class JobWorkHourStatisticsDayForm extends JobWorkHourStatisticsDayModel
{

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [
                [
                    'id', 'jobId', 'clientId', 'workHour', 'isUsed', 'date'
                ],
                'safe'
            ],
        ];
    }


    public function saveInfo()
    {
        if($this->id > 0){
            $info = JobWorkHourStatisticsDayModel::getById($this->id,false);
            if(empty($info)){
                return ['code'=>Code::PARAM_ERR,'msg'=>'信息不存在'];
            }
        }else{
            $info = JobWorkHourStatisticsDayModel::find()->where([
                'jobId'=>$this->jobId,
                'clientId'=>$this->clientId,
                'date'=>$this->date,
                'isValid'=>JobWorkHourStatisticsDayModel::IS_VALID_OK
            ])->one();
            if(empty($info)){
                $info = new JobWorkHourStatisticsDayModel();
            }
        }
        $info->jobId = $this->jobId;
        $info->clientId = $this->clientId;
        $info->date = $this->date;
        $info->workHour = $this->workHour;
        $info->isUsed = JobWorkHourStatisticsDayModel::USED_NO;
        if(!$info->save()){
            return ['code'=>Code::PARAM_ERR,'msg'=>'保存失败'];
        }
        return ['code'=>Code::SUCCESS,'msg'=>'保存成功'];
    }

}