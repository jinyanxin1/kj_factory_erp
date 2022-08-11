<?php

namespace frontend\actions\industry;

/**
* Created by cqj
* User: cqj
* Date: 2020-07-17
* Time: 10:31
* 删除
*/
use common\models\industry\IndustryForm;
use common\library\helper\Code;
use frontend\actions\WxAction;

class DeleteAction extends WxAction
{
	public function run() {
		$model = new IndustryForm() ;
		$model->attributes = $this->request()->post() ;
		$model->industryId = intval(\Yii::$app->request->post('industryId')) ;
		$ret = is_array($model->industryId) ? $model->delBatch() : $model->del() ;
		return $this->returnApi($ret['code'], $ret['msg']) ;
	}
}