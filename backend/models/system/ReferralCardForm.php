<?php
/**
 * Created by cqj
 * User: cqj
 * Date: 2020/1/7
 * Time: 11:29
 */

namespace backend\models\system;


use common\library\helper\Code;
use common\models\BaseForm;
use common\models\classes\ClassesModel;
use common\models\system\ReferralCardAuthorizeModel;
use common\models\system\ReferralCardModel;
use common\models\system\ReferralCardPushModel;
use common\models\user\UserModel;
use Yii;
use yii\helpers\ArrayHelper;
use yii\helpers\Json;

class ReferralCardForm extends BaseForm
{
    public $cardId;
    public $name;
    public $activityStartTime;
    public $activityEndTime;
    public $activityPic;
    public $buttonName;
    public $buttonColor;
    public $isSelectCampus;
    public $title;
    public $desc;
    public $logo;
    public $recommendReduceMoney;
    public $recommendRepeat;
    public $recommendStartTime;
    public $recommendEndTime;
    public $recommendTerm;
    public $useReduceMoney;
    public $useRepeat;
    public $useStartTime;
    public $useEndTime;
    public $useTerm;
    public $isFirstTimeUsing;
    public $authorize;
    public $push;
    public $status;

    public $page;
    public $pageSize;
    public $info;

    public function rules()
    {
        return [
            [
                ['name','activityStartTime',
                'activityEndTime','buttonName','title','desc','recommendReduceMoney',
                    'recommendStartTime','recommendEndTime','useReduceMoney','useStartTime',
                    'useEndTime'],
                'required'
            ],
        ];
    }

    public function attributeLabels()
    {
        return [
            'cardId' => '电子卡id' ,
            'name' => '活动名称' ,
            'activityStartTime' => '活动开始时间' ,
            'activityEndTime' => '活动结束时间' ,
            'activityPic' => '活动图片' ,
            'buttonName' => '按钮名称' ,
            'buttonColor' => '按钮颜色' ,
            'isSelectCampus' => '新学员可选择意向报名校区' ,
            'title' => '分享标题' ,
            'desc' => '分享描述' ,
            'logo' => '分享图标' ,
            'recommendReduceMoney' => '老学员推荐优惠金额' ,
            'recommendStartTime' => '老学员推荐优惠-开始时间' ,
            'recommendEndTime' => '老学员推荐优惠-结束时间' ,
            'useReduceMoney' => '新学员报名优惠金额' ,
            'useStartTime' => '新学员报名优惠-开始时间' ,
            'useEndTime' => '新学员报名优惠-结束时间' ,
        ];
    }

    /**
     * 新增
     */
    public function insert(){
        $model = new ReferralCardModel();
        $model->name = $this->name;
        $model->activityStartTime = $this->activityStartTime;
        $model->activityEndTime = $this->activityEndTime;
        //TODO 可能需要处理JSON
        $model->activityPic = $this->activityPic;

        $model->buttonName = $this->buttonName;
        $model->buttonColor = $this->buttonColor;
        $model->isSelectCampus = $this->isSelectCampus;
        $model->title = $this->title;
        $model->desc = $this->desc;
        $model->recommendReduceMoney = $this->recommendReduceMoney;
        $model->recommendRepeat = $this->recommendRepeat;
        $model->recommendStartTime = $this->recommendStartTime;
        $model->recommendEndTime = $this->recommendEndTime;
        $model->recommendTerm = $this->recommendTerm;
        $model->useReduceMoney = $this->useReduceMoney;
        $model->useRepeat = $this->useRepeat;
        $model->useStartTime = $this->useStartTime;
        $model->useEndTime = $this->useEndTime;
        $model->useTerm = $this->useTerm;
        $model->isFirstTimeUsing = $this->isFirstTimeUsing;
        $model->schoolId = $this->schoolId;
        if ( $model->save() ) {
            return ['code' => Code::SUCCESS ,'msg'=>'新增成功'];
        }
        return ['code' => Code::PARAM_ERR ,'msg'=>'新增失败'];

    }
    /**
     *详情
     * @return array
     */
    public function getInfo() {
        $this->info = ReferralCardModel::getById($this->cardId) ;
        return $this->info ;
    }
    /**
     * 修改
     */
    public function update(){
        $model = ReferralCardModel::find()->where(['cardId' => $this->cardId])->one();
        if ( empty($model) ) {
            return ['code' => Code::PARAM_ERR ,'msg'=>'编号错误'];
        }

        $model->name = $this->name;
        $model->activityStartTime = $this->activityStartTime;
        $model->activityEndTime = $this->activityEndTime;
        //TODO 可能需要处理JSON
        $model->activityPic = $this->activityPic;

        $model->buttonName = $this->buttonName;
        $model->buttonColor = $this->buttonColor;
        $model->isSelectCampus = $this->isSelectCampus;
        $model->title = $this->title;
        $model->desc = $this->desc;
        $model->recommendReduceMoney = $this->recommendReduceMoney;
        $model->recommendRepeat = $this->recommendRepeat;
        $model->recommendStartTime = $this->recommendStartTime;
        $model->recommendEndTime = $this->recommendEndTime;
        $model->recommendTerm = $this->recommendTerm;
        $model->useReduceMoney = $this->useReduceMoney;
        $model->useRepeat = $this->useRepeat;
        $model->useStartTime = $this->useStartTime;
        $model->useEndTime = $this->useEndTime;
        $model->useTerm = $this->useTerm;
        $model->isFirstTimeUsing = $this->isFirstTimeUsing;
        $model->schoolId = $this->schoolId;
        if ( $model->save() ) {
            return ['code' => Code::SUCCESS ,'msg'=>'编辑成功'];
        }
        return ['code' => Code::PARAM_ERR ,'msg'=>'编辑失败'];

    }

