<?php
/**
 * 所有接口
* Created by PhpStorm.
 * User: zhouk
 * Date: 2019/8/1
 * Time: 11:43
 */

namespace backend\actions\group;


use backend\actions\BaseAction;
use common\library\helper\Code;
use common\models\admin\AdminModel;
use common\models\adminGroup\AdminGroupBackend;
use common\models\adminGroup\AdminGroupModel;
use common\models\advancedConfig\AdvancedConfigModel;
use Yii;

class AllAction extends BaseAction
{

    public function run(){
        $query = AdminGroupBackend::find()->where([
            'isValid' => AdminGroupBackend::IS_VALID_OK
        ]);

        $dataList = $query
            ->asArray()
            ->orderBy('groupId desc')
            ->all();
        foreach ($dataList as $key => $value){
            $dataList[$key]['groupId'] = intval($dataList[$key]['groupId']);
            $dataList[$key]['parentId'] = intval($dataList[$key]['parentId']);
            $dataList[$key]['isValid'] = intval($dataList[$key]['isValid']);
        }
        return $this->returnApi(Code::SUCCESS, 'ok',
            [
                'list' => $dataList ,
            ]);
    }

}