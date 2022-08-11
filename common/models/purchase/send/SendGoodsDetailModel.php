<?php
/**
 *
 * author: jinyanxin
 * Date: 2020/11/17
 * Time: 18:34
 * PHP version 7
 * 发货详情表
 */

namespace common\models\purchase\send;


use common\models\BaseModel;

class SendGoodsDetailModel extends BaseModel
{

    public static function tableName()
    {
        return 'kj_goods_send_detail';
    }

}