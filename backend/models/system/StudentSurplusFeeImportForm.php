<?php
/**
 * @Author: jinyanxin
 * @Date: 2019/12/10
 * @Time: 8:32
 * 学员剩余费用导入
 */


namespace backend\models\system;


use common\library\helper\Code;
use common\models\BaseForm;
use common\models\course\CourseModel;
use common\models\order\OrderDetailModel;
use common\models\order\OrderModel;
use common\models\student\StudentCourseCountModel;
use common\models\student\StudentModel;
use common\models\system\BasicsModel;
use common\models\system\DataImportModel;
use common\models\system\SectionModel;
use common\models\user\UserModel;


class StudentSurplusFeeImportForm
{
    /*
     * 组织导入的数据，获取学员id，课程id，校区id等
     * */
    public static function import($data,$type)
    {
        \Yii::info('------------import xue yuan fee data--'.print_r($data,true));
        $returnArr = ['code'=>Code::SUCCESS,'msg'=>'ok','error'=>[]];
        if( count($data) <= 0 ){
            $returnArr['error'][] = '导入数据为空';
            return $returnArr;
        }
        //获取系统中学员的姓名，手机号，学员id；已学员姓名，手机号为键返回
        $studentIds = StudentModel::returnKeyStudentNameAndMobile();
        //获取所有课程，并且以课程名称为键返回
        $courseIds = CourseModel::returnKeyCourseName();
        //获取所有校区，已校区为键返回
        $campus = SectionModel::getCampus();
        $campusIds = count($campus) > 0 ? array_combine(array_column($campus,'name'),$campus) : [];
        //收费类型
        $basicsData = BasicsModel::getListByArr([
            BasicsModel::FeeCustType, //收费类型
        ]);
        $chargeType = $basicsData[BasicsModel::FeeCustType];
        $chargeTypeList = count($chargeType) > 0 ? array_combine(array_column($chargeType,'name'),$chargeType) : [];
        $emptyNum = 0;
        foreach( $data as $dataKey=>$dataInfo )
        {
            $dataKey = $dataKey+3;
            if( empty($dataInfo['studentName']) || empty($dataInfo['mobile']) || empty($dataInfo['courseName']) || empty($dataInfo['belongToCampus']) || empty($dataInfo['attendToCampus']) || empty($dataInfo['chargeType']) ){
                if(empty($dataInfo['studentName']) && empty($dataInfo['mobile']) && empty($dataInfo['courseName']) && empty($dataInfo['belongToCampus']) && empty($dataInfo['attendToCampus']) && empty($dataInfo['chargeType']) ){
                    $emptyNum++;
                    continue;
                }
                \Yii::info('------------student surplus fee import form error--'.$dataKey.'--dataInfo empty-emptyData:'.print_r($dataInfo,true),'importFee');
                $returnArr['error'][] =  '第'.$dataKey.'行的数据必填项不全';
                continue;
            }
            $studentKey = $dataInfo['studentName'].'-'.$dataInfo['mobile'];
            \Yii::info('-----------excel import save studentKey'.$studentKey,'importFee');
            if( !isset($studentIds[$studentKey]) ){
                \Yii::info('------------student surplus fee import form error--'.$dataKey.'--student no exit','importFee');
                $returnArr['error'][] = '第'.$dataKey.'行的学员不存在';
                continue;
            }
            $campusId = $studentIds[$studentKey]['campusId'];
            if( (!isset($campusIds[$dataInfo['belongToCampus']])) || (!isset($campusIds[$dataInfo['attendToCampus']])) ){
                \Yii::info('------------student surplus fee import form error--'.$dataKey.'--campus no exit','importFee');
                $returnArr['error'][] = '第'.$dataKey.'行的校区不存在';
                continue;
            }
            $dataInfo['surplusFee'] = intval($dataInfo['surplusFee'] * 100 ) ;//单位转为分
            $dataInfo['surplusNum'] = intval($dataInfo['surplusNum']);
            $userId = $studentIds[$studentKey]['userId'];
            $dataInfo['userId'] = $userId;
            //根据配置得到课程id，所属校区id，经办校区id
            $dataInfo['belongToCampusId'] = $campusIds[$dataInfo['belongToCampus']]['sectionId'];
            $dataInfo['attendToCampusId'] = $campusIds[$dataInfo['attendToCampus']]['sectionId'];
            if(intval($dataInfo['belongToCampusId']) !== intval($campusId)){
                \Yii::info('------------student surplus fee import form error--'.$dataKey.'--campus no pi pei','importFee');
                $returnArr['error'][] = '第'.$dataKey.'行的校区与学员不匹配';
                continue;
            }
            //学校id
            $dataInfo['schoolId'] = intval($studentIds[$studentKey]['schoolId']);
            //收费类型
            $dataInfo['streamSrc'] = isset($chargeTypeList[$dataInfo['chargeType']]) ? intval($chargeTypeList[$dataInfo['chargeType']]['basicsId']) : 0;
            $dataInfo['orderType'] = $dataInfo['courseName'] === '预存' ? OrderModel::ORDER_TYPE_RECHARGE : OrderModel::ORDER_TYPE_PAY;
            //订单表加数据
            $addOrder = self::addOrder($dataKey,$dataInfo);
            if( $addOrder['code'] === Code::PARAM_ERR ){
                \Yii::info('------------student surplus fee import form error--'.$dataKey.'--addOrder fail','importFee');
                $returnArr['code'] = Code::PARAM_ERR;
                $returnArr['error'][] = $addOrder['msg'];
                continue;
            }
            if( ($dataInfo['courseName'] === '预存') ){
                if( empty($dataInfo['surplusFee']) ){
                    \Yii::info('------------student surplus fee import form error--'.$dataKey.'--surplusFee empty---','importFee');
                    continue;
                }
                /*
                 * 存入电子钱包
                 * 学员表的 电子钱包账户余额 字段更新
                 * */
                if( $dataInfo['surplusFee'] > 0 ){
                    $updateStudentAccount = self::updateStudent($dataKey,$dataInfo,'studentAccount');
                    if( $updateStudentAccount['code'] === Code::PARAM_ERR ){
                        \Yii::info('-----------studentAccount-student surplus fee import form error--'.$dataKey.'--updateStudent fail','importFee');
                        $returnArr['error'][] = $updateStudentAccount['msg'];
                        continue;
                    }
                }
            }else{
                if( !isset($courseIds[$dataInfo['courseName']]) ){
                    \Yii::info('------------student surplus fee import form error--'.$dataKey.'--course no exit','importFee');
                    $returnArr['error'][] = '第'.$dataKey.'行的课程不存在';
                    continue;
                }
                $courseInfo = $courseIds[$dataInfo['courseName']];
                $dataInfo['course'] = [
                    'courseId'=>intval($courseInfo['courseId']),
                    'courseName'=>$courseInfo['courseName'],
                    'unit'=>intval($courseInfo['chargeinType'])=== CourseModel::TYPE_TIME ? '次' : '小时'
                ];
                //订单详情表加数据
                $addOrderDetail = self::addOrderDetail($dataKey,$dataInfo,$addOrder['orderId']);
                if( $addOrderDetail['code'] === Code::PARAM_ERR ){
                    \Yii::info('------------student surplus fee import form error--'.$dataKey.'--addOrderDetail fail----datainfo--'.print_r($dataInfo,true),'importFee');
                    $returnArr['error'][] = $addOrderDetail['msg'];
                    continue;
                }
                //学员课程次数总表更新数据
                /*$updateStudentCourse = self::updateStudentCourse($dataKey,$dataInfo);
                if( $updateStudentCourse['code'] === Code::PARAM_ERR ){
                    \Yii::info('------------student surplus fee import form error--'.$dataKey.'--updateStudentCourse fail','importFee');
                    $returnArr['error'][] = $updateStudentCourse['msg'];
                    continue;
                }*/
                //更新学员课程剩余费用
                /*if($dataInfo['surplusFee'] > 0){
                    $updateStudentAccount = self::updateStudent($dataKey,$dataInfo,'surplusTuition');
                    if( $updateStudentAccount['code'] === Code::PARAM_ERR ){
                        \Yii::info('------------student surplus surplusTuition fee import form error--'.$dataKey.'--updateStudent fail','importFee');
                        $returnArr['error'][] = $updateStudentAccount['msg'];
                        continue;
                    }
                }*/
                //欠费
                if($dataInfo['surplusFee'] < 0){
                    $updateStudentAccount = self::updateStudent($dataKey,$dataInfo,'tuitionShortage');
                    if( $updateStudentAccount['code'] === Code::PARAM_ERR ){
                        \Yii::info('------------student surplus fee import form error--'.$dataKey.'--updateStudent fail','importFee');
                        $returnArr['error'][] = $updateStudentAccount['msg'];
                        continue;
                    }
                }
            }
            \Yii::info('----------------student surplus fee import form success key dataKey'.$dataKey,'importFee');
        }
        if($emptyNum === count($data)){
            //excel模板为空
            $returnArr['error'][] = 'excel模板为空';
        }
        \Yii::info('-------student surplus fee import form success returnArr'.print_r($returnArr,true),'importFee');
        return $returnArr;
    }

