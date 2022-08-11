<?php
/**
 * Created by cqj
 * User: cqj
 * Date: 2019/10/31
 * Time: 10:34
 */

namespace frontend\actions\basics;


use frontend\actions\WxAction;
use common\library\helper\Code;
use common\models\system\basis\BasisModel;
use yii\helpers\Json;

class TypeListAction extends WxAction
{
    public function run() {
        \Yii::info('basics/type-list' . Json::encode($this->request()->post(),true));
        return $this->returnApi(Code::SUCCESS,'ok',BasisModel::getTypeList());
    }
}