<?php
/**
 *
 * author: jinyanxin
 * Date: 2020/11/17
 * Time: 18:33
 * PHP version 7
 * 发货表
 */

namespace common\models\purchase\send;


use common\models\BaseModel;

class SendGoodsModel extends BaseModel
{

    public static function tableName()
    {
        return 'kj_goods_send';
    }

}