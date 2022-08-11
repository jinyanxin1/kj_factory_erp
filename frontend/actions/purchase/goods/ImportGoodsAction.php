<?php
/**
 * @Author: jinyanxin
 * @Date: 2020/1/7
 * @Time: 13:40
 * 导入商品
 */


namespace frontend\actions\purchase\goods;


use frontend\actions\WxAction;
use frontend\models\system\DataImportForm;
use common\library\helper\Code;
use common\models\course\CourseModel;
use common\models\goods\GoodsCategoryModel;
use common\models\goods\GoodsModel;
use yii\db\Expression;
use yii\web\UploadedFile;

class ImportGoodsAction extends WxAction
{
    public function run()
    {
        $file = UploadedFile::getInstanceByName('file');
        $fileUrl = DataImportForm::UploadExcel($file);
        $importData = $this->getImportData($fileUrl);
        if(count($importData)<=0){
            return $this->returnApi(Code::PARAM_ERR,'导入数据为空');
        }
        $category = GoodsCategoryModel::getAll2();
        $category = array_values($category);
        $categoryNames = count($category)>0 ? array_combine(array_column($category,'categoryName'),$category) : [];
        $allGoods = GoodsModel::getAll2();
        $goodsGroup = $allGoods['groupByCategory'];
        $existGoodsNo = $allGoods['goodsNoList'];
        $course = CourseModel::getList();
        $courseList = count($course)>0 ? array_combine(array_column($course,'courseName'),$course) : [];
        $transaction = \Yii::$app->db->beginTransaction();
        try{
            $importGoodsNo = [];
            $importCategory = [];
            foreach($importData as $info){
                if(empty($info['goodsName'])){
                    throw new \Exception('商品名称为空');
                    break;
                }
                if(empty($info['categoryName'])){
                    throw new \Exception('商品类别不能为空');
                    break;
                }
                if(empty($info['unit'])){
                    throw new \Exception('单位不能为空');
                    break;
                }
                if(empty($info['purchasePrice'])){
                    throw new \Exception('采购价格不能为空');
                    break;
                }
                if(empty($info['price'])){
                    throw new \Exception('销售价格不能为空');
                    break;
                }
                if(empty($info['joinInPrice'])){
                    throw new \Exception('加盟价格不能为空');
                    break;
                }
                if(mb_strlen($info['goodsName'],'utf8')>32){
                    throw new \Exception($info['goodsName'].'商品名称过长');
                    break;
                }
                if(in_array($info['goodsNo'],$importGoodsNo)){
                    throw new \Exception($info['goodsNo'].'代码重复');
                    break;
                }
                $importGoodsNo[] = $info['goodsNo'];
                if(isset($importCategory[$info['categoryName']])){
                    if(in_array($info['goodsName'],$importCategory[$info['categoryName']])){
                        throw new \Exception($info['categoryName'].'类别中'.$info['goodsName'].'商品名称重复');
                        break;
                    }
                }
                $importCategory[$info['categoryName']][] = $info['goodsName'];
                if(!isset($categoryNames[$info['categoryName']])){
                    throw new \Exception($info['categoryName'].'类别不存在');
                    break;
                }
                $categoryId = intval($categoryNames[$info['categoryName']]['categoryId']);
                $existGoodsNames = isset($goodsGroup[$categoryId]) ? $goodsGroup[$categoryId] : [];
                if(in_array($info['goodsName'],$existGoodsNames)){
                    throw new \Exception($info['categoryName'].'类别中'.$info['goodsName'].'商品名称重复');
                    break;
                }
                if(in_array($info['goodsNo'],$existGoodsNo)){
                    throw new \Exception($info['goodsNo'].'代码重复');
                    break;
                }
                $courseIds = [];
                if( !empty($info['courseNames']) ){
                    $courseNameList = explode(',',$info['courseNames']);
                    if(count($courseNameList)>0){
                        foreach($courseNameList as $courseName){
                            if(!isset($courseList[$courseName])){
                                throw new \Exception($courseName.'课程不存在');
                                break;
                            }
                            if(!in_array($courseList[$courseName]['courseId'],$courseIds)){
                                $courseIds[] = intval($courseList[$courseName]['courseId']);
                            }
                        }
                    }
                }
                if($info['statusName'] === '启用'){
                    $info['status'] = GoodsModel::QI_YONG;
                }else{
                    $info['status'] = GoodsModel::JIN_YONG;
                }
                $info['categoryId'] = $categoryId;
                $info['courseIds'] = count($courseIds)>0 ? implode(',',$courseIds) : '';
                //保存
                $goods = new GoodsModel();
                $goods->categoryId = $info['categoryId'];
                $goods->goodsNo = $info['goodsNo'];
                $goods->goodsName = $info['goodsName'];
                $goods->attr = $info['attr'];
                $goods->unit = $info['unit'];
                $goods->purchasePrice = intval($info['purchasePrice'] * 100);
                $goods->price = intval($info['price'] * 100);
                $goods->joinInPrice = intval($info['joinInPrice'] * 100);
                $goods->status = $info['status'];
                $goods->description = $info['description'];
                $goods->courseIds = $info['courseIds'];
                if(!$goods->save()){
                    throw new \Exception('商品保存失败');
                }
            }
            $transaction->commit();
        }catch(\Exception $e){
            $transaction->rollBack();
            return $this->returnApi(Code::PARAM_ERR,$e->getMessage());
        }
        return $this->returnApi(Code::SUCCESS,'导入成功');

    }

