<?php
/**
 * Created by cqj
 * User: cqj
 * Date: 2019/10/24
 * Time: 15:16
 */

namespace backend\actions\section;


use backend\actions\BaseAction;
use common\library\helper\Code;
use common\models\system\section\SectionForm;
use common\models\system\section\SectionModel;
use yii\helpers\Json;

class UpdateAction extends BaseAction
{
    public function run() {
        \Yii::info('section/update' . Json::encode($this->request()->post(),true));
        $id = $this->request()->post('sectionId');
        if(empty($id)){
            return $this->returnApi(Code::PARAM_ERR,'id不能为空');
        }
        $model = new SectionForm();
        $model->attributes = \Yii::$app->request->post();
        $model->sectionId = $id;
        $model->parentId = $this->request()->post('parentId');
        $model->name = $this->request()->post('name');
        $model->staffId = trim($this->request()->post('staffId'));
        $model->abbreviation = trim($this->request()->post('abbreviation'));
        $model->isCompany = trim($this->request()->post('isCompany'));
        $model->startTime = trim($this->request()->post('startTime'));
        $model->code = trim($this->request()->post('code'));

        if(!$model->validate()){
            $firstItem = $model->getErrors();
            foreach ($firstItem as $value) {
                return $this->returnApi(Code::PARAM_ERR,$value[0]);
            }
        }

        $section = SectionModel::getInfo($id);
        $section ->name = trim($this->request()->post('name'));
        $section ->parentId = $this->request()->post('parentId');
        $section -> staffId = $this->request()->post('staffId');
        $section -> abbreviation = $this->request()->post('abbreviation');
        $section -> isCompany = $this->request()->post('isCompany');
        $section -> startTime = $this->request()->post('startTime');
        $section -> code = $this->request()->post('code');
        if(!$section->save()) {
            return $this->returnApi(Code::PARAM_ERR,'修改失败');

        }
        return $this->returnApi(Code::SUCCESS,'修改成功');
    }
}