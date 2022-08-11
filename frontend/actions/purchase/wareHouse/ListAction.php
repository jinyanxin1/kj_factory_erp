<?php
/**
 * @Author: jinyanxin
 * @Date: 2020/1/7
 * @Time: 10:20
 * 仓库列表
 */


namespace frontend\actions\purchase\wareHouse;


use frontend\actions\WxAction;
use common\library\helper\Code;
use common\models\warehouse\WarehouseModel;

class ListAction extends WxAction
{

    public function run()
    {
        $page = intval($this->request()->post('page',1));
        $pageSize = intval($this->request()->post('pageSize',10));

        $data = WarehouseModel::find()
            ->where(['isValid'=>WarehouseModel::IS_VALID_OK])
            ->orWhere(['type'=>WarehouseModel::ZONG_HOUSE,'isValid'=>WarehouseModel::IS_VALID_OK]);
        $count = $data->count();
        $model = $data->offset(($page-1)*$pageSize)->limit($pageSize)->orderBy('createTime desc')->asArray()->all();
        $showList = WarehouseModel::formate($model);
        return $this->returnApi(Code::SUCCESS,'ok',[
            'showList'=>$showList,
            'pageInfo'=>$this->getPageInfo($count,$pageSize,$page)
        ]);
    }

}