    /*
     *
     * $dataKey excel 第几行
     * $dataInfo  所在行的数据
     * */
    public static function updateStudent($dataKey,$dataInfo,$column)
    {
        $studentInfo = StudentModel::find()->where(['userId'=>$dataInfo['userId'],'isDelete'=>StudentModel::IS_VALID_OK])->one();
        if( $studentInfo === null ){
            return ['code'=>Code::PARAM_ERR,'msg'=>'第'.$dataKey.'行学员不存在'];
        }
        if( $column === 'studentAccount' ){
            $studentInfo->studentAccount = intval( $studentInfo->studentAccount) + intval($dataInfo['surplusFee']);
            if( !$studentInfo->save() ){
                return ['code'=>Code::PARAM_ERR,'msg'=>'第'.$dataKey.'行学员更新账户失败'];
            }
        }else if( $column === 'surplusTuition' ){
            $studentInfo->surplusTuition = intval( $studentInfo->surplusTuition) + intval($dataInfo['surplusFee']);
            if( !$studentInfo->save() ){
                return ['code'=>Code::PARAM_ERR,'msg'=>'第'.$dataKey.'行学员更新账户失败'];
            }
        }else if( $column === 'tuitionShortage'){
            $studentInfo->tuitionShortage = intval( $studentInfo->tuitionShortage) + intval(-1 * $dataInfo['surplusFee']);
            if( !$studentInfo->save() ){
                return ['code'=>Code::PARAM_ERR,'msg'=>'第'.$dataKey.'行学员更新账户失败'];
            }
        }
        \Yii::info('------------import student ke cheng sheng yu fee userId-'.$dataInfo['userId'].'-----jin e-'.$dataInfo['surplusFee'].'---column-'.$column,'importFee');
        return ['code'=>Code::SUCCESS,'msg'=>'ok'];
    }

