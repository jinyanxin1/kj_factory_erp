<?php
/**
 * User: pyj
 * Date: 2020/8/7
 * Time: 17:50
 * 招聘详情
 */

namespace backend\actions\recruitment;


use backend\actions\BaseAction;
use common\library\helper\Code;
use common\models\clientInfo\ClientInfoModel;
use common\models\recruitment\RecruitmentModel;
use common\models\staffInfo\StaffInfoModel;

class InfoAction extends BaseAction
{
    public function run(){
        //接收参数
        $recruitmentId = $this->request()->post('recruitmentId');

        //判断传参
        if(empty($recruitmentId)){
            return $this->returnApi(Code::PARAM_ERR,'招聘编号不能为空');
        }

        //查询模型
        $model = RecruitmentModel::find()
            ->select('clientId,post,sex,minSalary,maxSalary,minAge,
                maxAge,education,provinceId,cityId,areaId,advantage,staffId,instructions,status')
            ->where(['isValid' => RecruitmentModel::IS_VALID_OK,'recruitmentId' => $recruitmentId])
            ->limit(1)
            ->asArray()
            ->one();

        //判断查询结果
        if(empty($model)){
            return $this->returnApi(Code::PARAM_ERR,'查询结果为空');
        }

        //格式化数据
        $cid = ClientInfoModel::find()
            ->select('name,clientId')
            ->where(['clientId' => $model['clientId']])
            ->indexBy('clientId')
            ->asArray()
            ->limit(1)
            ->one();

        $sid = StaffInfoModel::find()
            ->select('staffId,name')
            ->where(['staffId' => $model['staffId']])
            ->asArray()
            ->limit(1)
            ->one();

        $model['staffName'] = isset($sid['name']) ? $sid['name'] : "";
        $model['clientName'] = isset($cid['name']) ? $cid['name'] : "";

        $model['sexName'] = isset(RecruitmentModel::$SEX_ENUM[$model['sex']]) ?
            RecruitmentModel::$SEX_ENUM[$model['sex']] : "";
        $model['educationName'] = isset(RecruitmentModel::$EDUCATION_ENUM[$model['education']])?
            RecruitmentModel::$EDUCATION_ENUM[$model['education']] : "";
        $model['minSalary'] = $this->amountToYuan($model['minSalary']);
        $model['maxSalary'] = $this->amountToYuan($model['maxSalary']);
        $model['area'] = [
            $model['provinceId'],
            $model['cityId'],
            $model['areaId']
        ];

        //返回结果
        return $this->returnApi(Code::SUCCESS,'ok',['list' => $model]);
    }
}