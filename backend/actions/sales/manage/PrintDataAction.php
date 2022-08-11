<?php
/**
 *
 * author: jinyanxin
 * Date: 2020/11/23
 * Time: 10:07
 * PHP version 7
 */

namespace backend\actions\sales\manage;


use backend\actions\BaseAction;
use common\library\helper\Code;
use common\models\clientInfo\ClientInfoModel;
use common\models\clientPerson\ClientPersonModel;
use common\models\goods\GoodsModel;
use common\models\salesOrder\SalesOrderDetailModel;
use common\models\salesOrder\SalesOrderModel;
use common\models\system\printTemplates\PrintTemplatesForm;
use common\models\workingProcedure\GoodsWorkingProcedureModel;

class PrintDataAction extends BaseAction
{

    public function run()
    {
        $orderId = intval($this->request()->post('orderId'));
        $type = intval($this->request()->post('type',1));
        if($orderId <= 0){
            return $this->returnApi(Code::PARAM_ERR,'请选择订单');
        }
        $orderInfo = SalesOrderModel::find()->where(['id'=>$orderId,'isValid'=>SalesOrderModel::IS_VALID_OK])->asArray()->one();
        if(empty($orderInfo)){
            return $this->returnApi(Code::PARAM_ERR,'打印订单不存在');
        }
        $clientAddress = $orderInfo['clientAddress'];
        $detail = SalesOrderDetailModel::find()->where(['orderId'=>$orderId,'isValid'=>SalesOrderDetailModel::IS_VALID_OK])->asArray()->all();
        //发货方式
        $sendWay = !empty($orderInfo['sendWay']) ? $orderInfo['sendWay'] : '';
        //收货单位
        $client = ClientInfoModel::find()->where(['clientId'=>$orderInfo['clientId'],'isValid'=>ClientInfoModel::IS_VALID_OK])->asArray()->one();
        if(empty($client)){
            return $this->returnApi(Code::PARAM_ERR,'客户不存在');
        }
        $clientPerson = ClientPersonModel::find()->select('name,tell')->where(['personId'=>$orderInfo['clientPersonId'],'isValid'=>ClientPersonModel::IS_VALID_OK])->asArray()->one();
        if(empty($clientPerson)){
            $clientPersonName = '';
            $clientPersonTell = '';
        }else{
            $clientPersonName = $clientPerson['name'];
            $clientPersonTell = $clientPerson['tell'];
        }
        $clientName = !empty($client['name']) ? $client['name'] : '';
        //产品详情
        $goodsList = [];
        $goods = GoodsModel::find()->where(['id'=>array_column($detail,'goodsId')])->indexBy('id')->asArray()->all();
        $working = GoodsWorkingProcedureModel::find()->where(['id'=>array_column($detail,'workingId')])->indexBy('id')->asArray()->all();
        $sum = 0;
        foreach ($detail as $key=>$item) {
            if(isset($goods[$item['goodsId']])){
                $sum += $item['num'];
                $goodsInfo = $goods[$item['goodsId']];
                $workingInfo = isset($working[$item['workingId']]) ? $working[$item['workingId']] : '';
                $goodsName = !empty($goodsInfo['name']) ? $goodsInfo['name'] : '';
                $goodsName = !empty($goodsName) && !empty($workingInfo) ? $goodsName.'-'.$workingInfo['name'] : $goodsName;
                $goodsList[] = [
                    'sort'=>$key + 1,
                    'goodsName'=>$goodsName,
                    'unit'=>!empty($goodsInfo['unit']) ? $goodsInfo['unit'] : '',
                    'num'=>$item['num'],
                    'attr'=>!empty($goodsInfo['attr']) ? $goodsInfo['attr'] : '',
                    'remark'=>!empty($goodsInfo['remark']) ? $goodsInfo['remark'] : '',
                    'contact'=>'',
                    'tell'=>''
                ];
            }
        }
        //打印数据
        $templatesDataInfo = [
            'sendWay'=>$sendWay,
            'clientName'=>$clientName,
            'sum'=>$sum,
            'date'=>date('Y年m月d日'),
            'contacts'=>$clientPersonName,
            'tell'=>$clientPersonTell,
            'clientAddress'=>$clientAddress,//发货地址
            'number'=>$orderInfo['number'],//订单编号
        ];
        //获取打印模板
        $printTemplates = new PrintTemplatesForm();
        $printTemplates->type = $type;
        $templatesInfo = $printTemplates->getInfo();
        $h5=$templatesInfo['h5'];

        foreach ($templatesDataInfo as $infoKey=>$infoVal){
            $h5=str_replace('{'.$infoKey.'}',$infoVal,$h5);
        }
        $trStart = strpos($h5,'<tr class="start-loop">');
        $trEnd = strpos($h5,'<tr class="end-tr">');
        $printListTemplates=substr($h5, $trStart,$trEnd-$trStart);
        $printListTemplatesData='';
        if(count($goodsList) > 0){
            foreach ($goodsList as $odiKey=>$odiVal){
                $listdate=$printListTemplates;
                \Yii::info('----------打印订单 orderInfo'.print_r($odiVal,true));
                $templatesDataInfoList=array(
                    'sort'             => $odiVal['sort'],  //序号
                    'goodsName'  => $odiVal['goodsName'],  //产品名称
                    'attr'       => $odiVal['attr'],  //规格型号
                    'unit'         => $odiVal['unit'],  //单位
                    'num'                => $odiVal['num'],  //数量
                    'remark'=>$odiVal['remark'],//备注
                );
                \Yii::info('-------打印订单templatesDataInfoList '.print_r($templatesDataInfoList,true));
                foreach ($templatesDataInfoList as $infoKey=>$infoVal){
                    $listdate=str_replace('{'.$infoKey.'}',$infoVal,$listdate);
                }
                $printListTemplatesData.=$listdate;
            }
        }
        $h5=str_replace($printListTemplates,$printListTemplatesData,$h5);
        return $this->returnApi(Code::SUCCESS, 'ok',['info'=>$h5]);
    }

}