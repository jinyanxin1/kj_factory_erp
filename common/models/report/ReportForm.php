<?php

namespace common\models\report;

/**
* Created by cqj
* User: cqj
* Date: 2020-08-10
* Time: 09:14
*/
use common\models\BaseForm;
use common\library\helper\Code;
use common\models\staffInfo\StaffInfoModel;
use common\models\system\section\SectionModel;

class ReportForm extends BaseForm
{
	//TODO 根据表情况新增字段变量
	public $page ;
    public $pageSize ;
    public $startTime ;
    public $endTime ;
    public $name ;
    public $status ;
	public $info ;
    public $list ;
    public $sumList ;

	public $reportId ;
	public $staffId ;
	public $jobAdd ;
	public $interviewAdd ;
	public $entryAdd ;
	public $interviewGoAdd ;

	public function report() {

        $staffNameIds = [];
	    if (!empty($this->name)) {
            $staff = StaffInfoModel::find()
                ->where(['isValid' => StaffInfoModel::IS_VALID_OK])
                ->andWhere(['like','name',$this->name])
                ->asArray()
                ->all();
            if (!empty($staff)) {
                $staffNameIds = array_column($staff,'staffId');
            }else {
                return;
            }
        }


        $list = ReportModel::find()
            ->select(['staffId','time','count(jobAdd) as jobAdd',
                'count(interviewAdd) as interviewAdd','count(entryAdd) as entryAdd',
                'count(interviewGoAdd) as interviewGoAdd'])
            ->filterWhere(['>=' ,'time',$this->startTime])
            ->andFilterWhere(['<=' ,'time',$this->endTime])
            ->andFilterWhere(['staffId'=>$staffNameIds])
            ->groupBy('staffId,time')
            ->asArray()
            ->all();
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
            $this->list = $list;
        }
    }

	/**
	*格式化所有数据
	* @return array
	*/
	public function formatAll() {
		//TODO 按照需求格式化数据
		$formatData = [] ;
		if (empty($this->list)) {
			return [] ;
		}
		foreach ( $this->list as $key => $value ) {
			$item = [] ;
			$formatData[] = $item ;
		}
		return $formatData ;
	}
}