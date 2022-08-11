<?php
/**
 * Created by cqj
 * User: cqj
 * Date: 2019/10/30
 * Time: 11:53
 */

namespace backend\models\system;


use backend\actions\section\CampusListAction;
use backend\models\classes\ClassesForm;
use backend\models\course\CourseForm;
use callmez\wechat\sdk\components\BaseWechat;
use common\library\helper\Code;
use common\library\helper\Common;
use common\models\BaseForm;
use common\models\BaseModel;
use common\models\course\CourseModel;
use common\models\staff\StaffModel;
use common\models\student\StudentModel;
use common\models\system\BasicsModel;
use common\models\system\ClassRoomModel;
use common\models\system\DataImportModel;
use common\models\system\SectionModel;
use common\models\user\UserModel;
use Yii;

class DataImportForm extends BaseForm
{
    public static $publicschoolColumn = [
        'name',
        'describe',
    ];

    public static $studentColumn = [
        'studentName',      //姓名
        'sex',              //性别
        'mobile',           //手机
        'englishName',      //英文名
        'birthday',         //生日
        'studentType',      //学员类别
        'enrollDate',       //报名日期
        'fatherName',       //父亲名称
        'fatherMobile',     //父亲电话
        'motherName',       //母亲名称
        'motherMobile',     //母亲电话
        'address',          //家庭地址
        'qq',               //qq
        'otherContact',     //其他联系方式
        'currentSchool',    //就读学校
        'gradeName',        //年级
        'comeFrom',         //来源
        'remarks' ,         //备注
    ];
    //学员剩余费用导入
    public static $feeColumn = [
        'studentName',//学员姓名
        'mobile',//手机号
        'courseName',//课程名称
        'belongToCampus',//所属校区
        'attendToCampus',//经办校区
        'surplusNum',//剩余数量
        'surplusFee',//剩余金额
        'chargeType',//收费类型
        'chargeDate',//收费日期
        'effectiveDate',//有效期
        'remark',//备注
    ];
    public static $TYPE_LIST = [
        'employee' => '员工信息' ,
        'shift' => '课程信息' ,
        'class' => '班级信息' ,
        'course' => '排课信息' ,
        'classgroup' => '分班信息' ,
        'fee' => '学员剩余费用' ,
        'publicschool' => '公立学校' ,
        'communicationrecord' => '沟通记录' ,
        'point' => '学员积分' ,
        'student' => '学员信息' ,
    ];
    public static function getColumn($type) {
        $Column = [] ;
        switch ($type) {
            //员工信息
            case 'employee' :
                $Column = DataImportForm::$employeeColumn ;
                break;
            //课程信息
            case 'shift' :
                $Column = DataImportForm::$shiftColumn ;
                break;
            //班级信息
            case 'class' :
                $Column = DataImportForm::$classColumn ;

                break;
            //排课信息
            case 'course' :
                $Column = DataImportForm::$courseColumn ;

                break;
            //分班信息
            case 'classgroup' :
                $Column = DataImportForm::$classgroupColumn ;

                break;
            //学员剩余费用
            case 'fee' :
                $Column = DataImportForm::$feeColumn ;

                break;
            //公立学校
            case 'publicschool' :
                $Column = DataImportForm::$publicschoolColumn;

                break;
            //沟通记录
            case 'communicationrecord' :
                $Column = DataImportForm::$communicationrecordColumn ;

                break;
            //学员积分
            case 'point' :
                $Column = DataImportForm::$pointColumn ;

                break;
            //学员积分
            case 'student' :
                $Column = DataImportForm::$studentColumn ;
                break;
        }
        return $Column;
    }

