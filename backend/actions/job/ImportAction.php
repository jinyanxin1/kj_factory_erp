<?php
/**
 * User: cqj
 * Date: 2020/7/28
 * Time: 3:13 下午
 */

namespace backend\actions\job;


use backend\actions\BaseAction;
use backend\models\system\BasicsForm;
use common\library\helper\Code;
use common\models\clientInfo\ClientInfoModel;
use common\models\dataImportLog\DataImportLogModel;
use common\models\jobCareerRecord\JobCareerRecordModel;
use common\models\jobContract\JobContractModel;
use common\models\jobInfo\JobInfoForm;
use common\models\jobInfo\JobInfoModel;
use common\models\jobSkill\JobSkillForm;
use common\models\report\ReportModel;
use common\models\SignupForm;
use common\models\staffInfo\StaffInfoModel;
use common\models\system\basis\BasisModel;
use common\models\User;
use common\models\user\UserModel;
use yii\helpers\ArrayHelper;
use yii\helpers\Json;
use yii\web\UploadedFile;

class ImportAction extends BaseAction
{
    public function run() {
        \Yii::info('data-import/import' . Json::encode($this->request()->post(),true));
        $file = UploadedFile::getInstanceByName('file');
        $staffId = $this->request()->post('staffId');
        $supplierId = $this->request()->post('supplierId');
        $fileUrl = self::UploadExcel($file);

        require_once \Yii::getAlias('@common') . '/kjlib/PHPExcel/PHPExcel/IOFactory.php';
        $objPHPExcel = \PHPExcel_IOFactory::load($fileUrl);
        $sheet = $objPHPExcel->getSheet(0);
        $row = 1;
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
                ->getCellByColumnAndRow(++$colume, 2)
                ->getFormattedValue();

            if (isset($columeArr[$colume]) && $columeArr[$colume] != $v) {
                return $this->returnApi(Code::PARAM_ERR,'请使用模版');
            }
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
        if($row == 0 || $colume == -1){
            return $this->returnApi(Code::PARAM_ERR,'不能为空表');
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
        //判断日期
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
        $match = "/^[0-9]{4}(\/)[0-9]{1,2}(\\1)[0-9]{1,2}$/";
        $data = [] ;
        $dataImport = new DataImportLogModel();
        $dataImport->staffId = $staffId;
        //保存一条导入记录
        $dataImport->fileUrl = $fileUrl;
        $dataImport->type = DataImportLogModel::TYPE_JOB;
//        $dataImport->isConsole = DataImportLogModel::IS_CONSOLE_COMPLETED;
        //需要执行定时任务
        $dataImport->isConsole = DataImportLogModel::IS_CONSOLE_YES;
        $dataImport->status = DataImportLogModel::IMPORT_ING;

        try{
            $rowData = [];
            //整理数据
            for ($y = 3; $y <= $row ; $y++) {
                for ($x = 0 ; $x < $colume ; $x++) {
                    $value = $sheet
                        ->getCellByColumnAndRow($x, $y)
                        ->getFormattedValue();
                    if($table[$x] === 'phone'){
                        if(!preg_match("/^1[123456789]\d{9}$/",trim($value))){
                            throw new \Exception('第'.$y.'行'.'手机号格式不符'.trim($value),Code::PARAM_ERR);
                        }
                    }

                    if(!empty(trim($value))){
                        if(isset($dateKey[$table[$x]])){
                            //需要验证是否是设置的日期格式
                            if(!preg_match($match,trim($value))){
                                throw new \Exception('第'.$y.'行'.$dateKey[$table[$x]].'日期不符合格式'.trim($value),Code::PARAM_ERR);
                            }
                        }
                    }
                    $rowData[$table[$x]] = trim($value) ;

                }

                if( count($rowData) > 0 ){
                    $data[$y] = $rowData;
                }

            }


            if(!$dataImport->save()){
                return $this->returnApi(Code::PARAM_ERR,'导入记录保存失败');
            }

            \Yii::info('-----import fail data---'.Json::encode($data),'importJob');

            $exlData = ArrayHelper::index($data,null,'phone');
            //将职工名字去重，去空
//            $staffNameData = array_unique(array_filter(array_column($data,'staffName')));
//            $staff = StaffInfoModel::find()->select('staffId,name')
//                ->where(['name'=>$staffNameData,'status'=>StaffInfoModel::STATUS_ENTRY,'isValid'=>StaffInfoModel::IS_VALID_OK])
//                ->indexBy('name')->asArray()->all();
            //TODO 首先 判断手机号+是否唯一 然后再判断手机号+姓名是否正确
            $phone = array_unique(array_filter(array_column($data,'phone')));
            $samePhone = array_diff_assoc(array_column($data,'phone'),$phone);
            $samePhone = array_filter($samePhone);
            if(count($samePhone) > 0){
                $dataImport->error = implode(',',$samePhone).'手机号在excel中重复';
                $dataImport->status = DataImportLogModel::COMPLETED_NO;
                $dataImport->save();
                return $this->returnApi(Code::PARAM_ERR,$dataImport->error);
            }
            $user = User::find()
                ->select(['userName','userAccount'])
                ->where(['userAccount' => $phone])
                ->andWhere(['isValid' => User::IS_VALID_OK])
                ->andWhere(['!=','jobId',0])
                ->asArray()
                ->all();
            //已有的人才
//            $oldPhone = [];
            if (!empty($user)) {
                foreach ($user as $value) {
//                    $oldPhone[] = $value['userAccount'];
                    if ($value['userName'] != $exlData[$value['userAccount']][0]['name']) {
                        $dataImport->error = '手机号'.$value['userAccount'].'姓名与后台姓名不匹配';
                        $dataImport->status = DataImportLogModel::COMPLETED_NO;
                        $dataImport->save();
                        return $this->returnApi(Code::PARAM_ERR,$dataImport->error);
                    }
                }
            }
            //现存工厂
//            $clientNameData = array_unique(array_filter(array_column($data,'clientName')));
//            $clientData = ClientInfoModel::find()->select('clientId,name')->where([
//                'name'=>$clientNameData,
//                'isValid'=>ClientInfoModel::IS_VALID_OK
//            ])->indexBy('name')->all();
//            //新增的人才
//            $newPhone = array_diff($phone,$oldPhone);
//            $newAccount = User::find()->where([
//                'userAccount'=>$newPhone,
//                'isValid'=>User::IS_VALID_OK
//            ])->indexBy('userAccount')->all();
//            $oldJob = JobInfoModel::find()
//                ->where(['phone' => $oldPhone])
//                ->andWhere(['isValid' => JobInfoModel::IS_VALID_OK])
//                ->indexBy('phone')
//                ->all();


        }catch (\Exception $exception){
            \Yii::info('-----import fail error msg---'.$exception->getMessage(),'importJob');
            $dataImport->error = $exception->getMessage();
            $dataImport->status = DataImportLogModel::COMPLETED_NO;
            $dataImport->save();
            return $this->returnApi(Code::PARAM_ERR,$exception->getMessage());
        } finally {
//            unlink($fileUrl);
        }
        $dataImport->error = '';
        $dataImport->save();
        return $this->returnApi(Code::SUCCESS,"导入中");

//        $tran = \Yii::$app->db->beginTransaction();
//        try {
//            //获取后台政治面貌数据
//            $politicalStatusStr = JobInfoModel::$POLITICAL_ENUM_STR;
//            //获取学历
//            $educationList = JobInfoModel::$EDUCATION_ENUM;
//            //社保
//            $socialSecurity = BasisModel::find()
//                ->select(['basisId','name','type'])
//                ->where(['type'=>'SOCIAL_SECURITY','isValid' => BasisModel::IS_VALID_OK])
//                ->indexBy('name')
//                ->asArray()
//                ->all();
//            \Yii::info('----import data----'.print_r($data,true));
//            foreach ($data as $rKey=>$value) {
//                $jobStaffId = isset($staff[$value['staffName']]) ? $staff[$value['staffName']]['staffId'] : $staffId;
//                if (empty($value['phone'])) {
//                    throw new \Exception('第'.$rKey.'行手机号不能为空',Code::PARAM_ERR);
//                }
//                if (empty($value['name'])) {
//                    throw new \Exception('第'.$rKey.'行姓名不能为空',Code::PARAM_ERR);
//                }
////                if (empty($value['birthday'])) {
////                    throw new \Exception('第'.$rKey.'行生日不能为空',Code::PARAM_ERR);
////                }
//                if (empty($value['sex'])) {
//                    throw new \Exception('第'.$rKey.'行性别不能为空',Code::PARAM_ERR);
//                }
//                if (in_array($value['phone'],$newPhone)) {
//                    $model = new JobInfoModel() ;
//                    $model->status = JobInfoModel::STATUS_WAIT ;
//                    if (empty($staffId)) {
//                        $model->status = JobInfoModel::STATUS_PUBLIC ;
//                    }
//                    $model->staffId = $jobStaffId ;
//                } else {
//                    if(isset($oldJob[$value['phone']])){
//                        $model = $oldJob[$value['phone']];
//                    }else{
//                        throw new \Exception('第'.$rKey.'行人才不存在',Code::PARAM_ERR);
//                    }
//                }
//                if(!empty($value['contractTime'])){
//                    $contractTime = explode('~',$value['contractTime']);
//                    foreach ($contractTime as $preItem) {
//                        if(!preg_match($match,$preItem)){
//                            throw new \Exception('第'.$rKey.'合同时间格式不正确',Code::PARAM_ERR);
//                        }
//                    }
//                }else{
//                    $contractTime = ['',''];
//                }
//                $model->name = $value['name'] ;
//                $model->sex = $value['sex'] == '男' ? 1 : 0;
//                $model->phone = $value['phone'] ;
//                $model->address = $value['address'] ;
//                if(!empty($value['birthday'])){
//                    $model->birthday = date('Y-m-d',strtotime($value['birthday'])) ;
//                }
//                $model->jobNumber = $value['jobNumber'] ;
//                $model->age = $value['age'];
//                $model->idCard = $value['idCard'];
//                $model->staffId = $jobStaffId;
//                $model->addStaffId = $jobStaffId;
//                $model->supplierId = 0;
//                $model->graduatedSchool = $value['graduatedSchool'];//毕业院校
//                if(!empty($value['education'])){
//                    if(in_array($value['education'],$educationList)){
//                        $model->education = array_search($value['education'],$educationList);
//                    }else{
//                        throw new \Exception('手机号'.$value['phone'].'设置的学历与后台不匹配',Code::PARAM_ERR);
//                    }
//                    $model->education = in_array($value['education'],$educationList) ? array_search($value['education'],$educationList) : 0;//学历
//                }
//
//                $model->major = $value['major'];//专业
//                if(!empty($value['graduationTime'])){
//                    $model->graduationTime = date('Y-m-d',strtotime($value['graduationTime']));//最高学历毕业时间
//                }
//                $model->nation = $value['nation'];//民族
//                $model->accountType = $value['accountType'] == '农业户口' ? 0 :1;//户口类型
//                $model->remark = $value['remark'];
//                if(!$model->validate()){
//                    $firstItem = current($model->getErrors());
//                    \Yii::info('----import job info---error---'.$rKey.'----'.print_r($firstItem,true).'---'.print_r($value,true));
//                    throw new \Exception('第'.$rKey.'行'.$firstItem[0],Code::PARAM_ERR);
//                }
//                $model->save();
//                if( $model->jobId > 0){
//                    if (in_array($value['phone'],$newPhone)) {
//                        if(isset($newAccount[$value['phone']])){
//                            $userAccount = $newAccount[$value['phone']];
//                            $userAccount->jobId = $model->jobId;
//                            $userAccount->save();
//                            $model->userId = $userAccount->id;
//                            $model->save();
//                        }else{
//                            $user = new User();
//                            $user->userAccount = $model->phone;
//                            $user->userName = $model->name;
//                            $user->tel = $model->phone;
//                            $user->jobId = $model->jobId;
//                            $user->creator = 'system';
//                            $user->setPassword(substr($model->phone,-6));
//                            $user->generateAuthKey();
//                            $user->save();
//                            $model->userId = $user->id;
//                            $model->save();
//                        }
//                    }
//                    //入职
//                    if (!empty($value['clientName'])) {
//                        if(isset($clientData[$value['clientName']])){
//                            $client = $clientData[$value['clientName']];
//                        }else{
//                            throw new \Exception('手机号'.$value['phone'].'工厂与后台数据不匹配',Code::PARAM_ERR);
//                        }
//
//                        $record = JobCareerRecordModel::find()->where([
//                            'jobId'=>$model->jobId,
//                            'clientId'=>$client->clientId,
//                            'staffId'=>$jobStaffId,
//                            'isValid'=>JobCareerRecordModel::IS_VALID_OK
//                        ])->orderBy('recordId desc')->one();
//                        if(empty($record)){
//                            $record = new JobCareerRecordModel() ;
//                        }
//                        $record->status = JobCareerRecordModel::STATUS_ENTRY ;
//                        $record->jobId = $model->jobId ;
//                        $record->clientId = $client->clientId ;
//                        $record->staffId = $jobStaffId;
//                        $record->startTime = !empty($contractTime[0]) ? date('Y-m-d',strtotime($contractTime[0])) : null ;
//                        $record->endTime = !empty($contractTime[1]) ? date('Y-m-d',strtotime($contractTime[1])) : null ;
//                        $record->idCard = $value['idCard'] ;
//                        $record->department = $value['department'] ;
//                        if(!empty($value['interviewTime'])){
//                            $record->interviewTime = date('Y-m-d',strtotime($value['interviewTime'])) ;
//                        }
//                        if(!empty($value['trainTime'])){
//                            $record->trainTime = date('Y-m-d',strtotime($value['trainTime'])) ;
//                        }
//                        $record->bankCard = $value['bankCard'] ;
//                        $record->address = $value['address'] ;
//                        $record->time = !empty($value['workTime']) ? date('Y-m-d',strtotime($value['workTime'])) : null ;
//                        $record->jobNumber = $value['jobNumber'];
//                        if(!empty(trim($value['politicalStatus']))){
//                            if (!isset($politicalStatusStr[$value['politicalStatus']])) {
//                                throw new \Exception('手机号'.$value['phone'].'政治面貌与后台数据不匹配'.trim($value['politicalStatus']),Code::PARAM_ERR);
//                            }
//                            $record->politicalStatus = $politicalStatusStr[$value['politicalStatus']];
//                        }
//                        $record->first = $value['first'] == '是' ? 0 : 1;
//                        $emergency = [
//                            [
//                                'name' => $value['emergencyContact'],
//                                'phone' => $value['emergencyTell'],
//                            ]
//                        ];
//                        $record->emergency = Json::encode($emergency,true) ;
//                        //班组
//                        $record->team = $value['team'];
//                        //购买险种
//                        if(!empty($value['socialSecurity'])){
//                            $socialSecurityArr = explode('、',$value['socialSecurity']);
//                            $socialSecurityData = [];
//                            if(!empty($socialSecurityArr)){
//                                foreach ($socialSecurityArr as $itemS) {
//                                    if (!isset($socialSecurity[$itemS])) {
//                                        throw new \Exception('手机号'.$value['phone'].'购买险种与后台数据不匹配',Code::PARAM_ERR);
//                                    }
//                                    $socialSecurityData[] = $socialSecurity[$itemS]['basisId'];
//                                }
//                            }
//                            if(!empty($socialSecurityData)){
//                                $record->socialSecurity = Json::encode($socialSecurityData);
//                            }
//                        }
//
//                        //岗位
//                        $record->position = $value['position'];
//                        //原社保购买地
//                        $record->oldSocialArea = $value['oldSocialArea'];
//                        //是否公积金缴纳
//                        $record->isAccumulation = $value['isAccumulation'] == '是' ? 0 : 1;
//                        //其他银行卡开户信息
//                        $record->otherBank = $value['otherBank'];
//                        //用工性质
//                        $record->userNature = $value['userNature'];
//                        //入株所日期
//                        if(!empty($value['dateOfAdmission'])){
//                            $record->dateOfAdmission = date('Y-m-d',strtotime($value['dateOfAdmission']));
//                        }
//                        //委派风电时间
//                        if(!empty($value['assignedWindPowerTime'])){
//                            $record->assignedWindPowerTime = date('Y-m-d',strtotime($value['assignedWindPowerTime']));
//                        }
//                        //工作所在地
//                        $record->clientAddress = $value['clientAddress'];
//                        //技能等级
//                        $record->skillLevel = $value['skillLevel'];
//                        //军人登记
//                        $record->isSoldier = $value['isSoldier'] == '是' ? 0 : 1;
//                        //调配日期
//                        if(!empty($value['deployDate'])){
//                            $record->deployDate = date('Y-m-d',strtotime($value['deployDate']));
//                        }
//                        $record->save();
//
//                        //添加人才入职合同
//                        JobContractModel::updateAll(['use' => 0],['jobId' => $model->jobId]);
//
//                        $jobContract = new JobContractModel();
//                        $jobContract->startTime = $record->startTime ;
//                        $jobContract->endTime = $record->endTime ;
//                        $jobContract->clientId = $record->clientId ;
//                        $jobContract->recordId = $record->recordId ;
//                        $jobContract->jobId = $record->jobId ;
//                        $jobContract->title = '初次入职合同' ;
//                        $jobContract->use = 1 ;
//                        $jobContract->save();
//
//                        //修改人才信息
//                        $model->status = JobInfoModel::STATUS_ENTRY;
//                        $model->clientId = $client->clientId ;
//                        $model->startTime = !empty($contractTime[0]) ? date('Y-m-d',strtotime($contractTime[0])) : null ;
//                        $model->endTime = !empty($contractTime[1]) ? date('Y-m-d',strtotime($contractTime[1])) : null ;
//                        $model->entryId = $record->recordId;
//                        $model->workTime = !empty($value['workTime']) ? date('Y-m-d',strtotime($value['workTime'])) : null ;
//                        $model->jobNumber = $value['jobNumber'] ;
//                        $model->position = $value['position'];
//                        $model->save();
//                        ReportModel::addEntry($jobStaffId);
//                    }
//                }else{
//                    \Yii::info('import job no jobId----'.Json::encode($model),'importJob');
//                }
//                //新增记录
//                ReportModel::addJob($jobStaffId);
//            }
//            $dataImport->error = '';
//            $dataImport->status = DataImportLogModel::COMPLETED;
//            $dataImport->save();
//            $tran->commit();
//            return $this->returnApi(Code::PARAM_ERR,"导入成功");
//        }catch (\Exception $exception) {
//            \Yii::info('添加失败:' . $exception->getMessage().'---file'.$exception->getFile().'---line--'.$exception->getLine(),'importJob');
//            $tran->rollBack();
//            $dataImport->error = $exception->getMessage();
//            $dataImport->status = DataImportLogModel::COMPLETED_NO;
//            $dataImport->save();
//            return $this->returnApi(Code::PARAM_ERR,$exception->getMessage());
//        }


    }

    /**
     * 上传
     * @param $file
     * @return string|null
     */
    public static function UploadExcel($file){

        $file_types = explode(".", $file->name);

        $file_type = $file_types [count($file_types) - 1];
        if(!in_array($file_type,array('xlsx','xls'))){
            return null;
        }
        /*设置上传路径*/
        $savePath = \Yii::getAlias('@backend').'/web/upload/template/upload/';
        /*以时间来命名上传的文件*/
        $str = date('Ymdhis');
        $file_name = $str . "." . $file_type;
        $fileUrl = $savePath . $file_name;
        $file->saveAs($fileUrl);
        return $fileUrl;
    }

}