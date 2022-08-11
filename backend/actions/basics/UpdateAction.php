<?php
/**
 * Created by cqj
 * User: cqj
 * Date: 2019/10/25
 * Time: 14:35
 */

namespace backend\actions\basics;


use backend\actions\BaseAction;
use common\models\system\basis\BasisForm;
use yii\helpers\Json;

class UpdateAction extends BaseAction
{
    public function run() {
        \Yii::info('basics/update' . Json::encode($this->request()->post(),true));
        $model = new BasisForm();
        $model->attributes = \Yii::$app->request->post();
        $model->basisId = \Yii::$app->request->post('basisId');
        $model->type = \Yii::$app->request->post('type');
        $model->name = \Yii::$app->request->post('name');
        $ret = $model->update();
        return $this->returnApi($ret['code'],$ret['msg']);
    }
}