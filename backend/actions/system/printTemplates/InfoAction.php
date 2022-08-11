<?php
/**
 *
 * author: jinyanxin
 * Date: 2020/11/23
 * Time: 10:12
 * PHP version 7
 */

namespace backend\actions\system\printTemplates;


use backend\actions\BaseAction;
use common\library\helper\Code;
use common\models\system\printTemplates\PrintTemplatesForm;

class InfoAction extends BaseAction
{

    public function run()
    {
        $type = intval($this->request()->post('type',1));
        $format = intval($this->request()->post('format',1));

        $print = new PrintTemplatesForm();
        $print->type = $type;
        $print->format = $format;
        $info = $print->getInfo();
        $infoList = [
            'BaseInfo'=>[
                ['value'=>'number','name'=>'订单编号'],
                ['value'=>'clientAddress','name'=>'客户地址'],
                ['value'=>'sendWay','name'=>'发货方式'],
                ['value'=>'clientName','name'=>'收货单位'],
                ['value'=>'payCompany','name'=>'收货方式'],
                ['value'=>'sort','name'=>'序号'],
                ['value'=>'goodsName','name'=>'产品名称'],
                ['value'=>'unit','name'=>'单位'],
                ['value'=>'num','name'=>'数量'],
                ['value'=>'attr','name'=>'规格编号'],
                ['value'=>'remark','name'=>'备注'],
                ['value'=>'sum','name'=>'合计'],
                ['value'=>'date','name'=>'日期'],
                ['value'=>'contacts','name'=>'联系人'],
                ['value'=>'tell','name'=>'手机']
            ],
        ];
        return $this->returnApi(Code::SUCCESS,'ok',['info'=>$info,'infoList'=>$infoList]);
    }

}