    /**
     * 导入数据
     * @param $fileUrl
     * @param $type
     * $dataImportId  导入记录的id
     * @return array
     */
    public function importData ($fileUrl,$type,$dataImportId) {
        Yii::info('-----------------import data -start-----------');
        //通过type获得设定好的列表
        $column = DataImportForm::getColumn($type);
        //通过列表和保存的路径读取Excel封装数据
        $data = DataImportForm::OrganizeData($fileUrl,$column,$type);
        $dataImport = DataImportModel::find()->where(['dataImportId'=>$dataImportId,'isDelete'=>DataImportModel::IS_VALID_OK])->one();
        if($dataImport === null){
            return ['code'=>Code::PARAM_ERR,'msg'=>'导入记录不存在'];
        }
        if( count($data) <= 0 ){
            $dataImport->errorNum = -1;//表示导入失败
            $dataImport->ids = '导入数据为空';//失败原因
            $dataImport->status = DataImportModel::COMPLETED_NO;//导入未完成
            $dataImport->save();
          return ['code'=>Code::PARAM_ERR,'msg'=>'数据为空'];
        }else{
            if( $type === 'fee' ){
                //导入行数大于70时，用定时任务执行
                $dataImport->isConsole = DataImportModel::IS_CONSOLE_YES;//需要执行定时任务
                if( !$dataImport->save()){
                    return ['code'=>Code::PARAM_ERR,'msg'=>'导入记录修改失败'];
                }
                return ['code'=>Code::SUCCESS,'msg'=>'导入任务执行中'];
            }
        }
        $save = ['error'=>[]];//导入的错误记录
        $errormsg = '';
        $tran = Yii::$app->db->beginTransaction();
        try{
            //按照不同的type 处理新增的数据
            switch ($type) {
                //员工信息
                case 'employee' :
                    break;
                //课程信息
                case 'shift' :
                    break;
                //班级信息
                case 'class' :
                    break;
                //排课信息
                case 'course' :

                    break;
                //分班信息
                case 'classgroup' :

                    break;
                //学员剩余费用
                case 'fee' :
                    $save = StudentSurplusFeeImportForm::import($data,$type);
                    if(count($save['error']) > 0){
                        throw new \Exception(implode(',',$save['error']));
                    }
                    break;
                //公立学校
                case 'publicschool' :
                    $save = self::importPublicSchool($data,$type);
                    if(count($save['error']) > 0){
                        throw new \Exception(implode(',',$save['error']));
                    }
                    break;
                //沟通记录
                case 'communicationrecord' :
                    break;
                //学员积分
                case 'point' :
                    break;
                //学员信息
                case 'student' :
                    $save = self::importStudent($data,$type,$this->schoolId,$this->campusId,$dataImportId);
                    if(count($save['error']) > 0){
                        throw new \Exception(implode(',',$save['error']));
                    }
                    break;
            }
            Yii::info('-----------data import form success-----------');

            $tran->commit();
        }catch (\Exception $exception){
            $tran->rollBack();
            $errormsg = '数据导入失败';
            Yii::info('-----------data import form fail err msg'.$exception->getMessage().'----'.$exception->getFile().'--------'.$exception->getLine(),'importFee');
        }
        Yii::info('-------------data import form error'.print_r($save['error'],true),'importFee');
        if((count($save['error']) > 0) || !empty($errormsg)){
            $dataImport->errorNum = -1;//表示导入失败
            if(count($save['error']) > 0){
                $dataImport->ids = implode(',',$save['error']);//失败原因
            }else{
                $dataImport->ids = $errormsg;
            }
            $dataImport->status = DataImportModel::COMPLETED_NO;//导入未完成
        }else{
            $dataImport -> importNum = sizeof($data);
            $dataImport->status = DataImportModel::COMPLETED;
            $dataImport -> succeedNum = sizeof($data);
        }
        try{
            $dataImport->schoolId = $this->schoolId;
            $dataImport->save();
        }catch(\Exception $e){
            \Yii::info('------- import record update fail import form fail save import record-----dataImportId'.$dataImportId.'----'.$e->getFile().'--------'.$e->getLine(),'importFee');
        }
        if(count($save['error']) > 0){
            return ['code' => Code::PARAM_ERR ,'msg'=>'导入失败'];
        }
        return ['code' => Code::SUCCESS ,'msg'=>'导入成功'];
    }

    /**
     * @param $data
     * @param $type
     * @param $schoolId
     * @param $campusId
     * @throws \Exception
     */
    public static function importStudent ($data,$type,$schoolId,$campusId,$dataImportId) {
        $save = ['error'=>[]];
        $basics = BasicsModel::getListByArr([
            BasicsModel::STUDENT_TYPE,
            BasicsModel::SHIFT_GRADE,
            BasicsModel::SALE_MODE,
            BasicsModel::FULLTIME_SCHOOL
        ]);
        $STUDENT_TYPE = array_combine(array_column($basics[BasicsModel::STUDENT_TYPE], 'name'), $basics[BasicsModel::STUDENT_TYPE]);
        $SHIFT_GRADE = array_combine(array_column($basics[BasicsModel::SHIFT_GRADE], 'name'), $basics[BasicsModel::SHIFT_GRADE]);
        $SALE_MODE = array_combine(array_column($basics[BasicsModel::SALE_MODE], 'name'), $basics[BasicsModel::SALE_MODE]);
        $FULLTIME_SCHOOL = array_combine(array_column($basics[BasicsModel::FULLTIME_SCHOOL], 'name'), $basics[BasicsModel::FULLTIME_SCHOOL]);
        $nameAndPhone = [] ;

        //数据库排查重复学员信息
        $dataUser = UserModel::find()->select(['userRealName','userMobile'])->where(
            array('userVip'=>UserModel::USER_VIP_STUDENT,
                'schoolId' => $schoolId,
                'isDelete'=>UserModel::IS_VALID_OK))
            ->asArray()
            ->all();
        $xx = [] ;
        $existName = [];
        foreach ($dataUser as $value) {
            $xx[] = ['userRealName' => $value['userRealName'] , 'userMobile' => $value['userMobile']] ;
            $existName[] = $value['userRealName'];
        }
        foreach ($data as $key => $value) {
            if ( empty($value['studentName']) && empty($value['mobile']) ) {
                unset($data[$key]);
                continue;
            }
            $dataKey = $key+3;
            if( empty($value['studentName']) ){
                $save['error'][] = '第'.$dataKey.'行姓名为空';
            }
            if(empty($data[$key]['mobile']) || !Common::isMobile($data[$key]['mobile'])) {
                $save['error'][] = '第'.$dataKey.'行手机号不合法';
            }

            if(!empty($data[$key]['fatherMobile']) && !Common::isMobile($data[$key]['fatherMobile'])) {
                $save['error'][] = '第'.$dataKey.'行父亲手机号不合法';
            }

            if(!empty($data[$key]['motherMobile']) && !Common::isMobile($data[$key]['motherMobile'])) {
                $save['error'][] = '第'.$dataKey.'行母亲手机号不合法';
            }

            if ( sizeof($value['studentName']) > 20 ) {
                $save['error'][] = '第'.$dataKey.'行姓名超过最大限制';
            }

            if ( sizeof($value['fatherName']) > 20 ) {
                $save['error'][] = '第'.$dataKey.'行父亲姓名超过最大限制';
            }

            if ( sizeof($value['motherName']) > 20 ) {
                $save['error'][] = '第'.$dataKey.'行母亲姓名超过最大限制';
            }

            if ( sizeof($value['englishName']) > 20 ) {
                $save['error'][] = '第'.$dataKey.'行英文名超过最大限制';
            }

            if ( sizeof($value['address']) > 50 ) {
                $save['error'][] = '第'.$dataKey.'行家庭住址超过最大限制';
            }

            if ( sizeof($value['remarks']) > 200 ) {
                $save['error'][] = '第'.$dataKey.'行备注超过最大限制';
            }

            $data[$key]['studentType'] = empty($data[$key]['studentType']) ? 0 : $STUDENT_TYPE[$data[$key]['studentType']]['basicsId'];
            $data[$key]['gradeId'] =  empty($data[$key]['gradeName'])? 0 : $SHIFT_GRADE[$data[$key]['gradeName']]['basicsId'];
            $data[$key]['comeFrom'] = empty($data[$key]['comeFrom']) ? null : $SALE_MODE[$data[$key]['comeFrom']]['basicsId'];
            $data[$key]['currentSchool'] = empty($data[$key]['currentSchool']) ? 0 : [$FULLTIME_SCHOOL[$data[$key]['currentSchool']]['basicsId']];
            $data[$key]['sex'] = $data[$key]['sex'] == '男' ? 1 : 2 ;
            $data[$key]['campusId'] = $campusId;
            $data[$key]['schoolId'] = $schoolId;
            //判断是否是试听
            if(strpos($value['studentName'],'_试听') !== false){
                $data[$key]['isTry'] = StudentModel::IS_TRY_YES;
                $data[$key]['status'] = StudentModel::AUDITION;
            }else{
               $data[$key]['isTry'] = StudentModel::IS_TRY_NO;
                $data[$key]['status'] = StudentModel::STUDYING;
            }
            if( count($nameAndPhone) > 0 ){
                if (in_array(['userRealName' => $value['studentName'] , 'userMobile' => $value['mobile']], $nameAndPhone)) {
                    $save['error'][] = '第'.$dataKey.'行姓名和手机号重复';
                }
            }
            if( in_array($value['studentName'],$existName) ){
                $save['error'][] = '第'.$dataKey.'行账号重复';
            }
            $x = ['userRealName' => $value['studentName'] , 'userMobile' => $value['mobile']];
            if (in_array($x,$xx)) {
                $save['error'][] = '姓名:' . $value['studentName'] . '-手机号:' . $value['mobile'] . ',已存在';
            }
            $nameAndPhone[] = ['userRealName' => $value['studentName'] ,'userMobile' => $value['mobile'] ] ;
        }

        if(count($save['error']) <= 0){
            $bool = StudentModel::batchAddData($data);
            if(!$bool) {
                $save['error'][] = '信息保存失败';
            }
        }
        return $save;
    }

