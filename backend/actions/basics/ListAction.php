<?php
/**
 * Created by cqj
 * User: cqj
 * Date: 2019/10/25
 * Time: 10:02
 */
namespace backend\actions\basics;

use backend\actions\BaseAction;
use common\library\helper\Code;
use common\models\system\basis\BasisModel;
use yii\helpers\Json;

class ListAction extends BaseAction
{
    public function run() {
        \Yii::info('basics/list' . Json::encode($this->request()->post(),true));
        $type = $this->request()->post('type');
        $data = BasisModel::getList($type);
        return $this->returnApi(Code::SUCCESS,'ok',$data);
    }
}