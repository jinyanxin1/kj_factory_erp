<?php
/**
 * Created by cqj
 * User: cqj
 * Date: 2019/10/25
 * Time: 16:15
 */

namespace backend\models\system;


use common\library\helper\Code;
use common\models\BaseForm;
use common\models\system\SchooltimeDetailsModel;
use common\models\system\SchooltimeGroupModel;
use common\models\system\SectionModel;
use Yii;

class SchooltimeGroupForm extends BaseForm
{
    public $campusId;
    public $isCommonality;
    public $schooltimeGroupId;
    public function rules () {
        return [
            ['campusId','required'],
            ['isCommonality','default','value' => 0],
            ['campusId' , function ($attr, $params) {
                if($this->isCommonality == SchooltimeGroupModel::IS_COMMONALITY_NO){
                    if ( !is_array($this->campusId)) {
                        $this->addError($attr, "校区编号格式错误");
                        return;
                    }
                    foreach ($this->campusId as $item) {
                        if (empty($item)) {
                            $this->addError($attr, "校区编号不能为空");
                            return;
                        }
                    }
                }

            }]
        ];
    }

    public function attributeLabels()
    {
        return [
            'campusId' => '校区编号',
            'isCommonality' => '公用状态',
        ];
    }

    /**
     * 获得列表
     * @return array|\yii\db\ActiveRecord[]
     */
    public static function getList($schoolId) {
        $list = SchooltimeGroupModel::find()
            ->select(['schooltimeGroupId','sectionName','campusId','isCommonality','schoolId'])
            ->where(['isDelete' => SchooltimeGroupModel::IS_VALID_OK])
            ->andWhere(['schoolId' => $schoolId])
            ->orderBy('isCommonality')
            ->asArray()
            ->all();
        $campusIds = array_unique(array_column($list,'campusId')) ;
        $section = SectionModel::find()->select(['sectionId','name'])
            ->where(['isDelete' => SectionModel::IS_VALID_OK , 'sectionId' => $campusIds ])
            ->asArray()
            ->indexBy('sectionId')
            ->all();
        foreach ( $list as $key => $value ) {
            $list[$key]['sectionName'] =
                isset($section[$value['campusId']]) ? $section[$value['campusId']]['name'] : '' ;
        }
        return $list;
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
        $rows = [];
        $schooltimeGroupId = 0;
        $existGroup = SchooltimeGroupModel::find()
            ->select(['schooltimeGroupId','campusId','isCommonality'])
            ->where(['isDelete' => SchooltimeGroupModel::IS_VALID_OK])
            ->andFilterWhere(['schoolId' => $this->schoolId])
            ->asArray()
            ->all();
        if($this->isCommonality == SchooltimeGroupModel::IS_COMMONALITY_NO){
            $existGroupIds = array_column($existGroup,'campusId');
            if ( array_intersect($existGroupIds,$this->campusId) ) {
                return ['code' => Code::PARAM_ERR ,'msg'=>'无法重复添加校区上课时间'];
            }

            if (in_array(SchooltimeGroupModel::IS_COMMONALITY_YES,
                array_column($existGroup,'isCommonality'))) {
                foreach ( $existGroup as $value ) {
                    if ( $value['isCommonality'] == SchooltimeGroupModel::IS_COMMONALITY_YES ){
                        $schooltimeGroupId = $value['schooltimeGroupId'];
                    }
                }
                $rows = SchooltimeDetailsModel::find()
                    ->select(['name', 'startTime','endTime','schooltimeId','campusId'])
                    ->where(['schooltimeId' => $schooltimeGroupId,'isDelete' => SchooltimeDetailsModel::IS_VALID_OK])
                    ->asArray()
                    ->all();
            }
        }
        //开启事务
        $tran = Yii::$app->db->beginTransaction();
        try{

            if($this->isCommonality == SchooltimeGroupModel::IS_COMMONALITY_NO){
                foreach ( $this->campusId as $value ) {
                    $scooltimeGroup = new SchooltimeGroupModel();
                    $scooltimeGroup->isCommonality = $this->isCommonality;
                    $scooltimeGroup->campusId = $value;
                    $scooltimeGroup->schoolId = $this->schoolId;
                    if(!$scooltimeGroup->save()) {
                        return ['code' => Code::PARAM_ERR ,'msg'=>'新增失败'];
                    }
                    if(!empty($rows)){
                        foreach ($rows as $key => $v) {
                            $rows[$key]['schooltimeId'] = $scooltimeGroup->schooltimeGroupId;
                            $rows[$key]['campusId'] = $value;
                            $rows[$key]['creator'] = $scooltimeGroup->creator;;
                            $rows[$key]['updater'] = $scooltimeGroup->updater;;
                            $rows[$key]['createTime'] = $scooltimeGroup->createTime;;
                        }

                        Yii::$app->db->createCommand()
                            ->batchInsert(
                                SchooltimeDetailsModel::tableName(),
                                ['name', 'startTime','endTime','schooltimeId','campusId','creator','updater','createTime'],
                                $rows)
                            ->execute();
                    }
                }
            } else {
                $scooltimeGroup = new SchooltimeGroupModel();
                $scooltimeGroup->isCommonality = $this->isCommonality;
                $scooltimeGroup->campusId = 0 ;
                if(!$scooltimeGroup->save()) {
                    return ['code' => Code::PARAM_ERR ,'msg'=>'新增失败'];
                }
            }

            $tran->commit();
        }catch (\Exception $exception){
            $tran->rollBack();
            return ['code' => Code::PARAM_ERR ,'msg'=>$exception->getMessage()];
        }
        return ['code' => Code::SUCCESS ,'msg'=>'新增成功'];
    }

    /**
     * 删除
     * @return array
     */
    public function del() {
        $model = SchooltimeGroupModel::find()->where(
            ['isDelete' => SchooltimeGroupModel::IS_VALID_OK ,
            'schooltimeGroupId' => $this->schooltimeGroupId])
            ->one();
        if(empty($model)){
            return ['code' => Code::PARAM_ERR ,'msg'=> '无效编号'];
        }
        $tran = Yii::$app->db->beginTransaction();
        try{
            $model->isDelete = SchooltimeGroupModel::IS_VALID_NO;
            if( !$model->save() ){
                return ['code' => Code::PARAM_ERR ,'msg'=> '删除失败'];
            }
            Yii::$app->db->createCommand()->update(SchooltimeDetailsModel::tableName(),
                ['isDelete' => SchooltimeDetailsModel::IS_VALID_NO],
                'schooltimeId = :schooltimeId',
                [':schooltimeId'=>$this->schooltimeGroupId])->execute();
            $tran->commit();
        }catch (\Exception $exception){
            $tran->rollBack();
            return ['code' => Code::PARAM_ERR ,'msg'=>$exception->getMessage()];
        }
        return ['code' => Code::SUCCESS ,'msg'=>'删除成功'];
    }
}