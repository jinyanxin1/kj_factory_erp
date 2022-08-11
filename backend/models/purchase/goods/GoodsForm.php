<?php
/**
 * @Author: jinyanxin
 * @Date: 2020/1/7
 * @Time: 11:19
 */


namespace backend\models\purchase\goods;


use common\library\helper\Code;
use common\models\BaseForm;
use common\models\goods\GoodsModel;
use common\models\stock\StockModel;

class GoodsForm extends BaseForm
{

    public $addGoodsId;//商品id
    public $categoryId;//类别id
    public $goodsNo;//代码
    public $goodsName;//商品名称
    public $subjectId;//所属科目
    public $gradeId;//所属年级
    public $attr;//规格
    public $unit;//单位
    public $purchasePrice;//采购价格
    public $price;//销售价格
    public $joinInPrice;//加盟价格
    public $status;//状态
    public $description;//描述
    public $courseIds;//适用课程
    public $campusIds;//使用校区
    public $courseType;//课程类型
    public $classType;//班型
    public $stageType;//期段
    public  $type;//类型
    public  $subject;//科目
    public $saleStartTime;//销售开始时间
    public $saleEndTime;//销售结束时间
    public $useStartTime;//使用开始时间
    public $useEndTime;//使用结束时间
    public $isUseOne;//允许与单科折扣/优惠同时使用
    public $isUseTwo;//允许与其他优惠条件同时使用
    public $discount;//折扣
    public $applyGoods;
    public $isCard;//是否是储值卡，1是，2否


    public $houseId;//仓库id
    public $page;
    public $pageSize;

    public $export = false;//是否导出
    public $exportType;//导出类型：1商品导出；2库存查询导出

    public function rules()
    {
        return [
            [['goodsNo','attr'],'string','min'=>0,'max'=>32],
            [['goodsName','unit'],'string','min'=>1,'max'=>32],
            [['description'],'string','min'=>0,'max'=>64],
        ];
    }

    public function attributeLabels()
    {
        return [
            'categoryId'=>'所属物品类别',
            'goodsNo'=>'商品代码',
            'goodsName'=>'商品名称',
            'subjectId'=>'所属科目',
            'gradeId'=>'所属年级',
            'attr'=>'规格',
            'unit'=>'单位',
            'purchasePrice'=>'采购价格',
            'price'=>'销售价格',
            'joinInPrice'=>'加盟价格',
            'status'=>'状态',
            'description'=>'描述',
            'courseIds'=>'适用课程',
        ];
    }

    //保存商品
    public function save()
    {
        if (!$this->validate()){
            $firstItem = current($this->getErrors());
            $msg=$firstItem[0];
            return ['code'=>Code::PARAM_ERR,'msg'=>$msg];
        }
        if($this->addGoodsId > 0){
            $goods = GoodsModel::getById($this->addGoodsId);
            if($goods === null){
                return ['code'=>Code::PARAM_ERR,'msg'=>'商品不存在'];
            }
            $exist = GoodsModel::find()->where(['categoryId'=>$this->categoryId,'goodsName'=>$this->goodsName,'isValid'=>GoodsModel::IS_VALID_OK])->one();
            if(!empty($exist)){
                if($goods->goodsId !== $exist->goodsId){
                    return ['code'=>Code::PARAM_ERR,'msg'=>'该类别下商品名称重复'];
                }
            }
        }else{
            $exist = GoodsModel::find()->where(['categoryId'=>$this->categoryId,'goodsName'=>$this->goodsName,'isValid'=>GoodsModel::IS_VALID_OK])->one();
            if(!empty($exist)){
                return ['code'=>Code::PARAM_ERR,'msg'=>'该类别下商品名称重复'];
            }
            $existNo = GoodsModel::find()->where(['goodsNo'=>$this->goodsNo,'isValid'=>GoodsModel::IS_VALID_OK])->one();
            if($existNo !== null){
                return ['code'=>Code::PARAM_ERR,'msg'=>'商品代码重复'];
            }
            $goods = new GoodsModel();
        }
        $goods->categoryId = $this->categoryId;
        $goods->goodsNo = empty($this->goodsNo) ? 0 : $this->goodsNo;
        $goods->goodsName = $this->goodsName;
//        $goods->subjectId = count($this->subjectId)>0 ? implode(',',$this->subjectId) : '';
//        $goods->gradeId = count($this->gradeId)>0 ? implode(',',$this->gradeId) : '';
        $goods->attr = $this->attr;

        $goods->unit = $this->unit;
        $goods->purchasePrice = $this->purchasePrice * 100;
        $goods->price = $this->price * 100;
        $goods->joinInPrice = $this->joinInPrice * 100;


        $goods->status = $this->status;
        $goods->description = $this->description;
//        $goods->courseIds = count($this->courseIds)>0 ? implode(',',$this->courseIds) : '';
        $goods->campusIds = count($this->campusIds)>0 ? implode(',',$this->campusIds) : '';
        $goods->courseType = $this->courseType;
        $goods->classType = count($this->classType)>0 ? implode(',',$this->classType) : '';
        $goods->stageType = count($this->stageType)>0 ? implode(',',$this->stageType) : '';
        $goods->type = count($this->type)>0 ? implode(',',$this->type) : '';
//        $goods->subject = count($this->subject)>0 ? implode(',',$this->subject) : '';
        $goods->saleStartTime = $this->saleStartTime;
        $goods->saleEndTime = $this->saleEndTime;
        $goods->useStartTime = $this->useStartTime;
        $goods->useEndTime = $this->useEndTime;
        $goods->isUseOne = $this->isUseOne;
        $goods->isUseTwo = $this->isUseTwo;
        $goods->discount = $this->discount;
        $goods->applyGoods = $this->applyGoods;
        $goods->isCard = $this->isCard;
        if(!$goods->save()){
            return ['code'=>Code::PARAM_ERR,'msg'=>'保存失败'];
        }
        return ['code'=>Code::SUCCESS,'msg'=>'保存成功'];
    }

    //商品列表
    public function getData()
    {
        $returnArr = ['data'=>[],'count'=>0];

        $model = GoodsModel::find()->where(['isValid'=>GoodsModel::IS_VALID_OK]);
        if(!empty($this->status)){
            $model->andWhere(['status'=>$this->status]);
        }
        if(!empty($this->goodsName)){
            $model->andWhere(['like','goodsName',$this->goodsName]);
        }
        if($this->categoryId > 0){
            $model->andWhere(['categoryId'=>$this->categoryId]);
        }
        if($this->houseId > 0){
            $stockGoods = StockModel::getByHouseId($this->houseId);
            $stockGoodsIds = count($stockGoods) > 0 ? array_column($stockGoods,'goodsId') : [];
            $model->andWhere(['goodsId'=>$stockGoodsIds]);
        }
        $count = $model->count();
        if(($this->page > 0) && ($this->pageSize > 0)){
            $goods = $model->offset(($this->page - 1) * $this->pageSize)->limit($this->pageSize)->orderBy('createTime desc')->asArray()->all();
        }else{
            $goods = $model->asArray()->all();
        }
        $goodsIdList = array_column($goods,'goodsId');
        $stockNumList  =  StockModel::getStockNumByGoodsIds($goodsIdList,$this->houseId);
        $returnArr['data'] = GoodsModel::format($goods,$this->export,$stockNumList,$this->exportType);
        $returnArr['count'] = $count;

        return $returnArr;
    }


}