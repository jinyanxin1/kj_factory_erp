<?php
/**
 * Created by cqj
 * User: cqj
 * Date: 2019/10/24
 * Time: 14:45
 */

namespace frontend\actions\section;


use frontend\actions\WxAction;
use common\library\helper\Code;
use common\models\system\section\SectionForm;
use common\models\system\section\SectionModel;
use Yii;
use yii\helpers\Json;

class InsertAction extends WxAction
{
    public function run() {
        \Yii::info('section/insert' . Json::encode($this->request()->post(),true));
        $model = new SectionForm();

        $model->attributes = \Yii::$app->request->post();
        $model->parentId = $this->request()->post('parentId',0);
        $model->name = trim($this->request()->post('name'));
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

        $section = new SectionModel();
        $section -> name = trim($this->request()->post('name'));
        $section -> parentId = $this->request()->post('parentId');
        $section -> staffId = $this->request()->post('staffId');
        $section -> abbreviation = $this->request()->post('abbreviation');
        $section -> isCompany = $this->request()->post('isCompany');
        $section -> startTime = $this->request()->post('startTime');
        $section -> code = $this->request()->post('code');

        if(!$section->save()) {
            return $this->returnApi(Code::PARAM_ERR,'新增失败');

        }

        return $this->returnApi(Code::SUCCESS,'新增成功');

    }
}
