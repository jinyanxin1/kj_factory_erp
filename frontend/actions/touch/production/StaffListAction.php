<?php
/**
 *
 * author: jinyanxin
 * Date: 2020/11/23
 * Time: 11:20
 * PHP version 7
 */

namespace frontend\actions\touch\production;


use common\library\helper\Code;
use common\models\adminGroup\AdminGroupModel;
use common\models\staffInfo\StaffInfoModel;
use frontend\actions\BaseAction;

class StaffListAction extends BaseAction
{

    public function run()
    {
        $page = intval($this->request()->post('page',1));
        $pageSize = intval($this->request()->post('pageSize',10));

        $model = StaffInfoModel::find()->where(['isValid'=>StaffInfoModel::IS_VALID_OK]);
        //todo 获取生产岗位的id
        $groupId = AdminGroupModel::getProduction();

        $loginGroup = AdminGroupModel::find()->where(['groupId'=>$this->loginGroupId,'isValid'=>AdminGroupModel::IS_VALID_OK])->asArray()->one();
        if(empty($loginGroup)){
            return $this->returnApi(Code::PARAM_ERR,'权限不足');
        }
        if($loginGroup['roleType'] == AdminGroupModel::ROLE_TYPE_ONE){
            $model->andWhere(['staffId'=>$this->staffId]);
        }
        $model->andWhere(['positionId'=>$groupId]);


        $count = $model->count();
        $data = $model->offset(($page - 1) * $pageSize)->limit('pageSize')->asArray()->all();
        $returnList = [];
        if(count($data) > 0){
            $position = array_unique(array_column($data,'positionId'));
            $group = AdminGroupModel::find()->select('groupId,groupName')->where(['groupId'=>$position,'isValid'=>AdminGroupModel::IS_VALID_OK])->indexBy('groupId')->asArray()->all();
            foreach ($data as $datum) {
                $returnList [] = [
                    'staffId'=>$datum['staffId'],
                    'name'=>$datum['name'],
                    'jobNumber'=>$datum['jobNumber'],
                    'groupName'=>isset($group[$datum['positionId']]) ? $group[$datum['positionId']]['groupName'] : ''
                ];
            }
        }
        return $this->returnApi(Code::SUCCESS,'ok',[
            'list'=>$returnList,
            'pageInfo'=>$this->getPageInfo($count,$pageSize,$page)
        ]);
    }

}