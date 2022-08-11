<?php
/**
 * @Author: jinyanxin
 * @Date: 2020/1/13
 * @Time: 15:19
 */


namespace common\models;


class BaseExportModel
{
        public static function exportData($data,$fileName,$headList)
        {

            header('Content-Type: application/vnd.ms-excel');
            header('Content-Disposition: attachment;filename="'.$fileName.'.csv"');
            header('Cache-Control: max-age=0');
            //打开PHP文件句柄,php://output 表示直接输出到浏览器
            $fp = fopen('php://output', 'a+');

            //输出Excel列名信息
            foreach ($headList as $key => $value) {
                //CSV的Excel支持GBK编码，一定要转换，否则乱码
                $headList[$key] = iconv('utf-8', 'gbk', $value);
            }
            //将数据通过fputcsv写到文件句柄
            fputcsv($fp, $headList);

            //每隔$limit行，刷新一下输出buffer，不要太大，也不要太小
            $limit = 100000;

            //逐行取出数据，不浪费内存
            foreach ($data as $k => $v) {
                //刷新一下输出buffer，防止由于数据过多造成问题
                if ($k % $limit == 0 && $k!=0) {
                    ob_flush();
                    flush();
                }
                $row = $data[$k];
                if(!empty($row)){
                    foreach ($row as $key => $value) {
                        if( !empty($value) ){
                            $row[$key] = iconv('utf-8', 'gbk', $value)."\t";
                        }
                        \Yii::info('-----------------------------');
                    }
                    fputcsv($fp, $row);
                }
            }
        }
}