    /**
     * 导入公立学校
     * @param $data
     * @param $type
     * @throws \Exception
     */
    public static function importPublicSchool ($data,$type) {
        $save = ['error'=>[]];
        $feeList = BasicsModel::getList(BasicsModel::FULLTIME_SCHOOL);
        $nameList = array_column($feeList,'name') ;
        $count = 0;
        $errorCount = 0;
        $ids = [] ;
        foreach ($data as $value) {
            if(!empty($value['name'])){
                if(in_array($value['name'],$nameList)){
                    $save['error'][] = '名称重复';
                    break;
                }
                $model = new BasicsModel();
                $model->name = $value['name'];
                $model->describe = $value['describe'];
                $model->type = BasicsModel::FULLTIME_SCHOOL;
                if (!$model->save()) {
                    $save['error'][] = '新增失败';
                    break;
                }
                $ids[] = $model->basicsId;
                $count++ ;
            }
        }
        return $save;
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
        $savePath = Yii::getAlias('@backend').'/web/upload/template/upload/';
        /*以时间来命名上传的文件*/
        $str = date('Ymdhis');
        $file_name = $str . "." . $file_type;
        $fileUrl = $savePath . $file_name;
        $file->saveAs($fileUrl);
        return $fileUrl;
    }

    /**
     * @param $fileUrl 路径
     * @return array
     * @throws \PHPExcel_Exception
     * @throws \PHPExcel_Reader_Exception
     */
    public static function OrganizeData($fileUrl,$table,$type=''){
        require_once \Yii::getAlias('@common') . '/kjlib/PHPExcel/PHPExcel/IOFactory.php';
        $objPHPExcel = \PHPExcel_IOFactory::load($fileUrl);
        $sheet = $objPHPExcel->getSheet(0);
        $allColumn = $sheet->getHighestColumn();
        $allRow = $sheet->getHighestRow();
        $ColumnNum = \PHPExcel_Cell::columnIndexFromString($allColumn);
        //课程剩余费用导入，模板11列
        if($type === 'fee'){
            $ColumnNum = 11;
        }
        if($allRow == 0 || $ColumnNum == 0){
//            return $this->renderApiJson(Code::PARAM_ERR,'不能为空表');
        }
        $data = [] ;
        try{
            //整理数据
            for ($y = 3; $y <= $allRow ; $y++) {
                $rowData = [];
                for ($x = 0 ; $x < $ColumnNum ; $x++) {
                    $value = $sheet
                        ->getCellByColumnAndRow($x, $y)
                        ->getFormattedValue();
//                    if( empty($value) || ($value === '')){
//                        if( $x === 0 ){
//                            break;
//                        }
//                    }
                    $rowData[$table[$x]] = $value ;
                }
                if( count($rowData) > 0 ){
                    $data[] = $rowData;
                }
            }
        }catch (\Exception $exception){
//            return $this->renderApiJson(Code::PARAM_ERR,'表不正确');
        }
        //不需要删除文件
//        unlink($fileUrl);
        Yii::info('----------import student data ----'.print_r($data,true));
        return $data;
    }
    /**
     * 班级表添加下拉列表
     * @param $objPHPExcel
     * @return mixed
     */
    public static function clazz($objPHPExcel){
        //获得校区
        $section = SectionModel::getCampus();
        $strSection = implode(',', array_column($section,'name'));
        //获得课程

        $course = new CourseForm();
        $courseList= $course->getDataList(0,0,['courseName'],[]);
        $strCourse = implode(',', array_column($courseList,'courseName'));

        //获得班主任
        $staff = StaffModel::getList();
        foreach ($staff as $key => $value) {
            $staff[$key]['staffName'] = $value['userRealName'] . '/' . $value['staffNo'];
        }
        $strStaff = implode(',', array_column($staff,'staffName'));
        //获得教室
        $sectionList = array_combine(array_column($section, 'sectionId'), $section);
        $room = ClassRoomModel::getAllList();
        foreach ($room as $key => $value) {
            $room[$key]['roomName'] = $sectionList[$value['campusId']]['name'] .'>'. $value['roomName'] ;
        }
        $strRoom = implode(',', array_column($room,'roomName'));



        //循环添加下拉列
        for ($x = 2 ; $x <= 100 ; $x++){
            $objValidation1 = $objPHPExcel->getActiveSheet()->getCell('B'.$x)->getDataValidation();
            $objValidation1->setType(\PHPExcel_Cell_DataValidation::TYPE_LIST )
                ->setErrorStyle(\PHPExcel_Cell_DataValidation::STYLE_INFORMATION )
                ->setAllowBlank(false)
                ->setShowInputMessage(true)
                ->setShowErrorMessage(true)
                ->setShowDropDown(true)
                ->setErrorTitle('输入的值有误')
                ->setError('您输入的值不在下拉框列表内.')
                ->setPromptTitle('')
                ->setPrompt('')
                ->setFormula1('"' . $strSection . '"');

            $objValidation2 = $objPHPExcel->getActiveSheet()->getCell('E'.$x)->getDataValidation();
            $objValidation2->setType(\PHPExcel_Cell_DataValidation::TYPE_LIST )
                ->setErrorStyle(\PHPExcel_Cell_DataValidation::STYLE_INFORMATION )
                ->setAllowBlank(false)
                ->setShowInputMessage(true)
                ->setShowErrorMessage(true)
                ->setShowDropDown(true)
                ->setErrorTitle('输入的值有误')
                ->setError('您输入的值不在下拉框列表内.')
                ->setPromptTitle('')
                ->setPrompt('')
                ->setFormula1('"' . $strRoom . '"');


            $objValidation3 = $objPHPExcel->getActiveSheet()->getCell('L'.$x)->getDataValidation();
            $objValidation3->setType(\PHPExcel_Cell_DataValidation::TYPE_LIST )
                ->setErrorStyle(\PHPExcel_Cell_DataValidation::STYLE_INFORMATION )
                ->setAllowBlank(false)
                ->setShowInputMessage(true)
                ->setShowErrorMessage(true)
                ->setShowDropDown(true)
                ->setErrorTitle('输入的值有误')
                ->setError('您输入的值不在下拉框列表内.')
                ->setPromptTitle('')
                ->setPrompt('')
                ->setFormula1('"是,否"');

            $objValidation4 = $objPHPExcel->getActiveSheet()->getCell('D'.$x)->getDataValidation();
            $objValidation4->setType(\PHPExcel_Cell_DataValidation::TYPE_LIST )
                ->setErrorStyle(\PHPExcel_Cell_DataValidation::STYLE_INFORMATION )
                ->setAllowBlank(false)
                ->setShowInputMessage(true)
                ->setShowErrorMessage(true)
                ->setShowDropDown(true)
                ->setErrorTitle('输入的值有误')
                ->setError('您输入的值不在下拉框列表内.')
                ->setPromptTitle('')
                ->setPrompt('')
                ->setFormula1('"' . $strStaff . '"');
            $objValidation5 = $objPHPExcel->getActiveSheet()->getCell('F'.$x)->getDataValidation();
            $objValidation5->setType(\PHPExcel_Cell_DataValidation::TYPE_LIST )
                ->setErrorStyle(\PHPExcel_Cell_DataValidation::STYLE_INFORMATION )
                ->setAllowBlank(false)
                ->setShowInputMessage(true)
                ->setShowErrorMessage(true)
                ->setShowDropDown(true)
                ->setErrorTitle('输入的值有误')
                ->setError('您输入的值不在下拉框列表内.')
                ->setPromptTitle('')
                ->setPrompt('')
                ->setFormula1('"' . $strStaff . '"');

            $objValidation6 = $objPHPExcel->getActiveSheet()->getCell('G'.$x)->getDataValidation();
            $objValidation6->setType(\PHPExcel_Cell_DataValidation::TYPE_LIST )
                ->setErrorStyle(\PHPExcel_Cell_DataValidation::STYLE_INFORMATION )
                ->setAllowBlank(false)
                ->setShowInputMessage(true)
                ->setShowErrorMessage(true)
                ->setShowDropDown(true)
                ->setErrorTitle('输入的值有误')
                ->setError('您输入的值不在下拉框列表内.')
                ->setPromptTitle('')
                ->setPrompt('')
                ->setFormula1('"' . $strStaff . '"');

            $objValidation7 = $objPHPExcel->getActiveSheet()->getCell('C'.$x)->getDataValidation();
            $objValidation7->setType(\PHPExcel_Cell_DataValidation::TYPE_LIST )
                ->setErrorStyle(\PHPExcel_Cell_DataValidation::STYLE_INFORMATION )
                ->setAllowBlank(false)
                ->setShowInputMessage(true)
                ->setShowErrorMessage(true)
                ->setShowDropDown(true)
                ->setErrorTitle('输入的值有误')
                ->setError('您输入的值不在下拉框列表内.')
                ->setPromptTitle('')
                ->setPrompt('')
                ->setFormula1('"' . $strCourse . '"');
        }
        return $objPHPExcel;
    }

