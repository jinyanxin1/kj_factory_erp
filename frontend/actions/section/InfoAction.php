<?php
/**
 * Created by cqj
 * User: cqj
 * Date: 2019/10/24
 * Time: 11:42
 * 查看详情
 */


namespace frontend\actions\section;


use frontend\actions\WxAction;
use common\library\helper\Code;
use common\models\system\section\SectionModel;
use yii\helpers\Json;

class InfoAction extends WxAction
{
    public function run() {
        \Yii::info('section/info' . Json::encode($this->request()->post(),true));
        $id = $this->request()->post('sectionId');

        if(empty($id)){
            return $this->returnApi(Code::PARAM_ERR,'请传入部门编号');
        }
        $info = SectionModel::find()
            ->where(['sectionId' => $id , 'isValid' => SectionModel::IS_VALID_OK])
            ->asArray()
            ->one();
        $parentName = SectionModel::getInfo($info['parentId']);
        $info['parentName'] = !empty($parentName) ? $parentName->name : '';
        $info['sectionId'] = intval($info['sectionId']);
        $info['parentId'] = intval($info['parentId']);
        return $this->returnApi(Code::SUCCESS,'ok' , $info);
    }
}