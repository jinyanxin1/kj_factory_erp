<?php
/**
 * Created by Eclipse.
 * User: ziv
 * Date: 2019/9/8 
 * Time: 15:53
 */

namespace common\kjlib\weixinSmallprogram;


use common\kjlib\weixin\wxPay\wxPayNotifyForJs;
use common\models\order\OrderFrontend;
use common\models\orderUnion\OrderUnionFrontend;
use common\models\ptOrder\PtOrderFrontend;
use common\models\ptGoods\PtGoodsFrontend;
use common\models\sysConfig\SysConfigModel;
use common\models\user\UserModel;
use common\models\commission\CommissionModel;
class wxSmallProgramPayCallBack extends wxPayNotifyForJs
{
    //查询订单
    public function Queryorder($transaction_id)
    {
        $input = new \WxPayOrderQuery();
        $input->SetTransaction_id($transaction_id);
        $result = \WxPayApi::orderQuery($input);
        \Yii::info("query(支付回调):" . json_encode($result),'pay');
        if( ($result['code'] == 0) && !empty($result['params']) ){
            $result = $result['params'];
            if(array_key_exists("return_code", $result)
                && array_key_exists("result_code", $result)
                && $result["return_code"] == "SUCCESS"
                && $result["result_code"] == "SUCCESS")
            {
                return true;
            }
        }
        return false;
    }
    
    
    