    /**
     * 课程信息添加下拉列表
     * @param $objPHPExcel
     * @return mixed
     */
    public static function shift($objPHPExcel) {
        //获得基础参数
        $data = BasicsModel::getListByArr([BasicsModel::CLASS_TERM,
            BasicsModel::SHIFT_GRADE,
            BasicsModel::SUBJECT,
            BasicsModel::SHIFT_CAT,
            BasicsModel::CLASS_TYPE,]);
        //班级
        $strClassTerm = implode(',', array_column($data[BasicsModel::CLASS_TERM],'name'));
        //年纪
        $strShiftGrade = implode(',', array_column($data[BasicsModel::SHIFT_GRADE],'name'));
        //科目
        $strSubject = implode(',', array_column($data[BasicsModel::SUBJECT],'name'));
        //类型
        $strShiftCat = implode(',', array_column($data[BasicsModel::SHIFT_CAT],'name'));
        //班型
        $strClassType = implode(',', array_column($data[BasicsModel::CLASS_TYPE],'name'));

        //获得校区
        $section = SectionModel::getCampus();
        $strSection = implode(',', array_column($section,'name'));
        //循环添加下拉列
        for ($x = 2 ; $x <= 100 ; $x++){
            //期段下拉
            $objValidation1 = $objPHPExcel->getActiveSheet()->getCell('D'.$x)->getDataValidation();
            $objValidation1->setType(\PHPExcel_Cell_DataValidation::TYPE_LIST )
                ->setErrorStyle(\PHPExcel_Cell_DataValidation::STYLE_INFORMATION )
                ->setAllowBlank(false)
                ->setShowInputMessage(true)
                ->setShowErrorMessage(true)
                ->setShowDropDown(true)
                ->setErrorTitle('输入的值有误')
                ->setError('您输入的值不在下拉框列表内.')
                ->setPromptTitle('')
                ->setPrompt('')
                ->setFormula1('"' . $strClassTerm . '"');
            //年纪下拉
            $objValidation2 = $objPHPExcel->getActiveSheet()->getCell('E'.$x)->getDataValidation();
            $objValidation2->setType(\PHPExcel_Cell_DataValidation::TYPE_LIST )
                ->setErrorStyle(\PHPExcel_Cell_DataValidation::STYLE_INFORMATION )
                ->setAllowBlank(false)
                ->setShowInputMessage(true)
                ->setShowErrorMessage(true)
                ->setShowDropDown(true)
                ->setErrorTitle('输入的值有误')
                ->setError('您输入的值不在下拉框列表内.')
                ->setPromptTitle('')
                ->setPrompt('')
                ->setFormula1('"' . $strShiftGrade . '"');

            //科目下拉
            $objValidation3 = $objPHPExcel->getActiveSheet()->getCell('F'.$x)->getDataValidation();
            $objValidation3->setType(\PHPExcel_Cell_DataValidation::TYPE_LIST )
                ->setErrorStyle(\PHPExcel_Cell_DataValidation::STYLE_INFORMATION )
                ->setAllowBlank(false)
                ->setShowInputMessage(true)
                ->setShowErrorMessage(true)
                ->setShowDropDown(true)
                ->setErrorTitle('输入的值有误')
                ->setError('您输入的值不在下拉框列表内.')
                ->setPromptTitle('')
                ->setPrompt('')
                ->setFormula1('"' . $strSubject . '"');

            //类型下拉
            $objValidation4 = $objPHPExcel->getActiveSheet()->getCell('G'.$x)->getDataValidation();
            $objValidation4->setType(\PHPExcel_Cell_DataValidation::TYPE_LIST )
                ->setErrorStyle(\PHPExcel_Cell_DataValidation::STYLE_INFORMATION )
                ->setAllowBlank(false)
                ->setShowInputMessage(true)
                ->setShowErrorMessage(true)
                ->setShowDropDown(true)
                ->setErrorTitle('输入的值有误')
                ->setError('您输入的值不在下拉框列表内.')
                ->setPromptTitle('')
                ->setPrompt('')
                ->setFormula1('"' . $strShiftCat . '"');

            //班型下拉
            $objValidation5 = $objPHPExcel->getActiveSheet()->getCell('H'.$x)->getDataValidation();
            $objValidation5->setType(\PHPExcel_Cell_DataValidation::TYPE_LIST )
                ->setErrorStyle(\PHPExcel_Cell_DataValidation::STYLE_INFORMATION )
                ->setAllowBlank(false)
                ->setShowInputMessage(true)
                ->setShowErrorMessage(true)
                ->setShowDropDown(true)
                ->setErrorTitle('输入的值有误')
                ->setError('您输入的值不在下拉框列表内.')
                ->setPromptTitle('')
                ->setPrompt('')
                ->setFormula1('"' . $strClassType . '"');

            //校区下拉
            $objValidation6 = $objPHPExcel->getActiveSheet()->getCell('L'.$x)->getDataValidation();
            $objValidation6->setType(\PHPExcel_Cell_DataValidation::TYPE_LIST )
                ->setErrorStyle(\PHPExcel_Cell_DataValidation::STYLE_INFORMATION )
                ->setAllowBlank(false)
                ->setShowInputMessage(true)
                ->setShowDropDown(true)
                ->setPromptTitle('')
                ->setPrompt('')
                ->setFormula1('"' . $strSection . '"');

        }
        return $objPHPExcel;
    }

