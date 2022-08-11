<?php
/**
 * Created by PhpStorm.
 * User: huhui
 * Date: 2019/5/13 0013
 * Time: 9:53
 */

namespace common\kjlib\PHPExcel;


class ExcelExport
{
    function export($arrFields , $title = '')
    {
        require_once dirname(__FILE__) . '/PHPExcel.php';
        require_once dirname(__FILE__) . '/PHPExcel/IOFactory.php';
        require_once dirname(__FILE__) . '/PHPExcel/Reader/Excel5.php';
        require_once dirname(__FILE__) . '/PHPExcel/Reader/Excel2007.php';
        require_once dirname(__FILE__) . '/PHPExcel/Reader/Excel2003XML.php';
        $objPHPExcel = new \PHPExcel();
        /*以下是一些设置 ，什么作者  标题啊之类的*/
        $objPHPExcel->getProperties()->setCreator("")
            ->setLastModifiedBy("")
            ->setTitle("数据EXCEL导出")
            ->setSubject("数据EXCEL导出")
            ->setDescription("备份数据")
            ->setKeywords("excel")
            ->setCategory("result file");
        //设置表格各个列的宽度，没有这个需求可不写
        $objPHPExcel->getActiveSheet()->getColumnDimension('A')->setWidth(15);
        $objPHPExcel->getActiveSheet()->getColumnDimension('B')->setWidth(25);
        $objPHPExcel->getActiveSheet()->getColumnDimension('C')->setWidth(15);
        $objPHPExcel->getActiveSheet()->getColumnDimension('D')->setWidth(15);
        $objPHPExcel->getActiveSheet()->getColumnDimension('E')->setWidth(15);
        $objPHPExcel->getActiveSheet()->getColumnDimension('F')->setWidth(15);
        $objPHPExcel->getActiveSheet()->getColumnDimension('G')->setWidth(15);
        $objPHPExcel->getActiveSheet()->getColumnDimension('H')->setWidth(15);
        $objPHPExcel->getActiveSheet()->getColumnDimension('I')->setWidth(15);
        $objPHPExcel->getActiveSheet()->getColumnDimension('J')->setWidth(15);
        $objPHPExcel->getActiveSheet()->getColumnDimension('K')->setWidth(15);
        $objPHPExcel->getActiveSheet()->getColumnDimension('L')->setWidth(15);
        //写入第一行表头
        $num = 1;
        $objPHPExcel->setActiveSheetIndex(0)
            //Excel的第A列，uid是你查出数组的键值，下面以此类推
            ->setCellValue('A' . $num, '店铺')
            ->setCellValue('B' . $num, '订单号')
            ->setCellValue('C' . $num, '客户')
            ->setCellValue('D' . $num, '电话')
            ->setCellValue('E' . $num, '客户折扣')
            ->setCellValue('F' . $num, '商品数量')
            ->setCellValue('G' . $num, '总金额')
            ->setCellValue('H' . $num, '实际成交额')
            ->setCellValue('I' . $num, '产品成本价')
            ->setCellValue('J' . $num, '抽佣比')
            ->setCellValue('K' . $num, '抽佣金额')
            ->setCellValue('L' . $num, '利润');
        foreach ( $arrFields as $k => $order ) {
            $num = $num + 1;
            $objPHPExcel->setActiveSheetIndex(0)
                //Excel的第A列，uid是你查出数组的键值，下面以此类推
                ->setCellValue('A' . $num, $order['shopName'])
                ->setCellValue('B' . $num, $order['orderNum'])
                ->setCellValue('C' . $num, $order['orderName'])
                ->setCellValue('D' . $num, $order['orderTel'])
                ->setCellValue('E' . $num, $order['discount'])
                ->setCellValue('F' . $num, $order['orderTotalGoods'])
                ->setCellValue('G' . $num, $order['orderRepay'])
                ->setCellValue('H' . $num, $order['orderTotalPay'])
                ->setCellValue('I' . $num, $order['goodsCost'])
                ->setCellValue('J' . $num, $order['commissionRatio'])
                ->setCellValue('K' . $num, $order['rebate'])
                ->setCellValue('L' . $num, $order['profit']);
        }
        $objPHPExcel->getActiveSheet()->setTitle('User');
        $objPHPExcel->setActiveSheetIndex(0);
        header('Content-Type: application/vnd.ms-excel');
        header('Content-Disposition: attachment;filename="' . $title .'统计报表'. date('Y-m-d H-i') .'.xls"');
        header('Cache-Control: max-age=0');
        $objWriter = \PHPExcel_IOFactory::createWriter($objPHPExcel, 'Excel5');
        $objWriter->save('php://output');
        exit;
    }

}