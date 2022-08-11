<?php
/**
 * User: pyj
 * Date: 2020/8/11
 * Time: 10:30
 * 招聘详情
 */

namespace frontend\actions\recruitment;


use common\kjlib\auth\AuthCode;
use common\kjlib\auth\WXUserAuth;
use common\library\helper\Code;
use common\models\clientInfo\ClientInfoModel;
use common\models\jobRegistra\JobRegistraModel;
use common\models\recruitment\RecruitmentModel;
use common\models\system\basis\BasisModel;
use frontend\actions\BaseAction;
use yii\helpers\Json;

class InfoAction extends BaseAction
{
    public function run(){
        //接收参数
        $recruitmentId = $this->request()->post('recruitmentId');

        //判断传值
        if(empty($recruitmentId)){
            return $this->returnApi(Code::PARAM_ERR,'招聘编号不能为空');
        }

        //查询模型
        $model = RecruitmentModel::find()
            ->select('recruitmentId,post,minSalary,maxSalary,minAge,maxAge,sex,education,clientId
            ,advantage,provinceId,cityId,areaId,isValid')
            ->where(['recruitmentId' => $recruitmentId])
            ->asArray()
            ->limit(1)
            ->one();

        //判读查询结果
        if (empty($model)){
            return $this->returnApi(Code::PARAM_ERR,'查询结果为空');
        }

        //格式化数据
        $list = ClientInfoModel::find()
            ->select('clientId,logo,name,createTime,introduction,tell,range')
            ->where(['clientId' => $model['clientId']])
            ->asArray()
            ->limit(1)
            ->one();

        $model['clientLogo'] = \Yii::$app->params['imageUrl'].$list['logo'];
        $model['clientName'] = isset($list['name']) ? $list['name'] : '';

        $model['clientIntroduction'] = $list['introduction'];
        $model['clientTell'] = $list['tell'];
        $model['sexName'] = isset(RecruitmentModel::$SEX_ENUM[$model['sex']]) ?
            RecruitmentModel::$SEX_ENUM[$model['sex']] : "";
        $model['educationName'] = isset(RecruitmentModel::$EDUCATION_ENUM[$model['education']]) ?
            RecruitmentModel::$EDUCATION_ENUM[$model['education']] : "";
        $model['registration'] = false;

        $model['minSalary'] = intval($this->amountToYuan($model['minSalary']));
        $model['maxSalary'] = intval($this->amountToYuan($model['maxSalary']));
        $model['days'] = $this->getDay($list['createTime']);
        $model['range'] = BasisModel::getBasicsName($list['range']);



        if (empty($this->token)) {
            return  $this->returnApi(Code::SUCCESS,'ok',['list' => $model]);
        }
        $info = $this->tokenData;
        $jobId = null;
        if(empty($info)){
            return  $this->returnApi(Code::LOGIN_ERR,'请进行微信授权登录');
        }else{
            $data = Json::decode($info);
            $job = $data['jobId'] ?? '';
            $jobId = AuthCode::authcode($job, 'DECODE', WXUserAuth::WEIXIN_COOKIE_KEY);
        }

        if (empty($jobId)) {
            return  $this->returnApi(Code::PARAM_ERR,'请使用人才报名');
        }
        $reg = JobRegistraModel::find()
            ->where(['jobId' =>$jobId,'recruitmentId' => $recruitmentId,'isValid' =>JobRegistraModel::IS_VALID_OK])
            ->limit(1)
            ->one();
        if (!empty($reg)) {
            $model['registration'] = true;
        }

        //返回结果
        return  $this->returnApi(Code::SUCCESS,'ok',['list' => $model]);

    }
}