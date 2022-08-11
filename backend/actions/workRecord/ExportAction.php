<?php
/**
 *
 * author: jinyanxin
 * Date: 2021/7/27
 * Time: 17:10
 * PHP version 7
 */

namespace backend\actions\workRecord;


use backend\actions\BaseAction;
use common\models\workRecord\WorkRecordForm;

require_once  __DIR__.'/../../../common/kjlib/PHPExcel/PHPExcel.php';
class ExportAction extends BaseAction
{

    public function run()
    {
        $staffName = $this->request()->get('staffName');
        $startDate = $this->request()->get('startDate');
        $endDate = $this->request()->get('endDate');
        $goodsName = $this->request()->get('goodsName');
        $type = intval($this->request()->get('type'));

        $work = new WorkRecordForm();
        $work->staffName = $staffName;
        $work->startDate = $startDate;
        $work->endDate = $endDate;
        $work->goodsName = $goodsName;
        $work->type = $type;
        $work->orderBy = "date asc,createTime asc";
        $result = $work->getData();

        $data = $work->formatData($result['data']);



        $excel = new \PHPExcel();
        $objWriter = new \PHPExcel_Writer_Excel2007($excel);

        /**
         * 设置基本属性
         */
        $pro = $excel->getProperties();
        $pro->setCreator("admin")
            ->setLastModifiedBy(date("Y/m/d H:i"))
            ->setTitle("工单记录");

        $sheet= $excel->setActiveSheetIndex(0);
        $sheet->setCellValue("A1","工单日期");
        $sheet->setCellValue("B1","员工姓名");
        $sheet->setCellValue("C1","产品名称");
        $sheet->setCellValue("D1","工序");
        $sheet->setCellValue("E1","数量");
        $sheet->setCellValue("F1","单位");
        $sheet->setCellValue("G1","工价");
        $sheet->setCellValue("H1","合计");
        $sheet->setCellValue("I1","类型");
        $sheet->setCellValue("J1","备注");

        if(count($data) > 0){
            foreach ($data as $i=>$datum) {
                if(count($datum) > 0){
                    $k = $i+2;
                    $sheet->setCellValue("A".$k,$datum["date"]);
                    $sheet->setCellValue("B".$k,$datum["staffName"]);
                    $sheet->setCellValue("C".$k,$datum["goodsName"]);
                    $sheet->setCellValue("D".$k,$datum["workingName"]);
                    $sheet->setCellValue("E".$k,$datum["amount"]);
                    $sheet->setCellValue("F".$k,$datum["goodsUnit"]);
                    $sheet->setCellValue("G".$k,$datum["price"]);
                    $sheet->setCellValue("H".$k,$datum["total"]);
                    $sheet->setCellValue("I".$k,$datum["typeName"]);
                    $sheet->setCellValue("J".$k,$datum["remark"]);
                }
            }
        }

        header("Cache-Control: public");
        header("Pragma: public");
        header("Content-type:application/vnd.ms-excel");
        header("Content-Disposition:attachment;filename=工单统计.xlsx");
        header('Content-Type:APPLICATION/OCTET-STREAM');
        ob_clean();
        ob_start();
        $objWriter->save('php://output');
        ob_end_flush();
        exit();
    }

}