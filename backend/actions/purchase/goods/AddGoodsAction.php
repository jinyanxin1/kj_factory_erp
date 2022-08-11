<?php
/**
 * @Author: jinyanxin
 * @Date: 2020/1/7
 * @Time: 11:17
 * 新增商品
 */


namespace backend\actions\purchase\goods;


use backend\actions\BaseAction;
use backend\models\purchase\goods\GoodsForm;
use common\library\helper\Code;

class AddGoodsAction extends BaseAction
{
    public function run()
    {
        $goodsId = intval($this->request()->post('goodsId'));
        $categoryId = intval($this->request()->post('categoryId'));
        $goodsNo = $this->request()->post('goodsNo');
        $goodsName = $this->request()->post('goodsName');
//        $subjectId = $this->request()->post('subjectId');
//        $gradeId = $this->request()->post('gradeId');
        $attr = $this->request()->post('attr');
        $unit = $this->request()->post('unit');
        $purchasePrice = $this->request()->post('purchasePrice');
        $price = $this->request()->post('price');
        $joinInPrice = $this->request()->post('joinInPrice');
        $status = intval($this->request()->post('status'));
        $description = $this->request()->post('description');
//        $courseIds = $this->request()->post('courseIds');
        $applyGoods = intval($this->request()->post('applyGoods'));
        $isCard = intval($this->request()->post('isCard'));

        //储值卡
        $campusIds = $this->request()->post('campusIds');
        $courseType = $this->request()->post('courseType');
        $classType = $this->request()->post('classType');
        $stageType = $this->request()->post('stageType');
        $type = $this->request()->post('type');
        $subject = $this->request()->post('subject');
        $saleStartTime = $this->request()->post('saleStartTime');
        $saleEndTime = $this->request()->post('saleEndTime');
        $useStartTime = $this->request()->post('useStartTime');
        $useEndTime = $this->request()->post('useEndTime');
        $isUseOne = $this->request()->post('isUseOne');
        $isUseTwo = $this->request()->post('isUseTwo');
        $discount = $this->request()->post('discount');

        if($categoryId <= 0){
            return $this->returnApi(Code::PARAM_ERR,'请选择类别');
        }
       /* if(empty($unit)){
            return $this->returnApi(Code::PARAM_ERR,'请填写单位');
        }*/
        /*if(empty($purchasePrice)){
            return $this->returnApi(Code::PARAM_ERR,'请填写采购单价');
        }*/
       /* if(empty($price)){
            return $this->returnApi(Code::PARAM_ERR,'请填写销售单价');
        }*/
//        if($isCard <= 0){
//            return $this->returnApi(Code::PARAM_ERR,'商品类型错误');
//        }
        $goodsForm = new GoodsForm();
        $goodsForm->addGoodsId = $goodsId;
        $goodsForm->categoryId = $categoryId;
        $goodsForm->goodsNo = $goodsNo;
        $goodsForm->goodsName = $goodsName;
        $goodsForm->attr = $attr;
        $goodsForm->unit = $unit;
        $goodsForm->purchasePrice = $purchasePrice;
        $goodsForm->price = $price;
        $goodsForm->joinInPrice = $joinInPrice;
        $goodsForm->status = $status;
        $goodsForm->description = $description;
        $goodsForm->campusIds = $campusIds;
        $goodsForm->courseType = $courseType;
        $goodsForm->classType = $classType;
        $goodsForm->stageType = $stageType;
        $goodsForm->type = $type;
        $goodsForm->subject = $subject;
        $goodsForm->saleStartTime = $saleStartTime;
        $goodsForm->saleEndTime = $saleEndTime;
        $goodsForm->useStartTime = $useStartTime;
        $goodsForm->useEndTime = $useEndTime;
        $goodsForm->isUseOne = $isUseOne;
        $goodsForm->isUseTwo = $isUseTwo;
        $goodsForm->discount = $discount;
        $goodsForm->applyGoods = $applyGoods;
        $goodsForm->isCard = $isCard;

        $result = $goodsForm->save();
        return $this->returnApi($result['code'],$result['msg']);
    }

}