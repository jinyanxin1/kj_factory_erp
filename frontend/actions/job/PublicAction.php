<?php
/**
 * User: cqj
 * Date: 2020/7/7
 * Time: 3:57 下午
 */

namespace frontend\actions\job;


use frontend\actions\WxAction;
use common\library\helper\Code;
use common\models\jobInfo\JobInfoForm;

class PublicAction extends WxAction
{
    public function run() {
        $model = new JobInfoForm() ;
        $list = [] ;
        //TODO 具体情况接收条件参数
        $model->attributes = $this->request()->post() ;
        $model->page = intval(\Yii::$app->request->post('page', 1)) ;
        $model->pageSize = intval(\Yii::$app->request->post('pageSize', 10)) ;
        $model->sex = intval(\Yii::$app->request->post('sex',-1)) ;
        $model->skillId = \Yii::$app->request->post('skillId'); ;
        $model->name = trim(\Yii::$app->request->post('name'));

        $ret = $model->getPublic() ;
        $data = isset($ret['list']) ? $ret['list'] : [] ;
        $count = isset($ret['count']) ? $ret['count'] : 0 ;
        if (!empty($data)) {
            $list = $model->formatPage() ;
        }
        $pageInfo = $this->getPageInfo($count, $model->pageSize, $model->page) ;
        return $this->returnApi(Code::SUCCESS, 'ok', [ 'list' => $list , 'pageInfo' => $pageInfo ]) ;
    }
}