    /*
     * 重写回调处理函数
     * */
    public function NotifyProcess($data, &$msg)
    {
        \Yii::warning('pay-success-call_back-start(进入到重写回调处理函数)','pay');
        \Yii::warning("pay-success-call_back-start-data:" . json_encode($data),'pay');
        
        if(!array_key_exists("transaction_id", $data)){
            \Yii::warning('pay-success-call_back-fail(输入参数不正确)','pay');
            return false;
        }
        
        //查询订单，判断订单真实性
        if(!$this->Queryorder($data["transaction_id"])){
            \Yii::info('pay-success-call_back-fail(订单查询失败)','pay');
            return false;
        }
        
        if(array_key_exists("out_trade_no",$data)){
            
            \Yii::warning('支付成功返回来的回调数据:' . json_encode($data),'pay');
            \Yii::warning('pay-success_updateOrder_start start time:'.date('Y-m-d H:i:s'),'pay');
            //支付完成时间
            $timeEndChar = $data['time_end'];
            //将时间转化 返回的是个字符串 支付完成时间，格式为yyyyMMddHHmmss，如2009年12月25日9点10分10秒表示为20091225091010
            $timeEnd = date('Y-m-d H:i:s',strtotime($timeEndChar));
            
            //商户系统内部订单号
            $uniformOrderNo = $data['out_trade_no'];//订单支付记录表中的uniformOrderNo

            //微信支付的订单号
            $transactionId = $data['transaction_id'];
            
            //支付总金额
            $totalFee =intval($data['total_fee']);
            
            //用户openId
            $openId = $data['openid'];
            
            try{
                //查询出支付的订单详情
                $orderUnionInfo=OrderUnionFrontend::find()
                                ->where(
                                    [
                                        'uniformOrderNo'=>$uniformOrderNo,
                                        'isPay'=>0,
                                        'isValid'=>OrderUnionFrontend::IS_VALID_OK
                                        
                                    ]
                                )
                                ->one();
            
                if(!empty($orderUnionInfo)){
                    $orderType=$orderUnionInfo->type;//订单类型0--商城订单 1--秒杀订单 2--拼团订单 3--预约订单4--砍价订单
                    if($orderType==0 || $orderType==4){
                        //商城订单，砍价订单
                        $orderTpeName=$orderType==0?'商城':'砍价';//订单类型名称
                        \Yii::warning('pay-success_updateOrder_info:支付的是'.$orderTpeName.',订单id:'.$orderUnionInfo->orderId,'pay');
                        //根据商户内部订单号找到订单
                        $orderInfo= OrderFrontend::find()->where(['id'=>$orderUnionInfo->orderId,'isPay'=>0])->one();
                        
                        
                        //修改订单状态为已支付，将支付单号加入到订单中，
                        $orderInfo->isPay=1;
                        $orderInfo->payNo=$transactionId;
                        
                        if(!$orderInfo->save()){
                            \Yii::warning('pay-success_updateOrder_Fail:支付'.$orderTpeName.'订单,订单id:'.$orderUnionInfo->orderId.'修改订单失败','pay');
                            return false;
                        };
                        
                        
                        $orderUnionInfo->payNo=$transactionId;
                        $orderUnionInfo->isPay=1;
                        $orderUnionInfo->payTime=$timeEnd;
                        $orderUnionInfo->price=$totalFee;
                        
                        if(!$orderUnionInfo->save()){
                            \Yii::warning('pay-success_updateOrder_Fail:支付'.$orderTpeName.'订单,订单id:'.$orderUnionInfo->orderId.'修改订单支付记录失败','pay');
                            return false;
                        };
                        
                    }else if($orderType==2){
                        //拼团订单
                        \Yii::warning('pay-success_updateOrder_info:支付的是拼团订单,订单id:'.$orderUnionInfo->orderId,'pay');
                        $orderInfo= PtOrderFrontend::find()
                                    ->where(['id'=>$orderUnionInfo->orderId,'isPay'=>0])
                                    ->one();
                        
                        //拼团商品详情
                        $ptGoodsInfo=PtGoodsFrontend::find()
                                    ->select('id,goodsId,storeId,price ptPrice,groupNum,purChaseLimit,headsmoney')
                                    ->where(['id'=>$orderInfo->ptGoodsId])
                                    ->asArray()
                                    ->one();
                        
                        $ptOrderCount=0;//该拼团有多少人在拼团中
                        
                        //如果parentId不为0有值则验证上级是否有效
                        if(!empty($orderInfo->parentId)){
                            //查询团长订单详情，已经付款，不是自己的订单，还未成团，未失败，团长单，时间未过期,未删除
                            $ptOrderInfo=PtOrderFrontend::find()
                                        ->where(['id'=>$orderInfo->parentId,'isValid'=>PtOrderFrontend::IS_VALID_OK])
                                        ->andWhere(['isPay'=>1])
                                        ->andWhere(['isSuccess'=>0])
                                        ->andWhere(['isFail'=>0])
                                        ->andWhere(['parentId'=>0])
                                        ->asArray()
                                        ->one();
                            
                            //查询出该拼团的成员订单详情
                            $ptOrderList=PtOrderFrontend::find()
                                        ->where(['parentId'=>$ptOrderInfo['id'],'isValid'=>PtOrderFrontend::IS_VALID_OK])
                                        ->andWhere(['isPay'=>1])
                                        ->andWhere(['isSuccess'=>0])
                                        ->andWhere(['isFail'=>0])
                                        ->asArray()
                                        ->all();
                            
                            $ptOrderCount=intval(count($ptOrderList))+1+1;
                            
                            if($ptGoodsInfo['groupNum']==$ptOrderCount){
                                //拼团人数已达到拼团人数，将该拼团的成员订单都修改为拼团成功
                                \Yii::warning('pay-success_updateOrder_info:拼团订单,订单id:'.$orderUnionInfo->orderId.'支付后,该团达到拼团人数已成团','pay');
                                $orderIds=array_column($ptOrderList,'id');
                                $orderIds[]=$ptOrderInfo['id'];
                                $orderIds[]= $orderInfo->id;
                                $orderIds=array_values($orderIds);
                                PtOrderFrontend::updateAll(['isSuccess' => 1,'successTime'=>date('Y-m-d H:i:s')], ['in', 'id', $orderIds]);
                                
                                //将该拼团未付款的订单设为取消状态
                                $ptNoPayOrderList=PtOrderFrontend::find()
                                                ->where(['parentId'=>$ptOrderInfo['id'],'isValid'=>PtOrderFrontend::IS_VALID_OK])
                                                ->andWhere(['isPay'=>0])
                                                ->andWhere(['isSuccess'=>0])
                                                ->andWhere(['isFail'=>0])
                                                ->andWhere(['isCancel'=>0])
                                                ->asArray()
                                                ->all();
                                $noPayorderIds=array_column($ptNoPayOrderList,'id');
                                PtOrderFrontend::updateAll(['isCancel' => 1,'cancelTime'=>date('Y-m-d H:i:s')], ['in', 'id', $noPayorderIds]);
                                
                            }
                        }else{
                            if($ptGoodsInfo['groupNum']==1){
                                //拼团人数已达到拼团人数，将该拼团的成员订单都修改为拼团成功
                                \Yii::warning('pay-success_updateOrder_info:支付拼团订单,订单id:'.$orderUnionInfo->orderId.'支付后,该团达到拼团人数已成团','pay');
                                $orderIds=[$orderInfo->id];
                                PtOrderFrontend::updateAll(['isSuccess' => 1,'successTime'=>date('Y-m-d H:i:s')], ['in', 'id', $orderIds]);
                            }
                        }
                        
                        //修改订单状态为已支付，将支付单号加入到订单中，
                        
                        $orderInfo->isPay=1;
                        $orderInfo->payNo=$transactionId;
                        
                        if(!$orderInfo->save()){
                            \Yii::warning('pay-success_updateOrder_Fail:支付拼团订单,订单id:'.$orderUnionInfo->orderId.'修改订单失败','pay');
                            return false;
                        };
                        
                        
                        $orderUnionInfo->payNo=$transactionId;
                        $orderUnionInfo->isPay=1;
                        $orderUnionInfo->payTime=$timeEnd;
                        $orderUnionInfo->price=$totalFee;
                        
                        if(!$orderUnionInfo->save()){
                            \Yii::warning('pay-success_updateOrder_Fail:支付拼团订单,订单id:'.$orderUnionInfo->orderId.'修改订单支付记录失败','pay');
                            return false;
                        };
                    }
                    
                    //分佣
                    $payPrice=$orderInfo->payPrice;
                    $userId=$orderInfo->userId;
                    $schoolId=$orderInfo->schoolId;
                    
                    $sysConfig=SysConfigModel::find()
                                ->where([
                                    'schoolId'=>$schoolId,
                                    'commissionStatus'=>SysConfigModel::STATUS_ON,
                                    'isValid'=>SysConfigModel::IS_VALID_OK
                                ])
                                ->asArray()
                                ->one();
                    if(!empty($sysConfig)){
                        \Yii::warning('pay-success_Commission:开始分佣:'.print_r($sysConfig),'pay');
                        //现在只进行一级分佣
                        $userInfo=UserModel::find()->where(['userId'=>$userId])->asArray()->one();
                        \Yii::warning('pay-success_Commission:分佣用户详情:'.print_r($userInfo),'pay');
                        if($userInfo['userHigherUpsn']>0){
                            $returnCommission=$sysConfig['returnCommission']/100;
                            if($returnCommission>0){
                                if($returnCommission>1){
                                    $returnCommission=1;
                                }
                                \Yii::warning('pay-success_Commission:分佣金额:'.$payPrice*$returnCommission,'pay');
//                                 $commissionModel=new CommissionModel();
//                                 $commissionModel->money=$payPrice*$returnCommission;
//                                 $commissionModel->orderId=$orderInfo->id;
//                                 $commissionModel->userId=$userInfo['userHigherUpsn'];
//                                 $commissionModel->schoolId=$orderInfo->schoolId;
//                                 $commissionModel->status=0;
//                                 if($commissionModel->save()){
//                                     \Yii::warning('pay-success_Commission_Success:分佣成功','pay');
//                                 }else{
//                                     \Yii::warning('pay-success_Commission_Fail:分佣失败','pay');
//                                 };
                            }
                        }
                    }
                    
                    
                }else{
                    \Yii::warning('pay-success_updateOrder_Fail:未查询到支付信息表中的信息,uniformOrderNo:'.$uniformOrderNo,'pay');
                    return false;
                }
            
            }catch (\Exception $e) {
                \Yii::warning('pay-success_updateOrder_Fail:支付号uniformOrderNo:'.$uniformOrderNo.'修改订单系统错误','pay');
                return  false;
            }
            \Yii::warning('pay-success_updateOrder_end end time:'.date('Y-m-d H:i:s'),'pay');
            return true;
        }
        
        return false;
        
    }
    
}