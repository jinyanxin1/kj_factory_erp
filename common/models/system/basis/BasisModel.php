<?php
/**
 * Created by cqj
 * User: cqj
 * Date: 2019/10/25
 * Time: 9:16
 */
namespace common\models\system\basis;

use common\models\BaseModel;

class BasisModel extends BaseModel
{
    CONST CHANNEL_MODE = 'CHANNEL_MODE';            //市场渠道
    CONST SOCIAL_SECURITY = 'SOCIAL_SECURITY';      //社保
    CONST SKILL = 'SKILL';                          //技能
    CONST CLIENT = 'CLIENT';                          //客户合同类型
    CONST SUPPLIER = 'SUPPLIER';                          //供应商合同类型
    CONST CLIENT_RANGE = 'CLIENT_RANGE';                          //供应商合同类型

    /**
     * @return array
     * 获得基础参数设置列表
     */
    public static function getTypeList() {
        return [
//            [   'name' => '市场渠道' ,
//                'type' => self::CHANNEL_MODE,
//                'status' => 0 ],
//            [   'name' => '社保' ,
//                'type' => self::SOCIAL_SECURITY,
//                'status' => 0 ],
//            [   'name' => '技能' ,
//                'type' => self::SKILL,
//                'status' => 0 ],
            [   'name' => '客户合同类型' ,
                'type' => self::CLIENT,
                'status' => 0 ],
//            [   'name' => '供应商合同类型' ,
//                'type' => self::SUPPLIER,
//                'status' => 0 ],
            [   'name' => '客户人员规模' ,
                'type' => self::CLIENT_RANGE,
                'status' => 0 ],

    ];
    }
    public static function tableName()
    {
        return 'kj_basis';
    }

//    /*
//     * 通过id获取信息
//     * */
//    public static function getById($id)
//    {
//        return self::find()->where(array('basisId'=>$id,'isValid'=>self::IS_VALID_OK))->asArray()->one();
//    }

    //通过Id查询单条数据
    public static function getById($id, $select = ['*'], $asArray = false, $isIndex = '')
    {
        $model = self::find()
            ->select($select)
            ->Where([ 'basisId' => $id , 'isValid' => self::IS_VALID_OK ]) ;
        if ($asArray) {
            $model = $model->asArray() ;
        }
        if ( !empty($isIndex) ) {
            $model = $model->indexBy($isIndex) ;
        }
        $model->limit(1) ;
        return $model->one() ;
    }

    /**
     * @param $type
     * @return array
     * 通过类型获得参数
     */
    public static function getList($type){
        $basicsData = BasisModel::find()
            ->select(['basisId','name','type'])
            ->where(['isValid' => BasisModel::IS_VALID_OK])
            ->asArray()
            ->all();
        foreach ($basicsData as $key => $value ) {
            $basicsData[$key]['basisId'] = intval($basicsData[$key]['basisId']);
        }
        $data = [] ;
        if  (is_array($type)) {
            foreach ($type as $typeItem) {
                $dataItem = [] ;
                foreach ( $basicsData as $key => $value ) {
                    if($value['type'] == $typeItem){
                        $dataItem[] = $value ;
                        unset($basicsData[$key]);
                    }
                }
                $data[$typeItem] = $dataItem;
            }
        } else {
            foreach ( $basicsData as $key => $value ) {
                if($value['type'] == $type){
                    $data[] = $value ;
                }
            }
        }
        return $data;

    }

    /**
     * 通过数组查询列表 封装为 [XXX:[{basisId:XX,name:XX.....},{}],XXX:[{basisId:XX,name:XX.....},{}]]
     * @param $typeArr
     * @return array
     */
    public static function getListByArr ($typeArr) {
        $basicsData = BasisModel::find()
            ->select(['basisId','name','type'])
            ->where(['isValid' => BasisModel::IS_VALID_OK])
            ->addOrderBy('createTime')
            ->asArray()
            ->all();
        $data = [];
        foreach ($basicsData as $key => $value){
            if(in_array($value['type'],$typeArr)){
                $data[$value['type']][] = $value;
            }
        }
        return $data;
    }


    /**
     * 通过id获得名称
     * @param $basisId
     * @return string
     */
    public static function getBasicsName($basisId){
        $basicsData = BasisModel::find()
            ->select(['basisId','name'])
            ->where(['isValid' => BasisModel::IS_VALID_OK])
            ->andWhere(['basisId' => $basisId])
            ->asArray()
            ->one();

        $name = !empty($basicsData) ? $basicsData['name'] : '';
        return $name;
    }

}