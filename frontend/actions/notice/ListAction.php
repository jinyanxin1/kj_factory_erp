<?php
/**
 * User: pyj
 * Date: 2020/7/27
 * Time: 15:03
 * 通知列表
 */

namespace frontend\actions\notice;


use frontend\actions\WxAction;
use common\library\helper\Code;
use common\models\notice\NoticeModel;
use common\models\staffInfo\StaffInfoModel;
use yii\helpers\Json;

class ListAction extends WxAction
{
    public function run(){
       //获取传参
        $page = intval($this->request()->post('page',1));
        $pageSize = intval($this->request()->post('pageSize',10));
        $staffId= $this->request()->post('staffId');
        $maxTime = $this->request()->post('maxTime');
        $minTime = $this->request()->post('minTime');
        //查询模型
        $list = NoticeModel::find()
            ->select('noticeId,title,time,createTime,staffId')
            ->where(['isValid'=>NoticeModel::IS_VALID_OK])
            ->andFilterWhere(['between','time',$minTime, $maxTime])
            ->andFilterWhere(['staffId'=>$staffId]);
        //分页
        $count = $list->count();
        $offset = intval(($page-1)*$pageSize);
        $data = $list->offset($offset)->limit($pageSize)->asArray()->all();

        if(!empty($data)){
            //格式化处理
            $staffIds= array_column($data,'staffId');
            $stf = StaffInfoModel::find()
                ->select('name,staffId')
                ->where(['staffId'=>$staffIds])
                ->asArray()
                ->indexBy('staffId')
                ->all();
            foreach ($data as $key => $value){
              $data[$key]['staffName'] = isset($stf[$value['staffId']]['name']) ? $stf[$value['staffId']]['name'] : '';
            }

        }

        //返回结果
        return $this->returnApi(Code::SUCCESS,'ok',
        ['list'=>$data,'pageInfo'=>$this->getPageInfo($count,$pageSize,$page)]);
    }
}