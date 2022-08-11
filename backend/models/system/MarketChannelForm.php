<?php
/**
 * Created by cqj
 * User: cqj
 * Date: 2019/10/26
 * Time: 9:20
 */

namespace backend\models\system;


use common\library\helper\Code;
use common\models\BaseForm;
use common\models\system\MarketChannelModel;
use Yii;

class MarketChannelForm extends BaseForm
{
    public $name;
    public $parentId;
    public $isCommonality;
    public $campusIds;
    public $marketChannelId;
    public $describe;
    public function rules()
    {
        return [['name','required','message'=>'名称不能为空'],
            ['parentId','integer','message'=>'父级编号错误'],
            ['isCommonality','in','range'=>[0,1],'message'=>'默认编号错误'],
            ['name','string','max'=>30,'message' => '名称长度不能大于三十字符'],
            ['isCommonality','default','value'=>MarketChannelModel::IS_COMMONALITY_NO],
            ['parentId','default','value'=>0]
        ];
    }

    /**
     * 获得列表
     * @param null $campusId
     * @return array
     */
    public static function getList ($campusId = null) {
        $marketChannel = MarketChannelModel::find()
            ->where(['isDelete' => MarketChannelModel::IS_VALID_OK])
            ->asArray()
            ->all();
        $data = MarketChannelModel::Recursive(0,$marketChannel,$campusId);
        return $data;
    }


    public static function campusChangeParent($parentId, $children, $campusIdArrt){
        if(!empty($children)){
            foreach ( $children as $key => $value ) {
                if( $value->marketChannelId == $parentId ){
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
                    self::campusChangeChild($value->marketChannelId,$children,$campusIdArrt);
                }
            }
        }
    }

    /**
     * 新增
     * @param $schoolId
     * @return array
     * @throws \yii\db\Exception
     */
    public function insert ($schoolId) {

        if(!$this->validate()){
            $firstItem = $this->getErrors();
            foreach ($firstItem as $value) {
                return ['code' => Code::PARAM_ERR ,'msg'=>$value[0]];
            }
        }

        $campusIds =  $this->attributes['campusIds'];
        $name = $this->attributes['name'];
        $parentId = $this->attributes['parentId'];
        $isCommonality = $this->attributes['isCommonality'];
        $campusIdArrt = empty($campusIds) ? '' : implode(",", $campusIds);
        $ReDoName = MarketChannelModel::find()
            ->where(['name' => $name , 'isDelete' => MarketChannelModel::IS_VALID_OK])
            ->andFilterWhere(['schoolId' => $schoolId])
            ->one();
        if(!empty($ReDoName)){
            return ['code' => Code::PARAM_ERR ,'msg'=>'市场渠道名称已存在'];
        }

        $tran = Yii::$app->db->beginTransaction();
        try{
            $marketChannel = new MarketChannelModel();
            $marketChannel->name = $name;
            $marketChannel->parentId = $parentId;
            $marketChannel->campusIds = $campusIdArrt;
            $marketChannel->isCommonality = $isCommonality;
            $marketChannel->describe = $this->describe;
            if(!$marketChannel->save()){
                throw new \Exception("新增失败");
            }
            //查询所有
            $marketChannelAll = MarketChannelModel::find()
                ->where(['isDelete' => MarketChannelModel::IS_VALID_OK])
                ->all();

            //修改所有父级的授权
            self::campusChangeParent(
                $marketChannel->parentId,
                $marketChannelAll,
                $campusIds == null ? [] : $campusIds);
            $tran->commit();
        }catch (\Exception $exception){
            //回滚
            $tran->rollBack();
            return ['code' => Code::PARAM_ERR ,'msg'=>$exception->getMessage()];
        }

        return ['code' => Code::SUCCESS ,'msg'=>'新增成功'];
    }

    /**
     * 更新
     * @param $schoolId
     * @return array
     * @throws \yii\db\Exception
     */
    public function update ($schoolId) {
        if(!$this->validate()){
            $firstItem = $this->getErrors();
            foreach ($firstItem as $value) {
                return ['code' => Code::PARAM_ERR ,'msg'=>$value[0]];
            }
        }

        $campusIds =  $this->attributes['campusIds'];
        $name = $this->attributes['name'];
        $marketChannelId = $this->attributes['marketChannelId'];

        $campusIdArrt = empty($campusIds) ? '' : implode(",", $campusIds);
        $ReDoName = MarketChannelModel::find()
            ->where(['name' => $name , 'isDelete' => MarketChannelModel::IS_VALID_OK])
            ->andFilterWhere(['schoolId' => $schoolId])
            ->asArray()
            ->indexBy('marketChannelId')
            ->all();
        if(!empty($ReDoName)){
            if(in_array($marketChannelId,$ReDoName)){
                return ['code' => Code::PARAM_ERR ,'msg'=>'市场渠道名称已存在'];
            }
        }
        $tran = Yii::$app->db->beginTransaction();
        try{
            $marketChannel = MarketChannelModel::find()
                ->where(['marketChannelId' => $marketChannelId ,
                    'isDelete' => MarketChannelModel::IS_VALID_OK])
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
            $marketChannelAll = MarketChannelModel::find()
                ->where(['isDelete' => MarketChannelModel::IS_VALID_OK])
                ->all();
            //修改所有父级的授权
            self::campusChangeParent($marketChannel->parentId,$marketChannelAll,$campusIds == null ? [] : $campusIds);
            //修改所有子级的授权
            self::campusChangeChild($marketChannel->marketChannelId,$marketChannelAll,$campusIds == null ? [] : $campusIds);
            $tran->commit();

        }catch (\Exception $exception){
            //回滚
            $tran->rollBack();
            return ['code' => Code::PARAM_ERR ,'msg'=>$exception->getMessage()];
        }
        return ['code' => Code::SUCCESS ,'msg'=>'修改成功'];
    }

    /**
     * 删除
     * @return array
     */
    public function del () {
        $marketChanneList =  MarketChannelModel::find()
            ->where(['marketChannelId' => $this->marketChannelId])
            ->orWhere(['parentId' => $this->marketChannelId])
            ->andWhere(['isDelete' => MarketChannelModel::IS_VALID_OK])
            ->all();
        $marketChanne = null ;
        $marketChanneChildren = [] ;
        if(!empty($marketChanneList)) {
            foreach ($marketChanneList as $value) {
                if($value['marketChannelId'] == $this->marketChannelId){
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

        $marketChanne->isDelete = MarketChannelModel::IS_VALID_NO ;

        if(!$marketChanne->save()){
            return ['code' => Code::PARAM_ERR ,'msg'=>'删除失败'];
        }
        return ['code' => Code::SUCCESS ,'msg'=>'删除成功'];
    }
}