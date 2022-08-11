<?php
/**
 * User: cqj
 * Date: 2020/7/28
 * Time: 3:13 下午
 */

namespace backend\actions\job;


use backend\actions\BaseAction;

class TemplateAction extends BaseAction
{
    public function run() {
        require_once \Yii::getAlias('@common') . '/kjlib/PHPExcel/PHPExcel.php';
        require_once \Yii::getAlias('@common') . '/kjlib/PHPExcel/PHPExcel/IOFactory.php';
        require_once \Yii::getAlias('@common') . '/kjlib/PHPExcel/PHPExcel/Reader/Excel5.php';
        require_once \Yii::getAlias('@common') . '/kjlib/PHPExcel/PHPExcel/Reader/Excel2007.php';
        require_once \Yii::getAlias('@common') . '/kjlib/PHPExcel/PHPExcel/Reader/Excel2003XML.php';

        header("Pragma: public");
        header("Expires: 0");
        header("Cache-Control:must-revalidate, post-check=0, pre-check=0");
        header("Content-Type:application/force-download");
        header("Content-Type:application/vnd.ms-execl");
        header("Content-Type:application/octet-stream");
        header("Content-Type:application/download");
        header("Content-Transfer-Encoding:binary");
        $filePath = \Yii::getAlias('@backend') .'/web/upload/template'.'/job3.xlsx';
        $objPHPExcel = \PHPExcel_IOFactory::load($filePath);
        $objWriter = \PHPExcel_IOFactory::createWriter($objPHPExcel, 'Excel2007');
        header('Content-Disposition:attachment;filename="人才导入模板.xlsx"');
        $objWriter->save('php://output');
        exit;
    }
}