    /*
     * 订单表加数据
     * */
    public static function addOrder($dataKey,$dataInfo)
    {
        $orderModel=new OrderModel();
        $orderModel->campusId           = $dataInfo['belongToCampusId'];              //校区id
        $orderModel->schoolId           = $dataInfo['schoolId'];              //学校id
        $orderModel->orderNo            = OrderModel::getNewOrderNo();  //订单编号
        $orderModel->userId             = $dataInfo['userId'];                //用户ID

        if( $dataInfo['surplusFee'] >= 0 ){
            $orderModel->totalAmount        = $dataInfo['surplusFee'];           //订单总金额，单位为分
            $orderModel->actualPay          = $dataInfo['surplusFee'];             //实付金额,单位为分
            $orderModel->owe                = OrderModel::OWE_NO;                   //是否有欠交（0否，1是）
        }else{
            //支付金额为负
            $orderModel->totalAmount        = -1 * $dataInfo['surplusFee'];           //订单总金额，单位为分
            $orderModel->actualPay          = 0;                                     //实付金额,单位为分
            $orderModel->owe                = OrderModel::OWE_YES;                   //是否有欠交（0否，1是）
        }

        $orderModel->couponNo           = '';              //优惠券编号
        $orderModel->couponAmount       = 0;          //优惠券优惠金额,单位为分
        $orderModel->eWallet            = 0;               //电子钱包支付金额,单位为分
//        $orderModel->actualPay          = $dataInfo['surplusFee'];             //实付金额,单位为分
        $orderModel->reduction          = 0;             //直减优惠,单位为分
        $orderModel->invoiceNo          = '';             //发票编号
        $orderModel->orderType          = $dataInfo['orderType'];             //0保留，1退费，2缴费，21补交欠费，22存入电子钱包，3费用结转，31转班，41转出,42转入
        $orderModel->status             = OrderModel::STATUS_YES_PAY;                //订单状态：0未支付，2已支付，1已关闭
        $orderModel->orderDate          = empty($dataInfo['chargeDate']) ? date('Y-m-d') : date('Y-m-d',strtotime($dataInfo['chargeDate']));                //业务发生时间
        $orderModel->remark             = $dataInfo['remark'];                //备注
//        $orderModel->owe                = OrderModel::OWE_NO;                   //是否有欠交（0否，1是）
        $orderModel->confirmingUser     = 0;                           //确认人 //todo
        $orderModel->confirmingdateTime = date('Y-m-d H:i:s');           //确认时间
        if( !$orderModel->save() ){
            return ['code'=>Code::PARAM_ERR,'msg'=>'第'.$dataKey.'行订单信息保存失败'];
        }
        $orderId = $orderModel->orderId;
        return ['code'=>Code::SUCCESS,'ok','orderId'=>$orderId];
    }

