<?php
/**
 *
 * author: jinyanxin
 * Date: 2020/9/2
 * Time: 10:00
 * PHP version 7
 * 项目表
 */

namespace common\models\project;


use common\models\BaseModel;
use Yii;

/**
 * This is the model class for table "kj_project_info".
 *
 * @property int $id
 * @property string|null $name 项目名称
 * @property string|null $startTime 开始时间
 * @property string|null $cycle 项目周期
 * @property string|null $endTime 结束时间
 * @property int|null $projectLeader 项目责任人
 * @property string|null $projectExplain 项目描述，说明
 * @property int|null $projectScore 项目评分
 * @property int|null $price 项目金额
 * @property int|null $receiptPrice 收款金额
 * @property int|null $expenditurePrice 支出金额
 * @property int|null $reportUserId 报备人id
 * @property string|null $reportTime 项目报备时间
 * @property int|null $status 项目状态：0未设置；1待审；2已报备；3一开始；4已结束
 * @property int|null $contractStatus 合同收发状态：0未设置；1未发送；2已发送；3已签收
 * @property int|null $receiptStatus 收款状态：0未设置；1未收款；2收款一部分；3收款完成
 * @property string|null $joinPersonal 参与人员：张三，李四
 * @property int|null $belongCustomer 所属客户
 * @property int|null $clientPersonId 所属客户联系人
 * @property string|null $projectAddress 项目地点
 * @property string|null $projectDescribe 项目描述
 * @property string|null $creator
 * @property string|null $createTime
 * @property string|null $updater
 * @property string|null $updateTime
 * @property int|null $isValid 0未删除；1已删除
 */
class ProjectInfoModel extends BaseModel
{

    //项目状态：0未设置；1未开始；2进行中；3已结束
    const STATUS_EXAMINE_NO = 1;//待审核
    const STATUS_REPORT_YES = 2;//已报备
    const STATUS_START = 3;//已开始
    const STATUS_END = 4;//已结束

    //合同收发状态：0未设置；1未发送；2已发送；3已签收
    const CONTRACT_NOT_SEND = 1;//未发送
    const CONTRACT_SEND = 2;//已发送
    const CONTRACT_SIGN = 3;//已签收

    //收款状态：0未设置；1未收款；2收款一部分；3收款完成
    const RECEIPT_NOT = 1;//未收款
    const RECEIPT_ING = 2;//收款一部分
    const RECEIPT_END = 3;//收款完成

    public static $statusList = [
        self::STATUS_EXAMINE_NO => '待审核',
        self::STATUS_REPORT_YES => '已报备',
        self::STATUS_START => '已开始',
        self::STATUS_END => '已结束',
    ];

    public static $contractList = [
        self::CONTRACT_NOT_SEND => '未发送',
        self::CONTRACT_SEND => '已发送',
        self::CONTRACT_SIGN => '已签收',
    ];

    public static $receiptList = [
        self::RECEIPT_NOT => '未收款',
        self::RECEIPT_ING => '收款中',
        self::RECEIPT_END => '收款完成',
    ];



    public static function tableName()
    {
        return 'kj_project_info';
    }

    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'name' => '项目名称',
            'startTime' => '开始时间',
            'cycle' => '项目周期',
            'endTime' => '结束时间',
            'projectLeader' => '项目责任人',
            'projectExplain' => '项目描述，说明',
            'projectScore' => '项目评分',
            'price' => '项目金额',
            'receiptPrice' => '收款金额',
            'expenditurePrice' => '支出金额',
            'reportUserId' => '报备人id',
            'reportTime' => '项目报备时间',
            'status' => '项目状态',
            'contractStatus' => '合同收发状态',
            'receiptStatus' => '收款状态',
            'joinPersonal' => '参与人员',
            'belongCustomer' => '所属客户',
            'clientPersonId' => '所属客户联系人',
            'projectAddress' => '项目地点',
            'projectDescribe' => '项目描述',
        ];
    }
}