<?php
/**
 * Created by cqj
 * User: cqj
 * Date: 2019/10/25
 * Time: 14:57
 */

namespace frontend\actions\basics;


use frontend\actions\WxAction;
use common\models\system\basis\BasisForm;
use yii\helpers\Json;

class DelAction extends WxAction
{
    public function run() {
        \Yii::info('basics/del' . Json::encode($this->request()->post(),true));
        $model = new BasisForm();
        $model->attributes = \Yii::$app->request->post();
        $model->basisId = \Yii::$app->request->post('basisId');
        $ret = $model->del();
        return $this->returnApi($ret['code'],$ret['msg']);
    }
}