    /*
     * 订单详情表加数据
     * */
    public static function addOrderDetail($dataKey,$dataInfo,$orderId)
    {
        $orderDetailModel=new OrderDetailModel();
        $orderDetailModel->orderId          = $orderId;       //订单id
        $orderDetailModel->userId           = $dataInfo['userId'];                            //报名的用户ID
        $orderDetailModel->schoolId         = $dataInfo['schoolId'];                          //学校id
        $orderDetailModel->campusId         = $dataInfo['belongToCampusId'];                          //校区id
        $orderDetailModel->courseId         = $dataInfo['course']['courseId'];                           //课程ID/物品ID
        $orderDetailModel->courseName       = $dataInfo['course']['courseName'];                         //课程名称/物品名称
        $orderDetailModel->coursePackageId  = 0;                    //套餐ID（course_price里的主键）
        if( $dataInfo['surplusFee'] < 0 ){
            //支付金额为负
            $orderDetailModel->totalAmount      = -1 * $dataInfo['surplusFee'];    //课程总金额,,单位为分(折后总价格)
            $orderDetailModel->price            = intval((-1 * $dataInfo['surplusFee']) / (-1 * $dataInfo['surplusNum']));//购买单价
            $orderDetailModel->marketPrice      = intval((-1 * $dataInfo['surplusFee']) / (-1 * $dataInfo['surplusNum']));   //市场价
            $orderDetailModel->owedAmount       = -1 * $dataInfo['surplusFee'];      //欠交金额
            $orderDetailModel->isOwed           = OrderDetailModel::OWE_YES;                             //是否有欠交（0否，1是）
        }else if($dataInfo['surplusFee'] > 0){
            $orderDetailModel->totalAmount      = $dataInfo['surplusFee'];    //课程总金额,,单位为分(折后总价格)
            $orderDetailModel->price            = intval($dataInfo['surplusFee'] / $dataInfo['surplusNum']);//购买单价
            $orderDetailModel->marketPrice      = intval($dataInfo['surplusFee'] / $dataInfo['surplusNum']);    //市场价
            $orderDetailModel->owedAmount       = 0;     //欠交金额
            $orderDetailModel->isOwed           = OrderDetailModel::OWE_NO;                             //是否有欠交（0否，1是）
        }else{
            $orderDetailModel->totalAmount      = 0;    //课程总金额,,单位为分(折后总价格)
            $orderDetailModel->price            = 0;//购买单价
            $orderDetailModel->marketPrice      = 0;    //市场价
            $orderDetailModel->owedAmount       = 0;     //欠交金额
            $orderDetailModel->isOwed           = OrderDetailModel::OWE_NO;
        }
        if( $dataInfo['surplusNum'] < 0 ){
            $orderDetailModel->lessions         = -1 * $dataInfo['surplusNum'];        //课程节数，含赠送课程数
        }else{
            $orderDetailModel->lessions         = $dataInfo['surplusNum'];        //课程节数，含赠送课程数
        }

        $orderDetailModel->giveLessions     = 0;                       //赠送课程次数
        $orderDetailModel->discount         = 10000;                       //折扣10000表示100%
        $orderDetailModel->streamSrc        = $dataInfo['streamSrc'];                          //来源：取得配置
        $orderDetailModel->expireTime       = empty($dataInfo['effectiveDate']) ? date('Y-m-d') : date('Y-m-d',strtotime($dataInfo['effectiveDate']));                         //过期时间
        $orderDetailModel->unit             = $dataInfo['course']['unit'];          //单位
        $orderDetailModel->type             = OrderDetailModel::TYPE_COURSE;                               //0课程，1物品
        $orderDetailModel->isShare          = OrderDetailModel::SHARE_NO;                              //是否分摊（0否，1是）

        $orderDetailModel->discountPrice    = 0;//直减分摊后的优惠金额
        if( !$orderDetailModel->save() ){
            return ['code'=>Code::PARAM_ERR,'msg'=>'第'.$dataKey.'行订单详情信息保存失败'];
        }
        return ['code'=>Code::SUCCESS,'ok'];
    }

    /*
     * 学员课程总表更新数据
     * */
    public static function updateStudentCourse($dataKey,$dataInfo)
    {
        if( $dataInfo['surplusNum'] > 0 ){
            $save = StudentCourseCountModel::updateLessions(intval($dataInfo['belongToCampusId']),intval($dataInfo['userId']),intval($dataInfo['course']['courseId']),$dataInfo['surplusNum'],$dataInfo['course']['unit'],$dataInfo['effectiveDate'],'lessions');
            if( $save === false ){
                return ['code'=>Code::PARAM_ERR,'msg'=>'第'.$dataKey.'行学员课程总信息保存失败'];
            }
        }else if($dataInfo['surplusNum'] <0){
            $save = StudentCourseCountModel::updateLessions(intval($dataInfo['belongToCampusId']),intval($dataInfo['userId']),intval($dataInfo['course']['courseId']),(-1 * $dataInfo['surplusNum']),$dataInfo['course']['unit'],$dataInfo['effectiveDate'],'usedLessions');
            if( $save === false ){
                return ['code'=>Code::PARAM_ERR,'msg'=>'第'.$dataKey.'行学员课程总信息保存失败'];
            }
        }
        return ['code'=>Code::SUCCESS,'ok'];
    }

}