    /**
     * 分班信息表添加下拉列表
     * @param $objPHPExcel
     * @return mixed
     */
    public static function classgroup($objPHPExcel){
        //获得所有班级
        $classes = new ClassesForm();
        $classesList= $classes->getDataList(0,0,['classesName'],[]);
        $strClasses = implode(',', array_column($classesList,'classesName'));

        //获得所有课程
        $course = new CourseForm();
        $courseList= $course->getDataList(0,0,['courseName'],[]);
        $strCourse = implode(',', array_column($courseList,'courseName'));
        //循环添加下拉列
        for ($x = 2 ; $x <= 100 ; $x++){
            //班级下拉
            $objValidation1 = $objPHPExcel->getActiveSheet()->getCell('C'.$x)->getDataValidation();
            $objValidation1->setType(\PHPExcel_Cell_DataValidation::TYPE_LIST )
                ->setErrorStyle(\PHPExcel_Cell_DataValidation::STYLE_INFORMATION )
                ->setAllowBlank(false)
                ->setShowInputMessage(true)
                ->setShowErrorMessage(true)
                ->setShowDropDown(true)
                ->setErrorTitle('输入的值有误')
                ->setError('您输入的值不在下拉框列表内.')
                ->setPromptTitle('')
                ->setPrompt('')
                ->setFormula1('"' . $strClasses . '"');
            //课程下拉
            $objValidation2 = $objPHPExcel->getActiveSheet()->getCell('D'.$x)->getDataValidation();
            $objValidation2->setType(\PHPExcel_Cell_DataValidation::TYPE_LIST )
                ->setErrorStyle(\PHPExcel_Cell_DataValidation::STYLE_INFORMATION )
                ->setAllowBlank(false)
                ->setShowInputMessage(true)
                ->setShowErrorMessage(true)
                ->setShowDropDown(true)
                ->setErrorTitle('输入的值有误')
                ->setError('您输入的值不在下拉框列表内.')
                ->setPromptTitle('')
                ->setPrompt('')
                ->setFormula1('"' . $strCourse . '"');
        }
        return $objPHPExcel;
    }

