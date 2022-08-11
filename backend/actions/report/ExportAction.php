<?php
/**
 * User: cqj
 * Date: 2020/9/1
 * Time: 2:53 下午
 */

namespace backend\actions\report;


use backend\actions\BaseAction;
use common\library\helper\Code;
use common\models\staffInfo\StaffInfoModel;
use common\models\system\section\SectionModel;
use common\models\system\statistical\StatisticalModel;
use yii\helpers\Json;

class ExportAction extends BaseAction
{
    public function run () {
        $fileName =  iconv('utf-8', 'gbk', '数据报表');

        $startTime = $this->request()->get('startTime') ;
        $endTime = $this->request()->get('endTime') ;
        $name = $this->request()->get('name') ;
        \Yii::info(Json::encode($this->request()->post()));
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
                $this->exportData([],$fileName,['日期','部门','职工姓名','录入人才数','邀约数量','入职数量','参加面试数量']);
            }
        }

        $where = [];
        if (!empty($startTime)) {
            $where[] = ['>=' ,'time',$startTime.' 00:00:00'];
        }

        if (!empty($endTime)) {
            $where[] = ['<=' ,'time',$endTime.' 23:59:59'];
        }

        if (!empty($staffNameIds)) {
            $where[] = ['staffId'=>$staffNameIds];
        }
        \Yii::info('staffId:'.Json::encode($staffNameIds));

        $model = StatisticalModel::getAll(['*'],$where, true,'time');
        $list = $model['list'];
        \Yii::info('数据:'.Json::encode($list));
        $listData = [];
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
                $list[$key]['sectionId'] = isset($staffList[$value['staffId']]) ?
                    $staffList[$value['staffId']]['sectionId'] : '';
                $item = [];
                $item[0] = $value['time'];
                $item[1] = isset($sectionList[$list[$key]['sectionId']]['name']) ?
                    $sectionList[$list[$key]['sectionId']]['name'] : '';
                $item[2] = isset($staffList[$value['staffId']]) ?
                    $staffList[$value['staffId']]['name'] : '';
                $item[3] = $value['jobAdd'];
                $item[4] = $value['interviewAdd'];
                $item[5] = $value['entryAdd'];
                $item[6] = $value['interviewGoAdd'];
                $listData[] = $item;
            }
        }

        $this->exportData($listData,$fileName,['日期','部门','职工姓名','录入人才数','邀约数量','入职数量','参加面试数量']);
        exit();
    }
}