    //获取excel数据
    public function getImportData($fileUrl)
    {
        require_once \Yii::getAlias('@common') . '/kjlib/PHPExcel/PHPExcel/IOFactory.php';
        $objPHPExcel = \PHPExcel_IOFactory::load($fileUrl);
        $sheet = $objPHPExcel->getSheet(0);
        $allColumn = $sheet->getHighestColumn();
        $allRow = $sheet->getHighestRow();
        $ColumnNum = 11;
        $data = [];
        $table = [
            'categoryName','goodsNo','goodsName','attr','unit','purchasePrice','price','joinInPrice','statusName','description','courseNames'
        ];
        for ($y = 3; $y <= $allRow ; $y++) {
            $categoryName = $value = $sheet->getCellByColumnAndRow(0, $y)->getFormattedValue();
            $goodsNo = $value = $sheet->getCellByColumnAndRow(1, $y)->getFormattedValue();
            $goodsName = $value = $sheet->getCellByColumnAndRow(2, $y)->getFormattedValue();
            $attr = $value = $sheet->getCellByColumnAndRow(3, $y)->getFormattedValue();
            $unit = $value = $sheet->getCellByColumnAndRow(4, $y)->getFormattedValue();
            $purchasePrice = $value = $sheet->getCellByColumnAndRow(5, $y)->getFormattedValue();
            $price = $value = $sheet->getCellByColumnAndRow(6, $y)->getFormattedValue();
            $joinInPrice = $value = $sheet->getCellByColumnAndRow(7, $y)->getFormattedValue();
            $statusName = $value = $sheet->getCellByColumnAndRow(8, $y)->getFormattedValue();
            $description = $value = $sheet->getCellByColumnAndRow(9, $y)->getFormattedValue();
            $courseNames = $value = $sheet->getCellByColumnAndRow(10, $y)->getFormattedValue();
            if(!empty($categoryName) && !empty($goodsName) && !empty($unit) && !empty($purchasePrice) && !empty($price) && !empty($joinInPrice)){
                $data[] = [
                    'categoryName'=>$categoryName,
                    'goodsNo'=>$goodsNo,
                    'goodsName'=>$goodsName,
                    'attr'=>$attr,
                    'unit'=>$unit,
                    'purchasePrice'=>$purchasePrice,
                    'price'=>$price,
                    'joinInPrice'=>$joinInPrice,
                    'statusName'=>$statusName,
                    'description'=>$description,
                    'courseNames'=>$courseNames,
                ];
            }
        }
        unlink($fileUrl);
        \Yii::info('----------import goods data -----'.print_r($data,true));
        return $data;
    }
}