    public static function course($objPHPExcel) {
        //获得所有课程
        $course = new CourseForm();
        $courseList= $course->getDataList(0,0,['courseName'],[]);
        $strCourse = implode(',', array_column($courseList,'courseName'));

        //获得校区
        $section = SectionModel::getCampus();
        $strSection = implode(',', array_column($section,'name'));

        //获得教室
        $sectionList = array_combine(array_column($section, 'sectionId'), $section);
        $room = ClassRoomModel::getAllList();
        foreach ($room as $key => $value) {
            $room[$key]['roomName'] = $sectionList[$value['campusId']]['name'] .'>'. $value['roomName'] ;
        }
        $strRoom = implode(',', array_column($room,'roomName'));

        //获得班主任
        $staff = StaffModel::getList();
        foreach ($staff as $key => $value) {
            $staff[$key]['staffName'] = $value['userRealName'] . '/' . $value['staffNo'];
        }
        $strStaff = implode(',', array_column($staff,'staffName'));

        //循环添加下拉列
        for ($x = 2 ; $x <= 100 ; $x++){
            //课程下拉
            $objValidation1 = $objPHPExcel->getActiveSheet()->getCell('B'.$x)->getDataValidation();
            $objValidation1->setType(\PHPExcel_Cell_DataValidation::TYPE_LIST )
                ->setErrorStyle(\PHPExcel_Cell_DataValidation::STYLE_INFORMATION )
                ->setAllowBlank(false)
                ->setShowInputMessage(true)
                ->setShowErrorMessage(true)
                ->setShowDropDown(true)
                ->setErrorTitle('输入的值有误')
                ->setError('您输入的值不在下拉框列表内.')
                ->setPromptTitle('')
                ->setPrompt('')
                ->setFormula1('"' . $strCourse . '"');
            //校区下拉
            $objValidation2 = $objPHPExcel->getActiveSheet()->getCell('D'.$x)->getDataValidation();
            $objValidation2->setType(\PHPExcel_Cell_DataValidation::TYPE_LIST )
                ->setErrorStyle(\PHPExcel_Cell_DataValidation::STYLE_INFORMATION )
                ->setAllowBlank(false)
                ->setShowInputMessage(true)
                ->setShowErrorMessage(true)
                ->setShowDropDown(true)
                ->setErrorTitle('输入的值有误')
                ->setError('您输入的值不在下拉框列表内.')
                ->setPromptTitle('')
                ->setPrompt('')
                ->setFormula1('"' . $strSection . '"');

            //老师下拉
            $objValidation3 = $objPHPExcel->getActiveSheet()->getCell('E'.$x)->getDataValidation();
            $objValidation3->setType(\PHPExcel_Cell_DataValidation::TYPE_LIST )
                ->setErrorStyle(\PHPExcel_Cell_DataValidation::STYLE_INFORMATION )
                ->setAllowBlank(false)
                ->setShowInputMessage(true)
                ->setShowErrorMessage(true)
                ->setShowDropDown(true)
                ->setErrorTitle('输入的值有误')
                ->setError('您输入的值不在下拉框列表内.')
                ->setPromptTitle('')
                ->setPrompt('')
                ->setFormula1('"' . $strStaff . '"');

            $objValidation3 = $objPHPExcel->getActiveSheet()->getCell('F'.$x)->getDataValidation();
            $objValidation3->setType(\PHPExcel_Cell_DataValidation::TYPE_LIST )
                ->setErrorStyle(\PHPExcel_Cell_DataValidation::STYLE_INFORMATION )
                ->setAllowBlank(false)
                ->setShowInputMessage(true)
                ->setShowErrorMessage(true)
                ->setShowDropDown(true)
                ->setErrorTitle('输入的值有误')
                ->setError('您输入的值不在下拉框列表内.')
                ->setPromptTitle('')
                ->setPrompt('')
                ->setFormula1('"' . $strStaff . '"');
            //教室
            $objValidation3 = $objPHPExcel->getActiveSheet()->getCell('G'.$x)->getDataValidation();
            $objValidation3->setType(\PHPExcel_Cell_DataValidation::TYPE_LIST )
                ->setErrorStyle(\PHPExcel_Cell_DataValidation::STYLE_INFORMATION )
                ->setAllowBlank(false)
                ->setShowInputMessage(true)
                ->setShowErrorMessage(true)
                ->setShowDropDown(true)
                ->setErrorTitle('输入的值有误')
                ->setError('您输入的值不在下拉框列表内.')
                ->setPromptTitle('')
                ->setPrompt('')
                ->setFormula1('"' . $strRoom . '"');
        }
        return $objPHPExcel;
    }