    /**
     * 列表
     */
    public function getList() {
        $offset = ($this->page - 1) * $this->pageSize;

        $list = ReferralCardModel::find()->where(['isDelete' => ReferralCardModel::IS_VALID_OK]);

        $count = $list -> count();

        $list = $list->offset($offset)->limit($this->pageSize)->asArray()->all();

        $data = [] ;

        $cardIdList = array_column($list,'cardId') ;

        $autuorizeList = ReferralCardAuthorizeModel::find()
            ->where(['cardId' => $cardIdList , 'isDelete' => ReferralCardAuthorizeModel::IS_VALID_OK])
            ->asArray()
            ->all() ;

        $autuorizeList = ArrayHelper::index($autuorizeList, null, 'cardId');

        //TODO 重新组织数据
        foreach ( $list as $value ) {
            $item = [] ;
            $item['cardId'] = $value['cardId'] ;
            $item['name'] = $value['name'] ;
            $item['activityStartTime'] = $value['activityStartTime'] ;
            $item['activityEndTime'] = $value['activityEndTime'] ;
            //TODO 判断
            $item['status'] = ReferralCardModel::$STATUS[intval($value['status'])] ;
            //TODO 数据处理和判断
            $item['authorizeCount'] = in_array($value['cardId'],$autuorizeList) && sizeof($autuorizeList) > 0 ? '未授权' :
                sizeof($autuorizeList[$value['cardId']]) == 0 ? '未授权' : sizeof($autuorizeList[$value['cardId']]) ;
            $data[] = $item ;
        }

        return ['code' =>Code::SUCCESS, 'msg' => 'ok',
            'data' => array('list' => $data, 'pageInfo' => $this->getPageInfo($count, $this->pageSize, $this->page))];


    }

    /**
     * 授权
     */
    public function authorize() {
        $model = ReferralCardModel::find()->where(['cardId' => $this->cardId])->one();

        if ( empty($model) ) {
            return ['code' => Code::PARAM_ERR ,'msg'=>'编号错误'];
        }

        $tran = \Yii::$app->db->beginTransaction();

        try{
            //先删除此推荐卡的所有授权
            ReferralCardAuthorizeModel::updateAll(['cardId' => $this->cardId],
                ['isDelete' => ReferralCardAuthorizeModel::IS_VALID_NO]);

            foreach ( $this->authorize as $value ) {
                $au = ReferralCardAuthorizeModel::find()
                    ->where(['cardId' => $this->cardId,'userId' => $value['userId']])
                    ->one();

                if ( empty( $au ) ) {
                    $au = new ReferralCardAuthorizeModel() ;
                }

                $au->cardId = $this->cardId ;
                $au->userId = $value['userId'] ;
                $au->cardNumber = $value['cardNumber'] ;
                $au->save() ;
            }

            $tran->commit();
            return ['code' => Code::SUCCESS ,'msg'=>'授权成功'];
        }catch (\Exception $exception) {
            $tran->rollBack();
            return ['code' => Code::SUCCESS ,'msg'=>'授权失败'];

        }
    }

