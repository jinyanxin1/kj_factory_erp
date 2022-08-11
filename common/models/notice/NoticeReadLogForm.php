<?php
/**
 *
 * author: jinyanxin
 * Date: 2020/10/27
 * Time: 16:32
 * PHP version 7
 */

namespace common\models\notice;


use common\library\helper\Code;

class NoticeReadLogForm extends NoticeReadLogModel
{

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['userId', 'noticeId','id'], 'safe'],
        ];
    }

    public function saveInfo()
    {
        $info = NoticeReadLogModel::find()->where([
            'userId'=>$this->userId,
            'noticeId'=>$this->noticeId,
            'isValid'=>NoticeReadLogModel::IS_VALID_OK
        ])->one();
        if(empty($info)){
            $info = new NoticeReadLogModel();
            $info->userId = $this->userId;
            $info->noticeId = $this->noticeId;
            if(!$info->save()){
                return ['code'=>Code::PARAM_ERR,'msg'=>'保存失败'];
            }
        }
        return ['code'=>Code::SUCCESS,'msg'=>'保存成功'];
    }

}