    /**
     * 为学员信息模板添加下拉框
     * @param $objPHPExcel
     * @return mixed
     */
    public static function student($objPHPExcel) {

        //获得基础参数
        $data = BasicsModel::getListByArr([
            BasicsModel::STUDENT_TYPE, //学员类型
            BasicsModel::SHIFT_GRADE,   //年级
            BasicsModel::SALE_MODE,     //招生来源
            BasicsModel::FULLTIME_SCHOOL,     //公立学校名称
            BasicsModel::CLASS_TYPE,    //课程所属班型
            ]);
        //学员类别
        $strStudentType = implode(',', array_column($data[BasicsModel::STUDENT_TYPE],'name'));

        //获得年级
        $strShiftGrade = implode(',', array_column($data[BasicsModel::SHIFT_GRADE],'name'));

        //获得招生来源
        $strSaleMode = implode(',', array_column($data[BasicsModel::SALE_MODE],'name'));
        //获得公立学校
        $strFullSchool = implode(',', array_column($data[BasicsModel::FULLTIME_SCHOOL],'name'));
        //性别
        $strSex = implode(',',['男','女']);
        //循环添加下拉列
        for ($x = 2 ; $x <= 600 ; $x++){
            $objValidation1 = $objPHPExcel->getActiveSheet()->getCell('F'.$x)->getDataValidation();
            $objValidation1->setType(\PHPExcel_Cell_DataValidation::TYPE_LIST )
                ->setErrorStyle(\PHPExcel_Cell_DataValidation::STYLE_INFORMATION )
                ->setAllowBlank(false)
                ->setShowInputMessage(true)
                ->setShowErrorMessage(true)
                ->setShowDropDown(true)
                ->setErrorTitle('输入的值有误')
                ->setError('您输入的值不在下拉框列表内.')
                ->setPromptTitle('')
                ->setPrompt('')
                ->setFormula1('"' . $strStudentType . '"');

            $objValidation1 = $objPHPExcel->getActiveSheet()->getCell('P'.$x)->getDataValidation();
            $objValidation1->setType(\PHPExcel_Cell_DataValidation::TYPE_LIST )
                ->setErrorStyle(\PHPExcel_Cell_DataValidation::STYLE_INFORMATION )
                ->setAllowBlank(false)
                ->setShowInputMessage(true)
                ->setShowErrorMessage(true)
                ->setShowDropDown(true)
                ->setErrorTitle('输入的值有误')
                ->setError('您输入的值不在下拉框列表内.')
                ->setPromptTitle('')
                ->setPrompt('')
                ->setFormula1('"' . $strShiftGrade . '"');

            $objValidation1 = $objPHPExcel->getActiveSheet()->getCell('Q'.$x)->getDataValidation();
            $objValidation1->setType(\PHPExcel_Cell_DataValidation::TYPE_LIST )
                ->setErrorStyle(\PHPExcel_Cell_DataValidation::STYLE_INFORMATION )
                ->setAllowBlank(false)
                ->setShowInputMessage(true)
                ->setShowErrorMessage(true)
                ->setShowDropDown(true)
                ->setErrorTitle('输入的值有误')
                ->setError('您输入的值不在下拉框列表内.')
                ->setPromptTitle('')
                ->setPrompt('')
                ->setFormula1('"' . $strSaleMode . '"');

            $objValidation1 = $objPHPExcel->getActiveSheet()->getCell('O'.$x)->getDataValidation();
            $objValidation1->setType(\PHPExcel_Cell_DataValidation::TYPE_LIST )
                ->setErrorStyle(\PHPExcel_Cell_DataValidation::STYLE_INFORMATION )
                ->setAllowBlank(false)
                ->setShowInputMessage(true)
                ->setShowErrorMessage(true)
                ->setShowDropDown(true)
                ->setErrorTitle('输入的值有误')
                ->setError('您输入的值不在下拉框列表内.')
                ->setPromptTitle('')
                ->setPrompt('')
                ->setFormula1('"' . $strFullSchool . '"');

            $objValidation1 = $objPHPExcel->getActiveSheet()->getCell('B'.$x)->getDataValidation();
            $objValidation1->setType(\PHPExcel_Cell_DataValidation::TYPE_LIST )
                ->setErrorStyle(\PHPExcel_Cell_DataValidation::STYLE_INFORMATION )
                ->setAllowBlank(false)
                ->setShowInputMessage(true)
                ->setShowErrorMessage(true)
                ->setShowDropDown(true)
                ->setErrorTitle('输入的值有误')
                ->setError('您输入的值不在下拉框列表内.')
                ->setPromptTitle('')
                ->setPrompt('')
                ->setFormula1('"' . $strSex . '"');
        }
        return $objPHPExcel;
    }

