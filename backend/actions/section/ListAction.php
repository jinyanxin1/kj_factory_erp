<?php
/**
 * Created by cqj
 * User: cqj
 * Date: 2019/10/24
 * Time: 11:26
 * 列表
 */

namespace backend\actions\section;

use backend\actions\BaseAction;
use common\library\helper\Code;
use common\models\system\section\SectionForm;
use yii\helpers\Json;

class ListAction extends BaseAction
{
    public function run() {
        \Yii::info('section/list' . Json::encode($this->request()->post(),true));
        //todo 按学校和校区选择部门(上级ID)
        //上级Id
//        $this->campusId = $this->request()->post("campusId") ;
        $model = new SectionForm();
        $data = $model->getList();
        $ret = [] ;
        $ret = $data ;
        return $this->returnApi(Code::SUCCESS, 'ok',
            array('list' => $ret));
    }
}