    /**
     * 推送
     */
    public function push() {
        $model = ReferralCardModel::find()->where(['cardId' => $this->cardId])->one();

        if ( empty($model) ) {
            return ['code' => Code::PARAM_ERR ,'msg'=>'编号错误'];
        }

        $tran = \Yii::$app->db->beginTransaction();

        try{
            //先删除此推荐卡的所有推送
            ReferralCardPushModel::updateAll(['cardId' => $this->cardId],
                ['isDelete' => ReferralCardPushModel::IS_VALID_NO]);

            foreach ( $this->push as $value ) {
                $ps = ReferralCardPushModel::find()
                    ->where(['cardId' => $this->cardId,'classId' => $value])
                    ->one();

                if ( empty( $ps ) ) {
                    $ps = new ReferralCardPushModel() ;
                }

                $ps->cardId = $this->cardId ;
                $ps->classId = $value ;
                $ps->save() ;
            }

            $tran->commit();
            return ['code' => Code::SUCCESS ,'msg'=>'授权成功'];
        }catch (\Exception $exception) {
            $tran->rollBack();
            return ['code' => Code::SUCCESS ,'msg'=>'授权失败'];

        }
    }

    /**
     * 得到授权
     */
    public function get_authorize() {
        $list = ReferralCardAuthorizeModel::find()
            ->where(['cardId' => $this->cardId,'isDelete' => ReferralCardAuthorizeModel::IS_VALID_OK])
            ->asArray()
            ->all();
        $data = [] ;

        if ( empty( $list ) ) {
            return ['code' => Code::SUCCESS ,'msg'=>'ok' ,'data' => $data ];
        }

        $userIds = array_column($list,'userId') ;

        $userList = UserModel::find()
            ->select(['userId','userNickName'])
            ->where(['userId' => $userIds , 'isDelete' => UserModel::IS_VALID_OK])
            ->asArray()
            ->indexBy('userId')
            ->all();

        foreach ($list as $value) {
            if ( isset($userList[$value['userId']]) ) {
                $item = [] ;
                $item['authorizeId'] = $value['authorizeId'] ;
                $item['cardId'] = $value['cardId'] ;
                $item['userId'] = $value['userId'] ;
                $item['cardNumber'] = $value['cardNumber'] ;
                $item['userName'] = $userList[$value['userId']]['userNickName'] ;

                $data[] = $item ;
            }

        }
        return ['code' => Code::SUCCESS ,'msg'=>'ok' ,'data' => $data ];

    }

    /**
     * 得到推送
     */
    public function get_push() {
        $list = ReferralCardPushModel::find()
            ->where(['cardId' => $this->cardId,'isDelete' => ReferralCardPushModel::IS_VALID_OK])
            ->asArray()
            ->all();
        $data = [] ;

        if ( empty( $list ) ) {
            return ['code' => Code::SUCCESS ,'msg'=>'ok' ,'data' => $data ];
        }

        $classIds = array_column($list,'classId') ;

        $classList = ClassesModel::find()
            ->where(['classesId' => $classIds,'isDelete' => ClassesModel::IS_VALID_OK])
            ->asArray()
            ->indexBy('classesId')
            ->all();

        foreach ( $list as $value ) {
            if ( isset($classList[$value['classId']]) ) {
                $item = [] ;
                $item['authorizeId'] = $value['authorizeId'] ;
                $item['cardId'] = $value['cardId'] ;
                $item['classId'] = $value['classId'] ;
                $item['cardNumber'] = $value['cardNumber'] ;
                $item['className'] = $classList[$value['classId']]['classesName'] ;

                $data[] = $item ;
            }
        }
        return ['code' => Code::SUCCESS ,'msg'=>'ok' ,'data' => $data ];

    }

    /**
     * 修改状态
     */
    public function status () {
        $model = ReferralCardModel::find()->where(['cardId' => $this->cardId])->one();
        if ( empty($model) ) {
            return ['code' => Code::PARAM_ERR ,'msg'=>'编号错误'];
        }

        $model->status = $this->status ;

        if ( $model->save() ) {
            return ['code' => Code::SUCCESS ,'msg'=>'修改成功'];
        }

        return ['code' => Code::PARAM_ERR ,'msg'=>'修改失败'];

    }

    /**
     * 得到分页信息
     * @param $count
     * @param int $pageSize
     * @param int $page
     * @return array
     */
    protected function getPageInfo($count , $pageSize = 0, $page = 1 ){
        if(empty($pageSize)){
            $pageSize = Yii::$app->params['pageSize'];
        }
        $pageSum = ceil($count/$pageSize);
        return [
            'page' => $page,
            'pageSum' => $pageSum,
            'pageSize' => $pageSize,
            'count' => $count
        ];
    }
}