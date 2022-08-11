<?php
/**
 * Created by cqj
 * User: cqj
 * Date: 2019/10/25
 * Time: 11:03
 * 新增
 */

namespace frontend\actions\basics;

use frontend\actions\WxAction;
use common\models\system\basis\BasisForm;
use yii\helpers\Json;

class InsertAction extends WxAction
{
    public function run() {
        \Yii::info('basics/insert' . Json::encode($this->request()->post(),true));
        $model = new BasisForm();
        $model->attributes = \Yii::$app->request->post();
        $model->type = \Yii::$app->request->post('type');
        $model->name = \Yii::$app->request->post('name');
        $ret = $model->insert();
        return $this->returnApi($ret['code'],$ret['msg'],$ret['msg']);
    }
}