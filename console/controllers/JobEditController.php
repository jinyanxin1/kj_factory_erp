<?php
/**
 *
 * author: jinyanxin
 * Date: 2020/10/30
 * Time: 11:33
 * PHP version 7
 */

namespace console\controllers;


use common\library\helper\Code;
use common\models\BaseModel;
use common\models\clientInfo\ClientInfoModel;
use common\models\dataImportLog\DataImportLogModel;
use common\models\jobCareerRecord\JobCareerRecordModel;
use common\models\jobContract\JobContractModel;
use common\models\jobInfo\JobInfoModel;
use common\models\report\ReportModel;
use common\models\staffInfo\StaffInfoModel;
use common\models\system\basis\BasisModel;
use common\models\User;
use yii\console\Controller;
use yii\helpers\ArrayHelper;
use yii\helpers\Json;

class JobEditController extends Controller
{

    public function actionIndex()
    {
        $fileUrl = '/data/www/oa_cz.com/backend/web/人才导入模板1.xlsx';

        require_once \Yii::getAlias('@common') . '/kjlib/PHPExcel/PHPExcel/IOFactory.php';
        $objPHPExcel = \PHPExcel_IOFactory::load($fileUrl);
        $sheet = $objPHPExcel->getSheet(0);
        $row = 0;
        $colume = -1;
        $whileKey = true;
        $columeArr = [
            '序号',
            '姓名',
            '工号',
            '工厂',
            '部门',
            '政治面貌',
            '联系方式',
            '性别',
            '出生年月日',
            '年龄',
            '身份证号码',
            '入职日期',
            '班组',//team
            '岗位',
            '毕业院校',//graduatedSchool
            '学历',
            '专业',//major
            '最高学历毕业时间',//graduationTime
            '民族',//nation
            '家庭住址',
            '紧急联系人',
            '联系电话',
            '培训时间',
            '面试时间',
            '合同起止时间',
            '购买险种',
            '是否为第一次购买五险',
            '原社保购买地',//oldSocialArea
            '是否公积金缴纳',//isAccumulation
            '招商银行卡',
            '其他银行备注开户行信息',//otherBank
            '用工性质',//userNature
            '入株所日期',//dateOfAdmission
            '委派时间',//assignedWindPowerTime
            '工作所在地',//clientAddress
            '技能等级',//skillLevel
            '军人登记',//isSoldier
            '户口类型',//accountType
            '调入/调出日期',
            '客服专员',//staffName
            '备注'
        ];
        while ($whileKey) {
            $v = $sheet
                ->getCellByColumnAndRow(++$colume, 1)
                ->getFormattedValue();
            if (empty($v)) {
                $whileKey = false;
            }
        }
        $whileKey = true;
        while ($whileKey) {
            $v = $sheet
                ->getCellByColumnAndRow(1, ++$row)
                ->getFormattedValue();

            if (empty($v)) {
                $row--;
                $whileKey = false;
            }
        }
        $table = [
            'number',           //序号
            'name',             //姓名
            'jobNumber',        //工号
            'clientName',       //工厂
            'department',         //部门
            'politicalStatus',  //政治面貌
            'phone',            //联系方式
            'sex',              //性别
            'birthday',         //生日
            'age',              //年龄
            'idCard',           //身份证
            'workTime',//入职日期
            'team',//班组
            'position',//岗位
            'graduatedSchool',//毕业院校
            'education',//学历
            'major',//专业
            'graduationTime',//最高学历毕业时间
            'nation',//民族
            'address',          //家庭地址
            'emergencyContact', //紧急联系人
            'emergencyTell',    //紧急联系人方式
            'trainTime',        //培训时间
            'interviewTime',    //面试时间
            'contractTime',     //合同时间
            'socialSecurity',//购买险种
            'first',            //是否第一次买社保
            'oldSocialArea',//原社保购买地
            'isAccumulation',//是否公积金缴纳
            'bankCard',         //银行卡
            'otherBank',//其他银行卡开户信息
            'userNature',//用户性质
            'dateOfAdmission',//入株所日期
            'assignedWindPowerTime',//委派风电时间
            'clientAddress',    //工作所在地
            'skillLevel',//技能等级
            'isSoldier',//军人登记
            'accountType',//户口类型
            'deployDate',//调入/调出日期
            'staffName',//客服专员
            'remark'
        ];
        $data = [] ;
        $dateKey = [
            'birthday'=>'生日',
            'workTime'=>'入职日期',
            'graduationTime'=>'最高学历毕业时间',
            'trainTime'=>'培训时间',
            'interviewTime'=>'面试时间',
            'dateOfAdmission'=>'入珠所日期',
            'assignedWindPowerTime'=>'委派时间',
            'deployDate'=>'调入/调出日期'
        ];
        $match = "/^[0-9]{4}(\/||\-)[0-9]{1,2}(\\1)[0-9]{1,2}$/";
        try{
            //整理数据
            for ($y = 2; $y <= $row ; $y++) {
                $rowData = [];
                for ($x = 0 ; $x < $colume ; $x++) {
                    $value = $sheet
                        ->getCellByColumnAndRow($x, $y)
                        ->getFormattedValue();
                    if($table[$x] === 'phone'){
                        if(!preg_match("/^1[345789]\d{9}$/",trim($value))){
                            throw new \Exception($dateKey[$table[$x]].'手机号格式不符',Code::PARAM_ERR);
                        }
                    }
                    if(!empty(trim($value))){
                        if(isset($dateKey[$table[$x]])){
                            //需要验证是否是设置的日期格式
                            if(!preg_match($match,trim($value))){
                                throw new \Exception($dateKey[$table[$x]].'日期不符合格式'.trim($value),Code::PARAM_ERR);
                            }
                        }
                    }

                    $rowData[$table[$x]] = trim($value) ;

                }
                if( count($rowData) > 0 ){
                    $data[$y] = $rowData;
                }
            }
        }catch (\Exception $exception){
            \Yii::info('-----import fail error msg---'.$exception->getMessage(),'importJob');
            return false;
        } finally {
//            unlink($fileUrl);
        }
        $exlData = ArrayHelper::index($data,null,'phone');
        //将职工名字去重，去空
        $staffNameData = array_unique(array_filter(array_column($data,'staffName')));
        $staff = StaffInfoModel::find()->select('staffId,name')
            ->where(['name'=>$staffNameData,'status'=>StaffInfoModel::STATUS_ENTRY,'isValid'=>StaffInfoModel::IS_VALID_OK])
            ->indexBy('name')->asArray()->all();
        //TODO 首先 判断手机号+是否唯一 然后再判断手机号+姓名是否正确
        $phone = array_unique(array_filter(array_column($data,'phone')));
        $samePhone = array_diff_assoc(array_column($data,'phone'),$phone);
        $samePhone = array_filter($samePhone);
        if(count($samePhone) > 0){
             return implode(',',$samePhone).'手机号在excel中重复';
        }
        $user = User::find()
            ->select(['userName','userAccount'])
            ->where(['userAccount' => $phone])
            ->andWhere(['isValid' => User::IS_VALID_OK])
            ->andWhere(['!=','jobId',0])
            ->asArray()
            ->all();
        //已有的人才
        $oldPhone = [];
        if (!empty($user)) {
            foreach ($user as $value) {
                $oldPhone[] = $value['userAccount'];
                if ($value['userName'] != $exlData[$value['userAccount']][0]['name']) {
                    return '手机号'.$value['userAccount'].'姓名与后台姓名不匹配';
                }
            }
        }
        //现存工厂
        $clientNameData = array_unique(array_filter(array_column($data,'clientName')));
        $clientData = ClientInfoModel::find()->select('clientId,name')->where([
            'name'=>$clientNameData,
            'isValid'=>ClientInfoModel::IS_VALID_OK
        ])->indexBy('name')->all();
        //新增的人才
        $newPhone = array_diff($phone,$oldPhone);
        $newAccount = User::find()->where([
            'userAccount'=>$newPhone,
            'isValid'=>User::IS_VALID_OK
        ])->indexBy('userAccount')->all();
        $oldJob = JobInfoModel::find()
            ->where(['phone' => $oldPhone])
            ->andWhere(['isValid' => JobInfoModel::IS_VALID_OK])
            ->indexBy('phone')
            ->all();

        $tran = \Yii::$app->db->beginTransaction();
        try {
            //获取后台政治面貌数据
            $politicalStatusStr = JobInfoModel::$POLITICAL_ENUM_STR;
            //获取学历
            $educationList = JobInfoModel::$EDUCATION_ENUM;
            //社保
            $socialSecurity = BasisModel::find()
                ->select(['basisId','name','type'])
                ->where(['type'=>'SOCIAL_SECURITY','isValid' => BasisModel::IS_VALID_OK])
                ->indexBy('name')
                ->asArray()
                ->all();
            \Yii::info('----import data----'.print_r($data,true));
            foreach ($data as $rKey=>$value) {
                $jobStaffId = isset($staff[$value['staffName']]) ? $staff[$value['staffName']]['staffId'] : 0;
                if (empty($value['phone'])) {
                    throw new \Exception('第'.$rKey.'行手机号不能为空',Code::PARAM_ERR);
                }
                if (empty($value['name'])) {
                    throw new \Exception('第'.$rKey.'行姓名不能为空',Code::PARAM_ERR);
                }
                if (empty($value['birthday'])) {
                    throw new \Exception('第'.$rKey.'行生日不能为空',Code::PARAM_ERR);
                }
                if (empty($value['sex'])) {
                    throw new \Exception('第'.$rKey.'行性别不能为空',Code::PARAM_ERR);
                }
                if (in_array($value['phone'],$newPhone)) {
                    continue;
                } else {
                    if(isset($oldJob[$value['phone']])){
                        $model = $oldJob[$value['phone']];
                    }else{
                        throw new \Exception('第'.$rKey.'行人才不存在',Code::PARAM_ERR);
                    }
                }
                if(!empty($value['contractTime'])){
                    $contractTime = explode('~',$value['contractTime']);
                    foreach ($contractTime as $preItem) {
                        if(!preg_match($match,$preItem)){
                            throw new \Exception('第'.$rKey.'合同时间格式不正确',Code::PARAM_ERR);
                        }
                    }
                }else{
                    $contractTime = ['',''];
                }
                $model->name = $value['name'] ;
                $model->sex = $value['sex'] == '男' ? 1 : 0;
                $model->phone = $value['phone'] ;
                $model->address = $value['address'] ;
                if(!empty($value['birthday'])){
                    $model->birthday = date('Y-m-d',strtotime($value['birthday'])) ;
                }
                $model->jobNumber = $value['jobNumber'] ;
                $model->age = $value['age'];
                $model->idCard = $value['idCard'];
//                $model->staffId = $jobStaffId;
                $model->supplierId = 0;
                $model->graduatedSchool = $value['graduatedSchool'];//毕业院校
                if(!empty($value['education'])){
                    if(in_array($value['education'],$educationList)){
                        $model->education = array_search($value['education'],$educationList);
                    }else{
                        throw new \Exception('手机号'.$value['phone'].'设置的学历与后台不匹配',Code::PARAM_ERR);
                    }
                    $model->education = in_array($value['education'],$educationList) ? array_search($value['education'],$educationList) : 0;//学历
                }

                $model->major = $value['major'];//专业
                if(!empty($value['graduationTime'])){
                    $model->graduationTime = date('Y-m-d',strtotime($value['graduationTime']));//最高学历毕业时间
                }
                $model->nation = $value['nation'];//民族
                $model->accountType = $value['accountType'] == '农业户口' ? 0 :1;//户口类型
                $model->remark = $value['remark'];
                if(!$model->validate()){
                    $firstItem = current($model->getErrors());
                    \Yii::info('----import job info---error---'.$rKey.'----'.print_r($firstItem,true).'---'.print_r($value,true));
                    throw new \Exception('第'.$rKey.'行'.$firstItem[0],Code::PARAM_ERR);
                }
                $model->save();
                if( $model->jobId > 0){
                    if (in_array($value['phone'],$newPhone)) {
                        if(isset($newAccount[$value['phone']])){
                            $userAccount = $newAccount[$value['phone']];
                            $userAccount->jobId = $model->jobId;
                            $userAccount->save();
                            $model->userId = $userAccount->id;
                            $model->save();
                        }else{
                            $user = new User();
                            $user->userAccount = $model->phone;
                            $user->userName = $model->name;
                            $user->tel = $model->phone;
                            $user->jobId = $model->jobId;
                            $user->creator = 'system';
                            $user->setPassword(substr($model->phone,-6));
                            $user->generateAuthKey();
                            $user->save();
                            $model->userId = $user->id;
                            $model->save();
                        }
                    }
                }else{
                    \Yii::info('import job no jobId----'.Json::encode($model),'importJob');
                }
            }
            $tran->commit();
        }catch (\Exception $exception) {
            \Yii::info('添加失败:' . $exception->getMessage().'---file'.$exception->getFile().'---line--'.$exception->getLine(),'importJob');
            $tran->rollBack();
            return $exception->getMessage();
        }
        return true;
    }

}