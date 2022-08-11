<?php

namespace frontend\actions\clientInfo;

/**
* Created by cqj
* User: cqj
* Date: 2020-07-10
* Time: 09:48
* 修改
*/
use common\models\clientInfo\ClientInfoForm;
use common\library\helper\Code;
use frontend\actions\WxAction;

class SaveAction extends WxAction
{
	public function run() {
		$model = new ClientInfoForm() ;
		//TODO 具体情况接收参数
		$model->attributes = $this->request()->post() ;
		$model->clientId = $this->request()->post('clientId') ;
		$model->name = $this->request()->post('name') ;
		$model->type = $this->request()->post('type') ;
		$model->staffId = $this->request()->post('staffId') ;
		$model->industryId = $this->request()->post('industryId') ;
//		$model->provinceId = $this->request()->post('provinceId') ;
//		$model->cityId = $this->request()->post('cityId') ;
//		$model->areaId = $this->request()->post('areaId') ;
        $model->area = $this->request()->post('area') ;
        $model->price = $this->request()->post('price') ;
        $model->logo = $this->request()->post('logo') ;
        $model->tell = $this->request()->post('tell') ;
		$model->address = $this->request()->post('address') ;
		$model->introduction = $this->request()->post('introduction') ;
		$model->website = $this->request()->post('website') ;
        $model->range = $this->request()->post('range') ;
		$ret = $model->update() ;
		return $this->returnApi($ret['code'], $ret['msg']) ;
	}
}