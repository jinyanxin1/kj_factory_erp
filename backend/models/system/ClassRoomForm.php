<?php
/**
 * Created by cqj
 * User: cqj
 * Date: 2019/10/25
 * Time: 16:16
 */

namespace backend\models\system;


use common\library\helper\Code;
use common\models\BaseForm;
use common\models\system\ClassRoomModel;
use common\models\system\SectionModel;
use Yii;

class ClassRoomForm extends BaseForm
{
    public $roomName;
    public $seatNum;
    public $roomId;

    public function rules()
    {
        return [
            ['roomName','required'],
            ['roomName','string','max'=>30 ],
            ['seatNum','default','value'=>0],
            ['seatNum','integer'],
            ['seatNum','compare','compareValue' => 0 , 'operator' => '>='],
            ['campusId',function ($attr, $params) {
                $count = SectionModel::find()->select(['sectionId'])
                    ->where(['sectionId' => $this->campusId , 'isDelete' => SectionModel::IS_VALID_OK])
                    ->andWhere(['isCampus' => SectionModel::IS_CAMPUS_YES])
                    ->count();
                if($count == 0){
                    $this->addError($attr, '无效校区');
                    return;
                }
            }]
        ];
    }

    public function attributeLabels()
    {
        return [
            'roomName' => '教室名称' ,
            'campusId' => '校区编号' ,
            'seatNum' => '容纳人数' ,
            'roomId' => '教室编号' ,
        ];
    }

    /**
     * 新增
     * @return array
     */
    public function insert() {
        if(!$this->validate()){
            $firstItem = $this->getErrors();
            foreach ($firstItem as $value) {
                return ['code' => Code::PARAM_ERR ,'msg'=>$value[0]];
            }
        }

        $roomName = $this->roomName ;
        $campusId = $this->campusId ;
        $seatNum = $this->seatNum ;

        //判断重名
        $count = ClassRoomModel::find()
            ->select(['roomId'])
            ->where(['roomName' => $roomName ,
                'isDelete' => ClassRoomModel::IS_VALID_OK,
                'campusId' => $this->campusId
            ])
            ->count();
        if(0 < $count) {
            return ['code' => Code::PARAM_ERR ,'msg'=>'重复名称'];
        }

        $classRoom = new ClassRoomModel();
        $classRoom->roomName = $roomName ;
        $classRoom->campusId = $campusId ;
        $classRoom->seatNum = $seatNum ;
        $classRoom->schoolId = $this->schoolId ;
        $classRoom->isDelete = ClassRoomModel::IS_VALID_OK ;

        if(!$classRoom->save()){
            return ['code' => Code::PARAM_ERR ,'msg'=>'新增失败'];
        }
        return ['code' => Code::SUCCESS ,'msg'=>'新增成功'];
    }

    /**
     * 修改
     * @return array
     */
    public function update () {
        if(!$this->validate()){
            $firstItem = $this->getErrors();
            foreach ($firstItem as $value) {
                return ['code' => Code::PARAM_ERR , 'msg' => $value[0]];
            }
        }

        $roomId = $this->attributes['roomId'] ;
        $roomName = $this->attributes['roomName'] ;
        $seatNum = $this->attributes['seatNum'] ;

        //判断编号
        $room = ClassRoomModel::find()
            ->where(['roomId' => $roomId , 'isDelete' => ClassRoomModel::IS_VALID_OK])
            ->one();
        if(empty($room)) {
            return ['code' => Code::PARAM_ERR , 'msg' => '教室编号错误'];
        }

        //判断重名
        $classRoomNameIds = ClassRoomModel::find()->select(['roomId'])
            ->where(['roomName' => $roomName , 'isDelete' => ClassRoomModel::IS_VALID_OK])
            ->andWhere(['campusId' => $this->campusId])
            ->asArray()
            ->indexBy('roomId')
            ->all();

        if(!empty($classRoomNameIds)){
            if(!in_array($room->roomId  , array_keys($classRoomNameIds))){
                return ['code' => Code::PARAM_ERR , 'msg' => '重复名称'];
            }
        }

        $room->roomName = $roomName;
        $room->seatNum = $seatNum;
        $room->schoolId = $this->schoolId ;

        if(!$room->save()){
            return ['code' => Code::SUCCESS ,'msg'=>'修改失败'];
        }
        return ['code' => Code::SUCCESS ,'msg'=>'修改成功'];

    }

    /**
     * 删除
     */
    public function del() {
//        if(empty($this->roomId)){
//            return ['code' => Code::SUCCESS ,'msg'=>'教室编号不能为空'];
//
//        }
//        $classRoom = ClassRoomModel::getInfo($this->roomId);
//        if(empty($classRoom)){
//            return ['code' => Code::SUCCESS ,'msg'=>'教室编号错误'];
//        }
//        $classRoom -> isDelete = ClassRoomModel::IS_VALID_NO;
//        if(!$classRoom->save()){
//            return ['code' => Code::PARAM_ERR ,'msg'=>'删除失败'];
//        }
        $tran = Yii::$app->db->beginTransaction();
        try{
            ClassRoomModel::updateAll(['isDelete' => ClassRoomModel::IS_VALID_NO],
                ['roomId' => $this->roomId]);
            $tran->commit();
        }catch (\Exception $exception){
            //回滚
            $tran->rollBack();
            return ['code' => Code::PARAM_ERR ,'msg'=>$exception->getMessage()];
        }
        return ['code' => Code::SUCCESS ,'msg'=>'删除成功'];
    }

    /**
     * 分页查询列表
     * @param $page
     * @param $pageSize
     * @return array
     */
    public function pageList($page,$pageSize,$roomName) {

        $offset = ($page - 1) * $pageSize;

        $list = ClassRoomModel::find()
            ->where(['campusId' => $this->campusId,'isDelete' => ClassRoomModel::IS_VALID_OK])
            ->andFilterWhere(['like','roomName',$roomName]);

        $count = $list -> count();

        $data = $list->offset($offset)->limit($pageSize)->all();
        $newData = [] ;
        foreach ($data as $key => $value ) {
            $newData[] = [
                'roomId' => $value['roomId'],
                'roomName' => $value['roomName'],
                'seatNum' => $value['seatNum'],
            ];
        }
        return ['code' =>Code::SUCCESS, 'msg' => 'ok',
            'data' => array('list' => $newData, 'pageInfo' => $this->getPageInfo($count, $pageSize, $page))];
    }

    /**
     * 活动所有的教室
     * @param $roomName
     * @return array
     */
    public function getListAll ($roomName) {
        $list = ClassRoomModel::find()
            ->select(['roomId','roomName','seatNum'])
            ->where(['campusId' => $this->campusId,'isDelete' => ClassRoomModel::IS_VALID_OK])
            ->andFilterWhere(['like','roomName',$roomName])
            ->asArray()
            ->all();
        $newData = [] ;
        foreach ($list as $key => $value ) {
            $newData[] = [
                'roomId' => $value['roomId'].'',
                'roomName' => $value['roomName'],
                'seatNum' => $value['seatNum'],
            ];
        }
        return ['code' =>Code::SUCCESS, 'msg' => 'ok',
            'data' => $newData];
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