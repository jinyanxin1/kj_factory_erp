<?php
/**
 * Created by cqj
 * User: cqj
 * Date: 2019/10/29
 * Time: 9:33
 */

namespace backend\models\system;


use common\library\helper\Code;
use common\models\BaseForm;
use common\models\system\SchooltimeDetailsModel;
use common\models\system\SchooltimeGroupModel;
use Yii;

class SchooltimeForm extends BaseForm
{
    public $name;
    public $startTime;
    public $endTime;
    public $schooltimeId;
    public $campusId;
    public $schooltimeDetailsId;

    public function rules()
    {
        return [
            [['name','startTime','endTime'],'required'],
            [['startTime','endTime'],'match','pattern'=>'/^([0-5]\d):([0-5]\d)$/','message'=>'时间格式不正确'],
            ['startTime' , 'verifyTime']
        ];
    }

    /**
     * 验证时间规格和大小
     * @param $attr
     * @param $params
     */
    public function verifyTime($attr, $params){
        if (!strtotime($this->startTime) || !strtotime($this->endTime)) {
            $this->addError($attr, '时间格式不正确');
            return;
        }

        //判断开始时间大于结束时间
        if(strtotime($this->startTime) >= strtotime($this->endTime)) {
            $this->addError($attr, '开始时间必须大于结束时间');
            return;
        }
    }

    public function attributeLabels()
    {
        return [
            'name' => '名称' ,
            'startTime' => '开始时间' ,
            'endTime' => '结束时间' ,
            'schooltimeId' => '上课组编号' ,
            'campusId' => '校区编号' ,
        ];
    }

    /**
     * 不分页查询校区对应的
     * @param $campusId
     * @return array|\yii\db\ActiveRecord[]
     */
    public static function getList($campusId) {
        $list = SchooltimeDetailsModel::find()
            ->select(['schooltimeDetailsId','name','startTime','endTime'])
            ->where(['isDelete' => SchooltimeDetailsModel::IS_VALID_OK])
            ->andWhere(['campusId' => $campusId]);

        if ($list->count() == 0) {
            $schooltimeId = SchooltimeGroupModel::find()
                ->select(['schooltimeGroupId'])
                ->where(['isDelete' => SchooltimeGroupModel::IS_VALID_OK])
                ->andWhere(['isCommonality' => SchooltimeGroupModel::IS_COMMONALITY_YES])
                ->asArray()
                ->one();
            if(empty($schooltimeId)){
                return [];
            }
            $list = SchooltimeDetailsModel::find()
                ->select(['schooltimeDetailsId','name','startTime','endTime'])
                ->where(['isDelete' => SchooltimeDetailsModel::IS_VALID_OK])
                ->andWhere(['schooltimeId' => $schooltimeId['schooltimeGroupId']]);
        }

        return $list->asArray()->all() ;
    }

    /**
     * 分页查询
     * @param $page
     * @param $pageSize
     * @return array
     */
    public function getPageList($page,$pageSize) {
        if(empty($this->campusId)) {
            return ['code' => Code::PARAM_ERR ,'msg'=>'校区编号不能为空','data' => []];
        }
        $offset = ($page - 1) * $pageSize;

        $list = SchooltimeDetailsModel::find()
            ->select(['schooltimeDetailsId','name','startTime','endTime'])
            ->where(['isDelete' => SchooltimeDetailsModel::IS_VALID_OK])
            ->andWhere(['campusId' => $this->campusId]);
        $count = $list -> count();

        $data = $list->offset($offset)->limit($pageSize)->all();
        return ['code' =>Code::SUCCESS, 'msg' => 'ok',
            'data' => array('list' => $data, 'pageInfo' => $this->getPageInfo($count, $pageSize, $page))];

    }

