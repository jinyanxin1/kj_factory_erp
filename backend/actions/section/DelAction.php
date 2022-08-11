<?php
/**
 * Created by cqj
 * User: cqj
 * Date: 2019/10/24
 * Time: 11:51
 * 删除
 */

namespace backend\actions\section;


use backend\actions\BaseAction;
use common\library\helper\Code;
use common\models\staffInfo\StaffInfoModel;
use common\models\system\section\SectionModel;
use yii\helpers\Json;

class DelAction extends BaseAction
{
    public function run() {
        \Yii::info('section/del' . Json::encode($this->request()->post(),true));
        $id = $this->request()->post('sectionId');
        if(empty($id)){
            return $this->returnApi(Code::PARAM_ERR,'请传入部门编号');
        }
        $staffList = StaffInfoModel::find()
            ->where(['isValid' => StaffInfoModel::IS_VALID_OK])
            ->andWhere(['sectionId' => $id])
            ->limit(1)
            ->one();
        if(!empty($staffList)) {
            return $this->returnApi(Code::PARAM_ERR,'部门下还有员工,不能删除');
        }
        $sectionList = SectionModel::find()
            ->where(['sectionId' => $id ])
            ->orWhere(['parentId' => $id ])
            ->andWhere(['isValid' => SectionModel::IS_VALID_OK])
            ->all();


        $section = null;
        $sectionChildren = [];
        if(!empty($sectionList)) {
            foreach ($sectionList as $value) {
                if($value['sectionId'] == $id){
                    $section = $value;
                } else {
                    $sectionChildren[] = $value;
                }
            }
        }

        if(empty($section)){
            return $this->returnApi(Code::PARAM_ERR,'部门编号错误');
        }

        if(!empty($sectionChildren)){
            return $this->returnApi(Code::PARAM_ERR,'存在下级不能删除');
        }

        $section -> isValid = SectionModel::IS_VALID_NO ;
        if(!$section->save()){
            return $this->returnApi(Code::PARAM_ERR,'删除失败');
        }

        return $this->returnApi(Code::SUCCESS,'删除成功');
    }
}