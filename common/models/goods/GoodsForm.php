<?php
/**
 *
 * author: jinyanxin
 * Date: 2020/9/7
 * Time: 9:07
 * PHP version 7
 */

namespace common\models\goods;


use common\library\helper\Code;
use common\models\purchase\GoodsStockModel;
use yii\helpers\Json;

class GoodsForm extends GoodsModel
{
    public $page = 1;
    public $pageSize = 10;
    public $materialList;//关联物料或半成品
    public $houseId;//仓库id

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [
                ['id','name','number','unit','isFinished','describe','materialList','page','pageSize','type','pic','houseId','price'],
                'safe'
            ],
            [['categoryId'], 'integer'],
            [['number', 'name'], 'string', 'max' => 32],
            [['unit'], 'string', 'max' => 5],
            [['pic'], 'string', 'max' => 500],
            [['attr'], 'string', 'max' => 50],
            [['describe','remark'], 'string', 'max' => 225],
            [['weight','volume','parameter'], 'string', 'max' => 225],
        ];
    }


    public function saveInfo()
    {
        if(!$this->validate()){
            $firstItem = current($this->getErrors());
            return ['code'=>Code::PARAM_ERR,'msg'=>$firstItem[0]];
        }
        $exist = GoodsModel::find()->where(['name'=>$this->name,'attr'=>$this->attr,'isValid'=>GoodsModel::IS_VALID_OK])->asArray()->one();
        $tran = \Yii::$app->db->beginTransaction();
        try{
            if($this->id > 0){
                $info = GoodsModel::getById($this->id,false);
                if(empty($info)){
                    throw new \Exception('信息不存在',Code::PARAM_ERR);
                }
                if(!empty($exist)){
                    if(intval($exist['id']) !== intval($this->id)){
                        throw new \Exception('名称与规格重复',Code::PARAM_ERR);
                    }
                }
            }else{
                if(!empty($exist)){
                    throw new \Exception('名称与规格重复',Code::PARAM_ERR);
                }
                //不验证名称重复
                $info = new GoodsModel();
            }
            $info->type = $this->type;
            $info->categoryId = $this->categoryId;
            $info->price = GoodsModel::amountToCent($this->price);
            $info->number = $this->number;
            $info->name = $this->name;
            $info->unit = $this->unit;
            $info->describe = $this->describe;
            $info->pic = Json::encode($this->pic);
            $info->isFinished = $this->isFinished;
            $info->weight = $this->weight;
            $info->volume = $this->volume;
            $info->parameter = $this->parameter;
            $info->attr = $this->attr;
            $info->remark = $this->remark;
            $info->save();
            $goodsId = $info->id;
            $tran->commit();
        }catch (\Exception $e){
            $tran->rollBack();
            \Yii::info('---save goods info---'.$e->getMessage().'---file--'.$e->getFile().'---line--'.$e->getLine());
            $msg = $e->getCode() === Code::PARAM_ERR ? $e->getMessage() : '保存失败';
            return ['code'=>Code::PARAM_ERR,'msg'=>$msg];
        }

        return ['code'=>Code::SUCCESS,'msg'=>'保存成功'];
    }


    public function getData()
    {
        $model = GoodsModel::find()->where(['isValid'=>self::IS_VALID_OK]);
        if(!empty($this->name)){
            $model->andWhere(['like','name',$this->name]);
        }
        if($this->categoryId > 0){
            $model->andWhere(['categoryId'=>$this->categoryId]);
        }
        if($this->isFinished > 0){
            $model->andWhere(['isFinished'=>$this->isFinished]);
        }
        /*if($this->houseId > 0){
            $stockGoods = GoodsStockModel::getByHouseId($this->houseId);
            $stockGoodsIds = count($stockGoods) > 0 ? array_unique(array_column($stockGoods,'goodsId')) : [-1];
            $model->andWhere(['id'=>$stockGoodsIds]);
        }*/
        if($this->type > 0){
            $model->andWhere(['type'=>$this->type]);
        }
        $count = $model->count();
        $data = $model->offset(($this->page - 1) * $this->pageSize)->limit($this->pageSize)->orderBy('name desc,createTime desc')->asArray()->all();
        return ['count'=>$count,'data'=>$data];
    }


    public function formatData($data)
    {
        $returnArr = [];
        if(count($data) > 0){
            $category = GoodsCategoryModel::find()->select('id,name')->where(['id'=>array_column($data,'categoryId'),'isValid'=>GoodsCategoryModel::IS_VALID_OK])->indexBy('id')->asArray()->all();
            $stock = GoodsStockModel::getStockByGoodsIds(array_column($data,'id'),0);
            foreach($data as $info){
                $returnArr[] = [
                    'id'=>intval($info['id']),
                    'number'=>$info['number'],
                    'name'=>$info['name'],
                    'unit'=>$info['unit'],
                    'weight'=>$info['weight'],
                    'volume'=>$info['volume'],
                    'parameter'=>$info['parameter'],
                    'stock'=>isset($stock[$info['id']]) ? $stock[$info['id']]['totalNum'] : 0,
                    'categoryName'=>isset($category[$info['categoryId']]) ? $category[$info['categoryId']] : '',
                    'describe'=>$info['describe'],
                    'isFinished'=>intval($info['isFinished']),
                    'price'=>GoodsStockModel::amountToYuan($info['price']),
                    'attr' =>$info['attr']
                ];
            }
        }
        return $returnArr;
    }


    public function getInfo()
    {
        $info = GoodsModel::getById($this->id,true);
        if(empty($info)){
            return ['code'=>Code::PARAM_ERR,'msg'=>'详情不存在','info'=>[]];
        }
        $info['pic'] = Json::decode($info['pic']);
        $info['price'] = GoodsModel::amountToYuan($info['price']);
        return ['code'=>Code::SUCCESS,'msg'=>'ok','info'=>$info];
    }

}