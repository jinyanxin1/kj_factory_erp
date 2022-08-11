<?php
/**
 * Created by cqj
 * User: cqj
 * Date: 2019/10/25
 * Time: 16:17
 */

namespace backend\models\system;


use common\library\helper\Code;
use common\models\BaseForm;
use common\models\system\BasicsModel;
use common\models\system\BasicsGroupModel;
use Yii;

class BasicsForm extends BaseForm
{
    public $name;
    public $type;
   // public $basicsGroupId;
    public $describe;
    public $basicsId;
    public $campusIds;
    public $parentId;
    public $isCommonality;
    public function rules() {
        return [
            ['name','required','message'=>'名称不能为空'],
            ['type','required','message'=>'类型不能为空'],
            ['type', 'in', 'range' => array_column(BasicsModel::getTypeList(),'type') ,'message'=>'无效类型'],
            ['name','string','max'=>30,'message' => '名称长度不能大于三十字符'],
            ['parentId','default', 'value' => 0],
            ['isCommonality','default', 'value' => 0],
//            ['basicsGroupId', function ($attr, $params) {
//                $info = BasicsGroupModel::find()
//                    ->where(['type' => $this->type ,'id' => $this->basicsGroupId,'isDelete'=>BasicsModel::IS_VALID_OK])
//                    ->one();
//                if(empty($info)) {
//                    $this->addError($attr, "无效分组");
//                    return;
//                }
//            }],
        ];
    }

    /**
     * 新增
     * @return array
     */
    public function insert(){
        if(!$this->validate()){
            $firstItem = $this->getErrors();
            foreach ($firstItem as $value) {
                return ['code' => Code::PARAM_ERR ,'msg'=>$value[0]];
            }
        }
        $type = $this->type;
        $name = $this->name;
        //$basicsGroupId = $this->basicsGroupId;
        $describe = $this->describe;
        if(empty($name)){
            return ['code' => Code::PARAM_ERR ,'msg'=>'名称不能为空'];
        }

        //判断重名
        $basics = BasicsModel::find()->select(['basicsId'])
            ->where(['name' => $name , 'type' => $type ,'isDelete' => BasicsModel::IS_VALID_OK])
            ->andWhere(['schoolId' => $this->schoolId])
            ->all();
        if(!empty($basics)){
            return ['code' => Code::PARAM_ERR ,'msg'=>'项目名已存在'];
        }
        switch ($type) {
            case BasicsModel::CHANNEL_MODE :
                $campusIds = $this->campusIds;
                $parentId = $this->parentId;
                $isCommonality = $this->isCommonality;
                $campusIdArrt = empty($campusIds) ? '' : implode(",", $campusIds);
                $tran = Yii::$app->db->beginTransaction();
                try{
                    $basics = new BasicsModel();
                    $basics->name = $name;
                    $basics->parentId = $parentId;
                    $basics->campusIds = $campusIdArrt;
                    $basics->isCommonality = $isCommonality;
                    $basics->describe = $this->describe;
                    $basics->type = $this->type;
                    $basics->schoolId = $this->schoolId;
                    if(!$basics->save()){
                        throw new \Exception("新增失败");
                    }
                    //查询所有
                    $basicsAll = BasicsModel::find()
                        ->where(['isDelete' => BasicsModel::IS_VALID_OK , 'type' => $type])
                        ->andWhere(['schoolId' => $this->schoolId])
                        ->all();
                    //修改所有父级的授权
                    self::campusChangeParent(
                        $basics->parentId,
                        $basicsAll,
                        $campusIds == null ? [] : $campusIds);
                    $tran->commit();
                }catch (\Exception $exception){
                    //回滚
                    $tran->rollBack();
                    return ['code' => Code::PARAM_ERR ,'msg'=>$exception->getMessage()];
                }
                break;
            default :
                //新增
                $basics = new BasicsModel();
                $basics->name = $name;
                $basics->parentId = $this->parentId;
                $basics->type = $type;
                //$basics->basicsGroupId = $basicsGroupId;
                $basics->describe = $describe;
                $basics->schoolId = $this->schoolId;
                if(!$basics->save()){
                    return ['code' => Code::PARAM_ERR ,'msg'=>'新增失败'];
                }
                break;
        }
        BasicsModel::setCaChe();
        return ['code' => Code::SUCCESS ,'msg'=>'新增成功','data'=>$basics];
    }

