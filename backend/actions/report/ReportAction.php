<?php
/**
 * User: cqj
 * Date: 2020/8/10
 * Time: 9:26 上午
 */

namespace backend\actions\report;


use backend\actions\BaseAction;
use common\library\helper\Code;
use common\models\report\ReportForm;
use common\models\staffInfo\StaffInfoModel;
use common\models\system\section\SectionModel;
use common\models\system\statistical\StatisticalModel;
use yii\helpers\ArrayHelper;

class ReportAction extends BaseAction
{
    public function run () {
        $page = $this->request()->post('page',1) ;
        $pageSize = $this->request()->post('pageSize' , 10) ;

        $startTime = $this->request()->post('startTime') ;
        $endTime = $this->request()->post('endTime') ;
        $name = $this->request()->post('name') ;

        $staffNameIds = [];
        if (!empty($name)) {
            $staff = StaffInfoModel::find()
                ->where(['isValid' => StaffInfoModel::IS_VALID_OK])
                ->andWhere(['like','name',$name])
                ->asArray()
                ->all();
            if (!empty($staff)) {
                $staffNameIds = array_column($staff,'staffId');
            }else {
                return $this->returnApi(Code::SUCCESS, 'ok',['list' => [],'sum' => []]) ;
            }
        }

        $where = [];
        if (!empty($startTime)) {
            $where[] = ['>=' ,'time',$startTime];
        }

        if (!empty($endTime)) {
            $where[] = ['<=' ,'time',$endTime];
        }

        if (!empty($staffNameIds)) {
            $where[] = ['staffId'=>$staffNameIds];
        }


        $model = StatisticalModel::getPage($page,$pageSize,['*'],$where, true,'time desc');
        $list = $model['list'];
        $count = $model['count'];

        $sumModel = StatisticalModel::getAll(['*'],$where, true,'time');
        $sumList = $sumModel['list'];
        $sum = [];
        if (!empty($sumList)) {
            $timeList = ArrayHelper::index($sumList,null,'time');
            foreach ($timeList as $key =>$value) {
                $item = [
                    'time' => $key,
                    'jobAdd' => 0 ,
                    'interviewAdd' => 0 ,
                    'entryAdd' => 0 ,
                    'interviewGoAdd' => 0 ,
                ];
                foreach ($value as $v) {
                    $item['jobAdd'] += $v['jobAdd'];
                    $item['interviewAdd'] += $v['interviewAdd'];
                    $item['entryAdd'] += $v['entryAdd'];
                    $item['interviewGoAdd'] += $v['interviewGoAdd'];
                }
                $sum[] = $item;
            }
        }

        if (!empty($list)) {
            $staffIds = array_column($list,'staffId');
            $staffList = StaffInfoModel::find()
                ->where(['staffId' => $staffIds])
                ->indexBy('staffId')
                ->all();
            $sectionIds = array_column($staffList,'sectionId');
            $sectionList = SectionModel::find()
                ->where(['sectionId' => $sectionIds])
                ->indexBy('sectionId')
                ->asArray()
                ->all();
            foreach ($list as $key => $value) {
                $list[$key]['staffName'] = isset($staffList[$value['staffId']]) ?
                    $staffList[$value['staffId']]['name'] : '';
                $list[$key]['sectionId'] = isset($staffList[$value['staffId']]) ?
                    $staffList[$value['staffId']]['sectionId'] : '';
                $list[$key]['section'] = isset($sectionList[$list[$key]['sectionId']]['name']) ?
                    $sectionList[$list[$key]['sectionId']]['name'] : '';
            }
        }

        return $this->returnApi(Code::SUCCESS, 'ok',['list' => $list,
            'sum' => $sum,'pageInfo' => $this->getPageInfo($count,$pageSize,$page)]) ;
    }
}