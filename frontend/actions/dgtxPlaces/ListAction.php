<?php

namespace frontend\actions\dgtxPlaces;

/**
* Created by cqj
* User: cqj
* Date: 2020-07-02
* Time: 09:28
* 列表
*/
use common\models\system\dgtxPlaces\DgtxPlacesForm;
use common\library\helper\Code;
use frontend\actions\WxAction;

class ListAction extends WxAction
{
	public function run() {
		$model = new DgtxPlacesForm() ;
		$list = [] ;
		//TODO 具体情况接收条件参数
        $model->ctype = $this->request()->post('ctype') ;
        $model->id = $this->request()->post('id') ;
        $where = [] ;
        if (empty($model->id)) {
            $where[] = [
                'ctype' => 1
            ];
        } else {
            $where[] = [
                'parent_id' => $model->id
            ];
        }
		$ret = $model->getPage($where) ;
		$data = isset($ret['list']) ? $ret['list'] : [] ;
		$count = isset($ret['count']) ? $ret['count'] : 0 ;
		if (!empty($data)) {
			$list = $model->formatPage() ;
		}
		$pageInfo = $this->getPageInfo($count, $model->pageSize, $model->page) ;
		return $this->returnApi(Code::SUCCESS, 'ok', [ 'list' => $list , 'pageInfo' => $pageInfo ]) ;
	}
}