<?php
/**
 *
 * author: jinyanxin
 * Date: 2020/11/18
 * Time: 9:31
 * PHP version 7
 */

namespace common\models\goods;


use common\library\helper\Code;

class GoodsStationForm extends GoodsStationModel
{

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['goodsId', 'groupId', 'id'], 'safe'],
        ];
    }


    public function saveInfo()
    {
        if($this->id > 0){
            $info = GoodsStationModel::getById($this->id,false);
            if(empty($info)){
                return ['code'=>Code::PARAM_ERR,'msg'=>'详情不存在'];
            }
        }else{
            $info = GoodsStationModel::find()->where(['groupId'=>$this->groupId,'isValid'=>GoodsStationModel::IS_VALID_OK])->one();
            if(empty($info)){
                $info = new GoodsStationModel();
            }
        }
        $info->groupId = $this->groupId;
        $info->goodsId = $this->goodsId;
        if(!$info->save()){
            return ['code'=>Code::PARAM_ERR,'msg'=>'保存失败'];
        }
        return ['code'=>Code::SUCCESS,'msg'=>'保存成功'];
    }


    //获取详情
    public function getInfo()
    {
        if($this->groupId <= 0){
            return ['code'=>Code::PARAM_ERR,'msg'=>'请选择权限','list'=>[]];
        }
        $data = GoodsStationModel::find()->where(['groupId'=>$this->groupId,'isValid'=>GoodsStationModel::IS_VALID_OK])->asArray()->one();
        $goods = [];
        if(!empty($data)){
            $searchGoodsId = !empty($data['goodsId']) ? explode(',',$data['goodsId']) : [];
            $goods = GoodsModel::find()->select('id,name')->where(['id'=>$searchGoodsId,'isValid'=>GoodsModel::IS_VALID_OK])->asArray()->all();
        }
        return ['code'=>Code::SUCCESS,'msg'=>'ok','list'=>$goods];
    }


}