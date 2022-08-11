<?php
/**
 * User: cqj
 * Date: 2020/9/18
 * Time: 10:05 上午
 */

namespace backend\actions\group;


use backend\actions\BaseAction;
use common\library\helper\Code;
use common\models\adminGroup\AdminGroupBackend;
use common\models\adminGroup\AdminGroupModel;

class SelectAction extends BaseAction
{
    public function run(){
        $query = AdminGroupBackend::find()->where([
            'isValid' => AdminGroupBackend::IS_VALID_OK,
//            'sectionId' => $sectionId
        ]);
        $dataList = $query
            ->asArray()
            ->orderBy('groupId desc')
            ->all();
        foreach ($dataList as $key => $value){
            $dataList[$key]['groupId'] = intval($dataList[$key]['groupId']);
            $dataList[$key]['parentId'] = intval($dataList[$key]['parentId']);
            $dataList[$key]['isValid'] = intval($dataList[$key]['isValid']);
            $dataList[$key]['roleType'] = intval($dataList[$key]['roleType']);
            $dataList[$key]['roleTypeName'] = isset(AdminGroupModel::$ROLE_TYPE[$dataList[$key]['roleType']]) ?
                AdminGroupModel::$ROLE_TYPE[$dataList[$key]['roleType']] : '' ;
        }
        $select = AdminGroupBackend::formatSelect($dataList);
        return $this->returnApi(Code::SUCCESS, 'ok',
            [
                'list' => $select ,
            ]);
    }
}