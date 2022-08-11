<?php
/**
 *
 * author: jinyanxin
 * Date: 2020/10/30
 * Time: 12:00
 * PHP version 7
 */

namespace backend\actions\job;


use backend\actions\BaseAction;
use common\library\helper\Code;
use common\models\dataImportLog\DataImportLogModel;
use common\models\staffInfo\StaffInfoModel;

class ImportListAction extends BaseAction
{

    public function run()
    {
        $page = intval($this->request()->post('page',1));
        $pageSize = intval($this->request()->post('pageSize',10));
        $staffId = intval($this->request()->post('staffId'));

        $model = DataImportLogModel::find()->where(['isValid'=>DataImportLogModel::IS_VALID_OK]);
        if($staffId > 0){
            $model->andWhere(['staffId'=>$staffId]);
        }
        $count = $model->count();
        $data = $model->offset(($page - 1) * $pageSize)->limit($pageSize)->orderBy('createTime desc')
            ->asArray()->all();

        $returnArr = [];
        if(count($data) > 0){
            $staff = StaffInfoModel::find()->select('staffId,name')->where([
                'staffId'=>array_unique(array_column($data,'staffId')),
                'isValid'=>StaffInfoModel::IS_VALID_OK
            ])->indexBy('staffId')->asArray()->all();
            $status = DataImportLogModel::$statusList;
            foreach ($data as $datum) {
                $returnArr[] = [
                    'staffName'=>isset($staff[$datum['staffId']]) ? $staff[$datum['staffId']]['name'] : '',
                    'status'=>isset($status[$datum['status']]) ? $status[$datum['status']] : '',
                    'error'=>$datum['error'],
                    'createTime'=>$datum['createTime']
                ];
            }
        }
        return $this->returnApi(Code::SUCCESS,'ok',[
            'list'=>$returnArr,
            'pageInfo'=>$this->getPageInfo($count,$pageSize,$page)
        ]);
    }

}