    /*
     * 为学员剩余学费模板添加下拉框
     * */
    public static function fee($objPHPExcel) {

        //获得基础参数
        $data = BasicsModel::getListByArr([
            BasicsModel::FeeCustType, //收费类型
        ]);
        //收费类型
        $feeType = implode(',', array_column($data[BasicsModel::FeeCustType],'name'));
        //课程
        $courseList = ['预存'];
        $course = CourseModel::find()->where(['isDelete'=>CourseModel::IS_VALID_OK])->asArray()->all();
        if( count($course) > 0 ){
            foreach( $course as $courseInfo){
                if( !in_array($courseInfo['courseName'],$courseList) ){
                    $courseList[] = $courseInfo['courseName'];
                }
            }
        }
        $courseList = count($courseList) > 0 ? implode(',',$courseList) : '';
        $campusList = [];
        $campus = SectionModel::getCampus();
        if( count($campus) > 0 ){
            foreach( $campus as $campusInfo){
                if( !in_array($campusInfo['name'],$campusList) ){
                    $campusList[] = $campusInfo['name'];
                }
            }
        }
        $campusList = count($campusList) > 0 ? implode(',',$campusList) : '';
        //循环添加下拉列
        for ($x = 2 ; $x <= 600 ; $x++){
            $objValidation1 = $objPHPExcel->getActiveSheet()->getCell('C'.$x)->getDataValidation();
            $objValidation1->setType(\PHPExcel_Cell_DataValidation::TYPE_LIST )
                ->setErrorStyle(\PHPExcel_Cell_DataValidation::STYLE_INFORMATION )
                ->setAllowBlank(false)
                ->setShowInputMessage(true)
                ->setShowErrorMessage(true)
                ->setShowDropDown(true)
                ->setErrorTitle('输入的值有误')
                ->setError('您输入的值不在下拉框列表内.')
                ->setPromptTitle('')
                ->setPrompt('')
                ->setFormula1('"' . $courseList . '"');

            $objValidation1 = $objPHPExcel->getActiveSheet()->getCell('D'.$x)->getDataValidation();
            $objValidation1->setType(\PHPExcel_Cell_DataValidation::TYPE_LIST )
                ->setErrorStyle(\PHPExcel_Cell_DataValidation::STYLE_INFORMATION )
                ->setAllowBlank(false)
                ->setShowInputMessage(true)
                ->setShowErrorMessage(true)
                ->setShowDropDown(true)
                ->setErrorTitle('输入的值有误')
                ->setError('您输入的值不在下拉框列表内.')
                ->setPromptTitle('')
                ->setPrompt('')
                ->setFormula1('"' . $campusList . '"');

            $objValidation1 = $objPHPExcel->getActiveSheet()->getCell('E'.$x)->getDataValidation();
            $objValidation1->setType(\PHPExcel_Cell_DataValidation::TYPE_LIST )
                ->setErrorStyle(\PHPExcel_Cell_DataValidation::STYLE_INFORMATION )
                ->setAllowBlank(false)
                ->setShowInputMessage(true)
                ->setShowErrorMessage(true)
                ->setShowDropDown(true)
                ->setErrorTitle('输入的值有误')
                ->setError('您输入的值不在下拉框列表内.')
                ->setPromptTitle('')
                ->setPrompt('')
                ->setFormula1('"' . $campusList . '"');

            $objValidation1 = $objPHPExcel->getActiveSheet()->getCell('H'.$x)->getDataValidation();
            $objValidation1->setType(\PHPExcel_Cell_DataValidation::TYPE_LIST )
                ->setErrorStyle(\PHPExcel_Cell_DataValidation::STYLE_INFORMATION )
                ->setAllowBlank(false)
                ->setShowInputMessage(true)
                ->setShowErrorMessage(true)
                ->setShowDropDown(true)
                ->setErrorTitle('输入的值有误')
                ->setError('您输入的值不在下拉框列表内.')
                ->setPromptTitle('')
                ->setPrompt('')
                ->setFormula1('"' . $feeType . '"');
        }
        return $objPHPExcel;
    }
}