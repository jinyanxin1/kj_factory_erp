<?php
/**
 *
 * author: jinyanxin
 * Date: 2020/9/9
 * Time: 10:33
 * PHP version 7
 */

namespace backend\models\finance;


use common\models\finance\PaymentsStaticsDayModel;

class PaymentsStaticsDayForm extends PaymentsStaticsDayModel
{
    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['type', 'amount', 'accountId'], 'integer'],
            [['amount'],'number','min'=>0,'max'=>self::amountToYuan(self::INT_MAX)],
            [['id','day'], 'safe'],
        ];
    }
}