    /**
     * 删除
     * @return array
     */
    public function del() {
        $basicsId = $this->basicsId;
        $type = $this->type;
        switch ($type){
            case BasicsModel::CHANNEL_MODE :
                $marketChanneList =  BasicsModel::find()
                    ->where(['basicsId' => $this->basicsId])
                    ->orWhere(['parentId' => $this->basicsId])
                    ->andWhere(['isDelete' => BasicsModel::IS_VALID_OK , 'type' => BasicsModel::CHANNEL_MODE ])
                    ->all();
                $marketChanne = null ;
                $marketChanneChildren = [] ;
                if(!empty($marketChanneList)) {
                    foreach ($marketChanneList as $value) {
                        if($value['basicsId'] == $this->basicsId){
                            $marketChanne = $value;
                        } else {
                            $marketChanneChildren[] = $value;
                        }
                    }
                }

                if(empty($marketChanne)){
                    return ['code' => Code::PARAM_ERR ,'msg'=>'未知参数无法删除'];
                }

                if(!empty($marketChanneChildren)){
                    return ['code' => Code::PARAM_ERR ,'msg'=>'存在下级不能删除'];
                }

                $marketChanne->isDelete = BasicsModel::IS_VALID_NO ;

                if(!$marketChanne->save()){
                    return ['code' => Code::PARAM_ERR ,'msg'=>'删除失败'];
                }
                break;
            default:
                if(empty($basicsId)){
                    return ['code' => Code::PARAM_ERR ,'msg'=>'参数编号不能为空'];
                }
                $basics = BasicsModel::find()
                    ->where(['basicsId' => $basicsId , 'isDelete' => BasicsModel::IS_VALID_OK])
                    ->one();

                if(empty($basics)){
                    return ['code' => Code::PARAM_ERR ,'msg'=>'未知参数无法删除'];
                }

                $basics->isDelete = BasicsModel::IS_VALID_NO ;

                if(!$basics->save()){
                    return ['code' => Code::PARAM_ERR ,'msg'=>'删除失败'];

                }
                break;
        }
        BasicsModel::setCaChe();
        return ['code' => Code::SUCCESS ,'msg'=>'删除成功'];
    }

