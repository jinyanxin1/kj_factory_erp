<?php
/**
 * User: cqj
 * Date: 2020/7/23
 * Time: 9:24 上午
 */

namespace frontend\actions\upcoming;


use frontend\actions\WxAction;
use common\library\helper\Code;
use common\models\clientContract\ClientContractModel;
use common\models\clientInfo\ClientInfoModel;
use common\models\config\ConfigForm;
use common\models\jobInfo\JobInfoModel;
use common\models\staffInfo\StaffInfoModel;
use common\models\supplierContract\SupplierContractModel;

class ListAction extends WxAction
{
    public function run() {
        $time = date('Y-m-d');
        //查看设置是否启动
        $config = new ConfigForm();
        $config->getInfo();
        if (empty($config->contractDay)) {
            return $this->returnApi(Code::SUCCESS, 'ok', []) ;
        }

        //获取预警日期
        $date = $config->calculate($config->contractDay);
        //列出 职工 人才 客户 供应商 合同即将到期的列表
        $list = [];
        //获取合同即将到期的人才
        $job = JobInfoModel::find()
            ->select(['jobId','name','clientId'])
            ->where(['isValid' => JobInfoModel::IS_VALID_OK])
            ->andWhere(['status' => JobInfoModel::STATUS_ENTRY])
            ->andWhere(['<=','endTime',$date]);
        $jobCount = $job->count();
        if ( $jobCount > 0) {
            $job = $job->asArray()->all();
            $jobClient = [];
            foreach ($job as $value) {
                $jobClient[$value['clientId']][] = $value['jobId'];
            }
            $list[] = [
                'title' => '人才合同续签【'.$jobCount.'】',
                'client' => $jobClient,
                'type' => 'job',
                'time' => $time
            ];
        }

        //获取合同即将到期的职工
        $staff = StaffInfoModel::find()
            ->select(['staffId','name'])
            ->where(['isValid' => StaffInfoModel::IS_VALID_OK])
            ->andWhere(['status' => StaffInfoModel::STATUS_ENTRY])
            ->andWhere(['<=','endTime',$date]);
        $staffCount = $staff->count();
        if ($staffCount > 0) {
            $staff = $staff->asArray()->all();
            $staffIds = array_column($staff,'staffId');
            $list[] = [
                'title' => '职工合同续签【'.$staffCount.'】',
                'staffId' => $staffIds,
                'type' => 'staff',
                'time' => $time

            ];
        }

        //获取合同即将到期的客户
        $client = ClientContractModel::find()
            ->where(['isValid' => ClientContractModel::IS_VALID_OK])
            ->andWhere(['use' => ClientContractModel::USE_YES])
            ->andWhere(['<=','endTime',$date]);
        $clientCount = $client->count();
        if ($clientCount>0) {
            $client = $client->asArray()->all();
            $clientIds = array_column($client,'clientId');
            $list[] = [
                'title' => '客户合同续签【'.$clientCount.'】',
                'clientId' => $clientIds,
                'type' => 'client',
                'time' => $time

            ];
        }


        //获取合同即将到期的供应商
        $supplier = SupplierContractModel::find()
            ->where(['isValid' => ClientContractModel::IS_VALID_OK])
            ->andWhere(['use' => ClientContractModel::USE_YES])
            ->andWhere(['<=','endTime',$date]);
        $supplierCount = $supplier->count();
        if ($supplierCount>0) {
            $supplier = $supplier->asArray()->all();
            $supplierIds = array_column($supplier,'supplierId');
            $list[] = [
                'title' => '供应商合同续签【'.$supplierCount.'】',
                'supplierId' => $supplierIds,
                'type' => 'supplier',
                'time' => $time
            ];
        }
        return $this->returnApi(Code::SUCCESS,'ok',['list' => $list]);

    }
}