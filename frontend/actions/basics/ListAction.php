<?php
/**
 * Created by cqj
 * User: cqj
 * Date: 2019/10/25
 * Time: 10:02
 */
namespace frontend\actions\basics;

use frontend\actions\WxAction;
use common\library\helper\Code;
use common\models\system\basis\BasisModel;
use yii\helpers\Json;

class ListAction extends WxAction
{
    public function run() {
        \Yii::info('basics/list' . Json::encode($this->request()->post(),true));
        $type = $this->request()->post('type');
        $data = BasisModel::getList($type);
        return $this->returnApi(Code::SUCCESS,'ok',$data);
    }
}