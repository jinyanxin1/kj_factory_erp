<?php
/**
 * @Author: jinyanxin
 * @Date: 2020/1/7
 * @Time: 13:10
 */


namespace common\models\goods;


use common\models\BaseExportModel;

class GoodsExportModel extends BaseExportModel
{

    public static function export($data)
    {
        //设置导出文件名
        $fileName =  iconv('utf-8', 'gbk', '物品清单');
        //设置表头
        $headList = array(
            '名称','类别','代码','规格','状态','采购单价','销售单价','加盟单价','单位','适用课程','描述'
        );
        self::exportData($data,$fileName,$headList);
    }

    public static function exportStockNum($data)
    {
        //设置导出文件名
        $fileName =  iconv('utf-8', 'gbk', '物品库存清单');
        //设置表头
        $headList = array(
            '名称','类别','代码','规格','销售单价','单位','当前库存','适用课程','描述'
        );
        self::exportData($data,$fileName,$headList);
    }

}