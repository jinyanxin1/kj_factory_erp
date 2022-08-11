<?php
/**
 * User: pyj
 * Date: 2020/8/6
 * Time: 11:09
 * 招聘列表
 */

namespace backend\actions\recruitment;


use backend\actions\BaseAction;
use common\library\helper\Code;
use common\models\clientInfo\ClientInfoModel;
use common\models\recruitment\RecruitmentModel;
use common\models\staffInfo\StaffInfoModel;

class ListAction extends BaseAction
{
    public function run(){
        //接收参数
        $page = intval($this->request()->post('page',1));
        $pageSize = intval($this->request()->post('pageSize',10));
        $minTime = $this->request()->post('minTime');
        $maxTime = $this->request()->post('maxTime');
        $status = $this->request()->post('status');

        if(!empty($minTime) || !empty($maxTime)){
            $minTime = $minTime.' 00:00:00';
            $maxTime = $maxTime.' 23:59:59';
        }



        //查询模型
        $model = RecruitmentModel::find()
            ->select('recruitmentId,clientId,post,staffId,updateTime,isValid,status')
            ->where(['isValid' => RecruitmentModel::IS_VALID_OK])
            ->andFilterWhere(['between','createTime',$minTime,$maxTime])
            ->andFilterWhere(['status' => $status]);


        //判断查询结果
        if (empty($model)){
            return $this->returnApi(Code::PARAM_ERR,'查询结果为空');
        }

        //分页
        $count = $model->count();
        $offset = $this->getOffset($page,$pageSize);
        $list = $model->offset($offset)->limit($pageSize)->orderBy('updateTime desc')->asArray()->all();

        //格式化数据
        if(!empty($list)){
            $stfid = array_column($list,'staffId');
            $cid = array_column($list,'clientId');
            $sname = StaffInfoModel::find()
                ->select('staffId,name')
                ->where(['staffId' => $stfid])
                ->indexBy('staffId')
                ->asArray()
                ->all();
            $cname = ClientInfoModel::find()
                ->select('clientId,name')
                ->where(['clientId' => $cid])
                ->indexBy('clientId')
                ->asArray()
                ->all();
            foreach ($list as $key => $value){
                $list[$key]['staffName'] = isset($sname[$value['staffId']]['name'])?
                    $sname[$value['staffId']]['name'] : "";

                $list[$key]['clientName'] = isset($cname[$value['clientId']]['name'])?
                    $cname[$value['clientId']]['name'] : "";
            }

        }

        //返回结果
        return $this->returnApi(Code::SUCCESS,'ok',
            ['list' => $list, 'pageInfo' => $this->getPageInfo($count,$pageSize,$page)]);
    }
}