    /**
     * 编辑
     * @return array
     */
    public function update() {
        if(!$this->validate()){
            $firstItem = $this->getErrors();
            foreach ($firstItem as $value) {
                return ['code' => Code::PARAM_ERR ,'msg'=>$value[0]];
            }
        }
        $basicsId = $this->basicsId;
        $type = $this->type;
        if(empty($basicsId)){
            return ['code' => Code::PARAM_ERR ,'msg'=>'参数编号不能为空'];
        }

        //$basicsGroupId = $this->basicsGroupId;
        switch ($type){
            case BasicsModel::CHANNEL_MODE :
                //todo 市场修改
                $campusIds =  $this->attributes['campusIds'];
                $name = $this->attributes['name'];
                $marketChannelId = $basicsId;
                $campusIdArrt = empty($campusIds) ? '' : implode(",", $campusIds);
                $ReDoName = BasicsModel::find()
                    ->where(['name' => $name , 'isDelete' => BasicsModel::IS_VALID_OK])
                    ->andWhere(['schoolId' => $this->schoolId])
                    ->asArray()
                    ->indexBy('basicsId')
                    ->all();
                if(!empty($ReDoName)){
                    if(in_array($marketChannelId,$ReDoName)){
                        return ['code' => Code::PARAM_ERR ,'msg'=>'市场渠道名称已存在'];
                    }
                }
                $tran = Yii::$app->db->beginTransaction();
                try{
                    $marketChannel = BasicsModel::find()
                        ->where(['basicsId' => $marketChannelId ,
                            'isDelete' => BasicsModel::IS_VALID_OK,
                            'type' => BasicsModel::CHANNEL_MODE ])
                        ->one();
                    if(empty($marketChannel)){
                        throw new \Exception("无效数据无法修改");
                    }

                    $marketChannel->name = $name;
                    $marketChannel->campusIds = $campusIdArrt;
                    $marketChannel->describe = $this->describe;
                    if(!$marketChannel->save()){
                        throw new \Exception("修改失败");
                    }

                    //查询所有
                    $marketChannelAll = BasicsModel::find()
                        ->where(['isDelete' => BasicsModel::IS_VALID_OK ,'type' => BasicsModel::CHANNEL_MODE ])
                        ->all();

                    //修改所有父级的授权
                    self::campusChangeParent($marketChannel->parentId,$marketChannelAll,$campusIds == null ? [] : $campusIds);

                    //修改所有子级的授权
                    self::campusChangeChild($marketChannel->basicsId,$marketChannelAll,$campusIds == null ? [] : $campusIds);

                    $tran->commit();

                }catch (\Exception $exception){
                    //回滚
                    $tran->rollBack();
                    return ['code' => Code::PARAM_ERR ,'msg'=>$exception->getMessage()];
                }
                break;
            default:
                $basics = BasicsModel::find()
                    ->where(['basicsId' => $basicsId , 'type' => $type , 'isDelete' => BasicsModel::IS_VALID_OK])
                    //->andFilterWhere(['basicsGroupId' => $basicsGroupId])
                    ->one();

                if(empty($basics)){
                    return ['code' => Code::PARAM_ERR ,'msg'=>'参数编号不能为空'];
                }

                $name = $this->name;
                $describe = $this->describe;
                //判断重名
                $basicsName = BasicsModel::find()->select(['basicsId'])
                    ->where(['name' => $name , 'type' => $type ,'isDelete' => BasicsModel::IS_VALID_OK])
                    //->andFilterWhere(['schoolId' => $schoolId])
                    //->andFilterWhere(['basicsGroupId' => $basicsGroupId])
                    ->asArray()
                    ->indexBy('basicsId')
                    ->all();
                if(!empty($basicsName)){
                    if(!in_array($basicsId , array_keys($basicsName))){
                        return ['code' => Code::PARAM_ERR ,'msg'=>'参数编号不能为空'];
                    }
                }
                //修改
                $basics->type = $type;
                $basics->name = $name;
                $basics->describe = $describe;

                if(!$basics->save()){
                    return ['code' => Code::PARAM_ERR ,'msg'=>'参数编号不能为空'];
                }
                break;
        }
        BasicsModel::setCaChe();
        return ['code' => Code::SUCCESS ,'msg'=>'修改成功'];

    }

    public static function campusChangeParent($parentId, $children, $campusIdArrt){
        if(!empty($children)){
            foreach ( $children as $key => $value ) {
                if( $value->basicsId == $parentId ){
                    //将此条父级的校区编号字符串转为数组
                    $campusIds = strlen(trim($value->campusIds)) == 0 ?
                        [] : explode(",", $value->campusIds );
                    //将两个数组进行合并去重
                    $campusIds = array_unique( array_merge($campusIds,$campusIdArrt) );

                    $campusIds = empty($campusIds) ? '' : implode(",", $campusIds);

                    $value->campusIds = $campusIds ;
                    if(!$value->save()){
                        throw new \Exception("新增失败");
                    }
                    unset($children[$key]);
                    self::campusChangeParent($value->parentId,$children,$campusIdArrt);
                }
            }
        }
    }


    public static function campusChangeChild($childId, $children, $campusIdArrt){
        if(!empty($children)){
            foreach ( $children as $key => $value ) {
                if( $value->parentId == $childId ){

                    $campusIds = implode(",", $campusIdArrt );

                    $value->campusIds = $campusIds ;
                    if(!$value->save()){
                        throw new \Exception("新增失败");
                    }
                    unset($children[$key]);
                    self::campusChangeChild($value->basicsId,$children,$campusIdArrt);
                }
            }
        }
    }


}