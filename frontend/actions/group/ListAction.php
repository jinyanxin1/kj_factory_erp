<?php
/**
 * 查询列表
 * Created by PhpStorm.
 * User: zhouk
 * Date: 2019/8/1
 * Time: 11:43
 */

namespace frontend\actions\group;


use frontend\actions\WxAction;
use common\library\helper\Code;
use common\models\admin\AdminModel;
use common\models\adminGroup\AdminGroupfrontend;
use common\models\adminGroup\AdminGroupModel;
use common\models\advancedConfig\AdvancedConfigModel;
use Yii;

class ListAction extends WxAction
{

    public function run(){
       $page = intval($this->request()->post('page', 1));
       $pageSize = intval($this->request()->post('pageSize', 10));
//        $sectionId = $this->request()->post('sectionId');

        //搜索条件
        $name = $this->request()->post('groupName');

        $query = AdminGroupfrontend::find()->where([
            'isValid' => AdminGroupfrontend::IS_VALID_OK,
//            'sectionId' => $sectionId
        ]);

       if(!empty($name)){
           $query->andWhere(['like', 'groupName', $name]);
       }

        $count = $query->count();
        $dataList = $query
           ->offset(intval(($page - 1) * $pageSize))
           ->limit($pageSize)
            ->asArray()
            ->orderBy('groupId desc')
            ->all();
        foreach ($dataList as $key => $value){
            $dataList[$key]['groupId'] = intval($dataList[$key]['groupId']);
            $dataList[$key]['parentId'] = intval($dataList[$key]['parentId']);
            $dataList[$key]['isValid'] = intval($dataList[$key]['isValid']);
//            $dataList[$key]['sectionId'] = intval($dataList[$key]['sectionId']);
        }
        $pageInfo = $this->getPageInfo($count , $pageSize , $page);
        return $this->returnApi(Code::SUCCESS, 'ok', 
            [
                'list' => $dataList ,
                'pageInfo' => $pageInfo,
            ]);
    }

}