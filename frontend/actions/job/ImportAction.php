<?php
/**
 * User: cqj
 * Date: 2020/7/28
 * Time: 3:13 下午
 */

namespace frontend\actions\job;


use frontend\actions\WxAction;
use common\library\helper\Code;
use common\models\jobInfo\JobInfoForm;
use common\models\jobInfo\JobInfoModel;
use common\models\jobSkill\JobSkillForm;
use common\models\SignupForm;
use common\models\User;
use common\models\user\UserModel;
use yii\helpers\Json;
use yii\web\UploadedFile;

class ImportAction extends WxAction
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
        $allColumn = $sheet->getHighestColumn();
        $allRow = $sheet->getHighestRow();
        $ColumnNum = \PHPExcel_Cell::columnIndexFromString($allColumn);
        $table = [
            'name',
            'sex',
            'phone',
            'age',
            'idCard'
        ];
        if($allRow == 0 || $ColumnNum == 0){
            return $this->returnApi(Code::PARAM_ERR,'不能为空表');
        }
        $data = [] ;
        try{
            //整理数据
            for ($y = 2; $y <= $allRow ; $y++) {
                $rowData = [];
                for ($x = 0 ; $x < $ColumnNum ; $x++) {
                    $value = $sheet
                        ->getCellByColumnAndRow($x, $y)
                        ->getFormattedValue();
                    $rowData[$table[$x]] = $value ;
                }
                if( count($rowData) > 0 ){
                    $data[] = $rowData;
                }
            }
        }catch (\Exception $exception){
            return $this->returnApi(Code::PARAM_ERR,'表不正确');
        } finally {
            unlink($fileUrl);
        }
        $phone = array_column($data,'phone');
        //拿着手机号去查询 是否存在冲突
        $user = User::find()
            ->where(['userAccount' => $phone])
            ->andWhere(['userType' => UserModel::JOB])
            ->andWhere(['isValid' => UserModel::IS_VALID_OK])
            ->asArray()
            ->all();
        if (!empty($user)) {
            $oldPhone = array_column($user,'userAccount');
            $strPhone = implode(',',$oldPhone);
            return $this->returnApi(Code::PARAM_ERR,'出现已注册的手机号：'.$strPhone);
        }
        $tran = \Yii::$app->db->beginTransaction();

        try {
            foreach ($data as $value) {
                $model = new JobInfoModel() ;
                //TODO 具体情况判断重命名
                //TODO 具体情况赋值参数
                $model->status = JobInfoModel::STATUS_INTERVIEW ;
                if (empty($staffId)) {
                    $model->status = JobInfoModel::STATUS_PUBLIC ;
                }
                if (empty($value['phone'])) {
                    $tran->rollBack();
                    return ['code' => Code::PARAM_ERR ,'msg'=>'手机号不能为空'] ;
                }
                $model->name = $value['name'] ;
                $model->sex = $value['sex'] == '男' ? 1 : 0;
                $model->phone = $value['phone'] ;
                $model->age = $value['age'];
                $model->idCard = $value['idCard'];
                $model->staffId = $staffId;
                $model->supplierId = $supplierId;
                $model->save();

                //新增登陆账号
                $signUp = new SignupForm();
                $signUp->userAccount = $model->phone;
                $signUp->userPwd = substr($model->phone,-6);
                $signUp->userName = $model->name;
                $signUp->tel = $model->phone;
                $signUp->jobId = $model->jobId;
                $signUp->userType = UserModel::JOB;
                $result = $signUp->signup();
                if ($result['code'] != 0) {
                    $tran->rollBack();
                    return ['code' => Code::PARAM_ERR ,'msg'=>$result['msg']] ;
                }
                $model->userId = $result['userId'];
                $model->save();
            }
            $tran->commit();

        }catch (\Exception $exception) {
            \Yii::info('添加失败:' . $exception->getMessage());
            $tran->rollBack();
            return $this->returnApi(Code::PARAM_ERR,$exception->getMessage());
        }
        return $this->returnApi(Code::SUCCESS,'导入成功');



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
        $savePath = \Yii::getAlias('@frontend').'/web/upload/template/upload/';
        /*以时间来命名上传的文件*/
        $str = date('Ymdhis');
        $file_name = $str . "." . $file_type;
        $fileUrl = $savePath . $file_name;
        $file->saveAs($fileUrl);
        return $fileUrl;
    }
}