    /**
     * 新增
     * @return array
     */
    public function insert () {
        if(!$this->validate()){
            $firstItem = $this->getErrors();
            foreach ($firstItem as $value) {
                return ['code' => Code::PARAM_ERR ,'msg'=>$value[0]];
            }
        }
        if(empty($this->schooltimeId)){
            return ['code' => Code::PARAM_ERR ,'msg'=>'上课组编号不能为空'];

        }
        $group = SchooltimeGroupModel::find()
            ->select(['campusId'])
            ->where(['isDelete' => SchooltimeGroupModel::IS_VALID_OK])
            ->andWhere(['schooltimeGroupId' => $this->schooltimeId])
            ->one();
        if(empty($group)){
            return ['code' => Code::PARAM_ERR ,'msg'=>'无效分组编号'];
        }
        $schoolTimeList = self::getList($group->campusId);
        //判断重名
        $nameList = array_column($schoolTimeList,'name');
        if(in_array(trim($this->name),$nameList)){
            return ['code' => Code::PARAM_ERR ,'msg'=>'名称重复'];
        }

        //判断开始时间重复
        $startTimeList = array_column($schoolTimeList,'startTime');
        if(in_array(date('H:i:s',strtotime($this->startTime)),$startTimeList)){
            return ['code' => Code::PARAM_ERR ,'msg'=>'开始时间重复'];
        }
        //判断结束时间重复
        $endTimeList = array_column($schoolTimeList,'endTime');
        if(in_array(date('H:i:s',strtotime($this->endTime)),$endTimeList)){
            return ['code' => Code::PARAM_ERR ,'msg'=>'结束时间重复'];

        }
        $model = new SchooltimeDetailsModel();
        $model->name = trim($this->name);
        $model->startTime = $this->startTime;
        $model->endTime = $this->endTime;
        $model->schooltimeId = $this->schooltimeId;
        $model->campusId = $group->campusId;
        $model->schoolId = $this->schoolId;
        if(!$model->save()) {
            return ['code' => Code::PARAM_ERR ,'msg'=>'新增失败'];
        }
        return ['code' => Code::SUCCESS ,'msg'=>'新增成功'];
    }

    /**
     * 修改
     * @return array
     */
    public function update () {
        if(!$this->validate()){
            $firstItem = $this->getErrors();
            foreach ($firstItem as $value) {
                return ['code' => Code::PARAM_ERR ,'msg'=>$value[0]];
            }
        }

        $model = SchooltimeDetailsModel::find()
            ->where(['isDelete' => SchooltimeDetailsModel::IS_VALID_OK,'schooltimeDetailsId' => $this->schooltimeDetailsId]);
        if($model->count() == 0){
            return ['code' => Code::PARAM_ERR ,'msg'=>'无效编号'];
        }
        $model = $model->one();

        $schoolTimeList = self::getList($this->campusId);
        //判断重名
        if($model->name != trim($this->name)){
            $nameList = array_column($schoolTimeList,'name');
            if(in_array(trim($this->name),$nameList)){
                return ['code' => Code::PARAM_ERR ,'msg'=>'名称重复'];
            }
        }

        //判断开始时间重复
        if(date('H:i:s',strtotime($this->startTime)) != $model->startTime) {
            $startTimeList = array_column($schoolTimeList,'startTime');
            if(in_array(date('H:i:s',strtotime($this->startTime)),$startTimeList)){
                return ['code' => Code::PARAM_ERR ,'msg'=>'开始时间重复'];
            }
        }

        //判断结束时间重复
        if(date('H:i:s',strtotime($this->endTime)) != $model->endTime){
            $endTimeList = array_column($schoolTimeList,'endTime');
            if(in_array(date('H:i:s',strtotime($this->endTime)),$endTimeList)){
                return ['code' => Code::PARAM_ERR ,'msg'=>'结束时间重复'];
            }
        }

        $model->name = trim($this->name);
        $model->startTime = $this->startTime;
        $model->endTime = $this->endTime;
        if(!$model->save()) {
            return ['code' => Code::PARAM_ERR ,'msg'=>'修改失败'];
        }
        return ['code' => Code::SUCCESS ,'msg'=>'修改成功'];
    }

    /**
     * 删除
     * @return array
     */
    public function del () {
        if(empty($this->schooltimeDetailsId)){
            return ['code' => Code::SUCCESS ,'msg'=>'编号不能为空'];

        }
        $schooltime = SchooltimeDetailsModel::getInfoById($this->schooltimeDetailsId);
        if(empty($schooltime)){
            return ['code' => Code::SUCCESS ,'msg'=>'编号错误'];
        }
        $schooltime -> isDelete = SchooltimeDetailsModel::IS_VALID_NO;
        if(!$schooltime->save()){
            return ['code' => Code::PARAM_ERR ,'msg'=>'删除失败'];
        }
        return ['code' => Code::SUCCESS ,'msg'=>'删除成功'];
    }








    /**
     * 得到分页信息
     * @param $count
     * @param int $pageSize
     * @param int $page
     * @return array
     */
    protected function getPageInfo($count , $pageSize = 0, $page = 1 ){
        if(empty($pageSize)){
            $pageSize = Yii::$app->params['pageSize'];
        }
        $pageSum = ceil($count/$pageSize);
        return [
            'page' => $page,
            'pageSum' => $pageSum,
            'pageSize' => $pageSize,
            'count' => $count
        ];
    }
}